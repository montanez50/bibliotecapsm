<?php 

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Libro;
use App\Models\Carrera;
use App\Models\Editorial;
use App\Models\Asignatura;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LibroController extends Controller 
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
    $query = Libro::with('publicaciones.autores')
        ->join('publicaciones as pub', 'libros.publicacion_id', '=', 'pub.id')
        ->leftJoin('autor_publicacion as ap', 'libros.publicacion_id', '=', 'ap.publicacion_id')
        ->leftJoin('autores as a', 'ap.autor_id', '=', 'a.id')
        ->leftJoin('asignaturas as ag', 'libros.asignatura_id', '=', 'ag.id')
        ->select('pub.*', 'libros.*', 'ag.nombre as asignatura_nombre') // Selecciona todas las columnas de publicaciones y de libros (l)
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
          ->orWhere('ag.nombre', 'like', "%{$buscar}%")
          ->orWhere('libros.dewey', 'like', "%{$buscar}%")
          ->orWhere('pub.anio', 'like', "%{$buscar}%")
          ->orWhereExists(function ($subSubQuery) use ($buscar) {
            $subSubQuery->select('libros.publicacion_id')
              ->from('libros')
              ->whereColumn('libros.publicacion_id', 'pub.id')
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
        case 'dewey_asc':
          $query->orderBy('libros.dewey', 'asc');
          break;
        case 'dewey_desc':
            $query->orderBy('libros.dewey', 'desc');
            break;
        case 'asignatura_asc':
          $query->orderBy('ag.nombre', 'desc');
          break;
        case 'asignatura_desc':
          $query->orderBy('ag.nombre', 'desc');
          break;
      }
    }

    // Get the results
    $libros = $query->paginate(10);
    $activeTab = 'libro';
    $carreras = Carrera::all(); 
    return view('recursos.libros.index_libro', compact('libros', 'activeTab', 'carreras'));
  }



  // public function filter(Request $request)
  // {
  //     $carreraId = $request->query('carrera_id');
  //     $libros = DB::table('publicaciones')
  //     ->join('libros', 'publicaciones.id', '=', 'libros.publicacion_id')
  //     ->where('publicaciones.carrera_id', $carreraId)
  //     ->select('publicaciones.*')
  //     ->get();
  //     $json = response()->json($libros);
  //     return view('recursos.libros.index_libro', compact('json') );
  // }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $editoriales = Editorial::all() ;
    $asignaturas = Asignatura::all(); //esto no es así. Tiene que buscar las asignaturas asociadas a la carrera seleccionada
    $activeTab = 'libro';
    return view('recursos.libros.create_libro', compact('autores', 'carreras', 'asignaturas', 'editoriales', 'activeTab'));
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
      'dewey' => 'required|string|max:255',
      'ISBN' => 'required|string|max:255',
      'editorial_id' => 'required|integer',
      'edicion' => 'required|string|max:255',
      'ejemplares' => 'required|integer',
      'estado' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'asignatura_id' => 'required|integer',
      'anio' => 'required|integer',
      'archivo' => 'required|file|mimes:pdf'
    ]);
    
    $fileName = $request->file('archivo')->store('archivos/libros', 'public');

    $publicacion = Publicacion::create([
        'user_id' => auth()->user()->id, // assuming the user is authenticated
        'titulo' => $validated['titulo'],
        'carrera_id' => $validated['carrera_id'],
        'anio' => $validated['anio'],
        'archivo' => $fileName,
    ]);

    $publicacion->autores()->attach($validated['autor_id']);

    $libro = Libro::create([
        'publicacion_id' => $publicacion->id,
        'dewey' => $validated['dewey'],
        'ISBN' => $validated['ISBN'],
        'editorial_id' => $validated['editorial_id'],
        'edicion' => $validated['edicion'],
        'asignatura_id' => $validated['asignatura_id'],
        'ejemplares' => $validated['ejemplares'],
        'estado' => $validated['estado'],
    ]);
      // $publicacion = $request->only()
      // $formFields['user_id'] = auth()->id();
      
      return redirect('/libros')->with('message', 'Carga de libro exitosa');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Libro $libro)
  {
    Visualizacion::create([
      'user_id' => auth()->user()->id, 
      'publicacion_id' => $libro->publicacion_id,
    ]);
    return view('recursos.libros.show_libro', compact('libro'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Libro $libro)
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $editoriales = Editorial::all() ;
    $asignaturas = $libro->publicaciones->carreras->asignaturas;
    return view('recursos.libros.edit_libro', compact('libro', 'autores', 'carreras', 'asignaturas', 'editoriales'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Libro $libro)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'dewey' => 'required|string|max:255',
      'ISBN' => 'required|string|max:255',
      'editorial_id' => 'required|integer',
      'edicion' => 'required|string|max:255',
      'ejemplares' => 'required|integer',
      'estado' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'asignatura_id' => 'required|integer',
      'anio' => 'required|integer',
    ]);

    if($request->hasFile('archivo')){
      $fileName = $request->file('archivo')->store('archivos/libros', 'public');

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
    
    $libro->publicaciones->update($updatePublicacion);
    $libro->publicaciones->autores()->sync($validated['autor_id']);

    $updateLibro = [
      'dewey' => $validated['dewey'],
      'ISBN' => $validated['ISBN'],
      'editorial_id' => $validated['editorial_id'],
      'edicion' => $validated['edicion'],
      'asignatura_id' => $validated['asignatura_id'],
      'ejemplares' => $validated['ejemplares'],
      'estado' => $validated['estado'],
    ];

    $libro->update($updateLibro);

    return redirect('/libros')->with('message', 'Libro actualizado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Libro $libro)
  {
    //funcionalidad para verificar el ususario y la eliminación del recurso
    $libro->publicaciones->autores()->detach();
    $libro->publicaciones->visualizaciones()->detach();
    $libro->delete() ;
    $libro->publicaciones->delete();

    return redirect('/libros')->with('message','Libro eliminado con éxito');
  }
  
}

?>