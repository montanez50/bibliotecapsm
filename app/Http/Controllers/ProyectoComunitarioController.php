<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Autor;
use App\Models\Carrera;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;
use App\Models\ProyectoComunitario;

class ProyectoComunitarioController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index(Request $request)
  {
    $orderBy = $request->query('sort');
    $carrera = $request->query('carrera');
    $buscar = $request->query('buscar');
    
    // Query principal
    $query = ProyectoComunitario::with('publicaciones.autores')
      ->join('publicaciones as pub', 'pub.id', '=', 'proyectos_comunitarios.publicacion_id')
      ->leftJoin('autor_publicacion as ap', 'pub.id', '=', 'ap.publicacion_id')
      ->leftJoin('autores as a', 'ap.autor_id', '=', 'a.id')
      ->select('pub.*', 'proyectos_comunitarios.*') // Selecciona todas las columnas de publicaciones y de trabajos_de_grado (tdg)
      ->distinct(); //evade resultados duplicados

    // Aplica el filtro de carreras si se selecciona
    if ($carrera) {
        $query->where('pub.carrera_id', $carrera);
    }

    // Aplica el filtro de búsqueda si se selecciona
    if ($buscar) {
      $query->where(function ($subQuery) use ($buscar) {
        $subQuery->where('titulo', 'like', "%{$buscar}%")
          ->orWhere('a.nombre', 'like', "%{$buscar}%")
          ->orWhere('proyectos_comunitarios.tutor', 'like', "%{$buscar}%")
          ->orWhereExists(function ($subSubQuery) use ($buscar) {
            $subSubQuery->select('proyectos_comunitarios.publicacion_id')
              ->from('proyectos_comunitarios')
              ->whereColumn('proyectos_comunitarios.publicacion_id', 'pub.id')
              ->where('titulo', 'like', "%{$buscar}%");
          });
      });
    }

    if($orderBy)
    {
      switch ($orderBy) {
        case 'titulo_asc':
            $query->orderBy('titulo', 'asc');
            break;
        case 'titulo_desc':
            $query->orderBy('titulo', 'desc');
            break;
        case 'anio_asc':
            $query->orderBy('pub.anio', 'asc');
            break;
        case 'anio_desc':
            $query->orderBy('pub.anio', 'desc');
            break;
        case 'tutor_asc':
          $query->orderBy('proyectos_comunitarios.tutor', 'asc');
          break;
        case 'tutor_desc':
            $query->orderBy('proyectos_comunitarios.tutor', 'desc');
            break;
      }
    }
    // Get the results
    $proyectos = $query->paginate(10);
    $activeTab = 'proyecto';
    $carreras = Carrera::all(); 
    return view('recursos.proyectos.index_proyecto', compact('proyectos', 'activeTab', 'carreras'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $autores = Autor::all() ;
    $docentes = User::role('Docente')->get();
    $carreras = Carrera::all();
    $activeTab = 'proyecto';
    return view('recursos.proyectos.create_proyecto', compact('autores', 'carreras', 'docentes', 'activeTab'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'anio' => 'required|integer',
      'archivo' => 'required|file|mimes:pdf',
      'tutor' => 'required|string|max:70',
      'descripcion' => 'required',
    ]);
    
    $fileName = $request->file('archivo')->store('archivos/proyectos', 'public');

    $publicacion = Publicacion::create([
        'user_id' => auth()->user()->id, // assuming the user is authenticated
        'titulo' => $validated['titulo'],
        'carrera_id' => $validated['carrera_id'],
        'anio' => $validated['anio'],
        'archivo' => $fileName,
    ]);

    $publicacion->autores()->attach($validated['autor_id']);

    $proyecto = ProyectoComunitario::create([
      'publicacion_id' => $publicacion->id,
      'tutor' => $validated['tutor'],
      'descripcion' => $validated['descripcion'],
    ]);
      // $publicacion = $request->only()
      // $formFields['user_id'] = auth()->id();
      
      return redirect('/proyectos')->with('message', 'Carga de Proyecto Comunitario exitosa');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(ProyectoComunitario $proyecto)
  {
    Visualizacion::create([
      'user_id' => auth()->user()->id, 
      'publicacion_id' => $proyecto->publicacion_id,
    ]);
    return view('recursos.proyectos.show_proyecto', compact('proyecto'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(ProyectoComunitario $proyecto)
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $docentes = User::role('Docente')->get();
    return view('recursos.proyectos.edit_proyecto', compact('proyecto', 'autores', 'docentes', 'carreras',));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, ProyectoComunitario $proyecto)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'anio' => 'required|integer',
      'tutor' => 'required|string|max:70',
      'descripcion' => 'required',
    ]);

    if($request->hasFile('archivo')){
      
      $fileName = $request->file('archivo')->store('archivos/proyectos', 'public');

        $updatePublicacion = [
          'titulo' => $validated['titulo'],
          'carrera_id' => $validated['carrera_id'],
          'anio' => $validated['anio'],
          'archivo' => $fileName,
        ];

    }else{
      $updatePublicacion = [
        'titulo' => $validated['titulo'],
        'carrera_id' => $validated['carrera_id'],
        'anio' => $validated['anio'],
      ];
    }
    // actualiza el registro de la tabla general publicaciones
    $proyecto->publicaciones->update($updatePublicacion);
    //actualiza los autores enlazados a la publicacion
    $proyecto->publicaciones->autores()->sync($validated['autor_id']);

    $updateProyecto = [
      'tutor' => $validated['tutor'],
      'descripcion' => $validated['descripcion'],
    ];

    $proyecto->update($updateProyecto);

    return redirect('/proyectos')->with('message', 'Proyecto Comunitario actualizado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(ProyectoComunitario $proyecto)
  {
    $proyecto->publicaciones->autores()->detach();
    $proyecto->publicaciones->visualizaciones()->detach();
    $proyecto->delete() ;
    $proyecto->publicaciones->delete();

    return redirect('/proyectos')->with('message','Proyecto Comunitario eliminado con éxito');
  }
  
}

?>