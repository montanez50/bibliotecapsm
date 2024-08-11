<?php 

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $activeTab = 'autor';
    $autores = Autor::all();
    return view('administracion.autores.index_autor', compact('activeTab', 'autores'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $activeTab = 'autor';
    return view('administracion.autores.create_autor', compact('activeTab'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
    ]);

    $autor = Autor::create([
      'nombre' => $validated['nombre']
    ]);

    return redirect('/autores')->with('message', 'Carga de autor exitosa');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Autor $autor)
  {
    $activeTab = 'autor';
    return view('administracion.autores.edit_autor', compact('autor', 'activeTab'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Autor $autor)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
    ]);
    $autor->update($validated);

    return redirect('/autores')->with('message', 'Autor editado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Autor $autor)
  {
    $autor->delete();
    return redirect('/autores')->with('message','Autor eliminada con éxito');
  }
  
}

?>