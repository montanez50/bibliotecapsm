<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Autor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('usuarios.index_user', compact('users'));
    }

    //Show register/create form
    public function create(){
        $activeTab = 'admin';
        $roles = Role::whereIn('name', ['Estudiante', 'Docente', 'Personal Administrativo'])->get();
        return view('usuarios.create_admin', compact('activeTab', 'roles'));
    }

    //Create new user
    public function store(Request $request){
        $formFields = $request->validate([
            'selecNacionalidad' => 'required',
            'nombres' => ['required', 'min:3'],
            'role' => ['required'],
            'cedula' => ['required', 'string'],
            'correo' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')],
            // ->ignore($user->id)],
            'password' => ['nullable', 'confirmed', Password::defaults()] //arreglar xd
        ]);

        if(strcmp($formFields['role'], 'Docente') == 0)
        {
            Autor::create([
                'nombre' => $formFields['nombres']
              ]);
        }
        //Hash password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create(['nombres' => $formFields['nombres'],
                            'password' => $formFields['password'],
                            'correo' => $formFields['correo'],
                            'cedula' => $formFields['selecNacionalidad'].$formFields['cedula']]);
        
        $user->syncRoles($request['role']);
        //Login
        // auth()->login($user);
        return redirect('/')->with('message', 'Usuario creado con éxito');
    }

    public function edit(User $usuario)
    {
      return view('usuarios.edit_user', compact('usuario'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, User $usuario) //pasa el modelo como parámetro
    {
        $data = $request->validate([
           'selecNacionalidad' => 'required',
           'nombres' => ['required', 'min:3'],
           'cedula' => ['required', 'string'],
           'correo' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id) ],
           'password' => ['nullable', 'confirmed', Password::defaults()]
        ]);

        if(strcmp($usuario->getRoleNames()[0], 'Docente') == 0)
        {
            $autor = Autor::where('nombre', '=', $usuario->nombres)->first() ;
        }

        if ($request->filled('password')) {
            $usuario->update([
                'nombres' => $data['nombres'],
                'cedula' => $data['selecNacionalidad'].$data['cedula'],
                'correo' => $data['correo'],
                'password' => Hash::make($data['password']),
            ]); 
        }else{
            $usuario->update([
                'nombres' => $data['nombres'],
                'cedula' => $data['selecNacionalidad'].$data['cedula'],
                'correo' => $data['correo'],
            ]); 
        }

        if(strcmp($usuario->getRoleNames()[0], 'Docente') == 0)
        {
            $autor->update([
                'nombre' => $data['nombres']
            ]);
        }

        return redirect()->route('user.index')->with('message', 'Usuario modificado con éxito');
    }

    //logout user
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Hasta luego~');
    }

    //show login form
    public function login(){
        return view('usuarios.login');
    }

    //authenticate (login user)
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'correo' => ['required', 'email'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Inicio de sesión exitoso. Bienvenido~');
        }

        return back()->withErrors(['email'=> 'Invalid credentials'])->onlyInput('email');        
    }

    public function destroy(User $usuario){
        if ($user->hasRole('Administrador')) {
            return redirect()->route('user.index')->with('error', 'No puedes eliminar un Administrador.');
        }
        $usuario->delete() ;

        return redirect()->route('user.index')->with('message', 'Usuario eliminado correctamente.');
    }

}
