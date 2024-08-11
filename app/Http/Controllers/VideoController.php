<?php 

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Video;
use App\Models\Carrera;
use App\Models\Asignatura;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;

class VideoController extends Controller 
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
    $query = Video::with('publicaciones.autores')
      ->join('publicaciones as pub', 'pub.id', '=', 'videos.publicacion_id')
      ->leftJoin('autor_publicacion as ap', 'pub.id', '=', 'ap.publicacion_id')
      ->leftJoin('autores as a', 'ap.autor_id', '=', 'a.id')
      ->leftJoin('asignaturas as ag', 'videos.asignatura_id', '=', 'ag.id')
      ->select('pub.*', 'videos.*', 'ag.nombre as asignatura_nombre', 'a.nombre as autor_nombre') // Selecciona todas las columnas de publicaciones y de videos (v)
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
          ->orWhere('pub.anio', 'like', "%{$buscar}%")
          ->orWhereExists(function ($subSubQuery) use ($buscar) {
              $subSubQuery->select('videos.publicacion_id')
                ->from('videos')
                ->whereColumn('videos.publicacion_id', 'pub.id')
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
        case 'asignatura_asc':
          $query->orderBy('ag.nombre', 'desc');
          break;
        case 'asignatura_desc':
          $query->orderBy('ag.nombre', 'desc');
          break;
      }
    }

    // Get the results
    $videos = $query->paginate(10);
    $activeTab = 'video';
    $carreras = Carrera::all(); 
    return view('recursos.videos.index_video', compact('videos', 'activeTab', 'carreras'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $asignaturas = Asignatura::all();
    $activeTab = 'video';
    return view('recursos.videos.create_video', compact('autores', 'carreras', 'asignaturas', 'activeTab'));
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
      'asignatura_id' => 'required|integer',
      'anio' => 'required|integer',
      'archivo' => 'required|file|mimes:mp4',
      'descripcion' => 'required',
    ]);
    
    $fileName = $request->file('archivo')->store('archivos/videos', 'public');

    $publicacion = Publicacion::create([
        'user_id' => auth()->user()->id, // assuming the user is authenticated
        'titulo' => $validated['titulo'],
        'carrera_id' => $validated['carrera_id'],
        'anio' => $validated['anio'],
        'archivo' => $fileName,
    ]);

    $publicacion->autores()->attach($validated['autor_id']);

    $video = Video::create([
      'publicacion_id' => $publicacion->id,
      'asignatura_id' => $validated['asignatura_id'],
      'descripcion' => $validated['descripcion'],
    ]);
    // $publicacion = $request->only()
    // $formFields['user_id'] = auth()->id();
      
    return redirect('/videos')->with('message', 'Carga de Video exitosa');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Video $video)
  {
    Visualizacion::create([
      'user_id' => auth()->user()->id, 
      'publicacion_id' => $video->publicacion_id,
    ]);
    return view('recursos.videos.show_video', compact('video'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(Video $video)
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $asignaturas = $video->publicaciones->carreras->asignaturas;
    return view('recursos.videos.edit_video', compact('video', 'autores', 'carreras', 'asignaturas'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Video $video)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'asignatura_id' => 'required|integer',
      'anio' => 'required|integer',
      'descripcion' => 'required',
    ]);

    if($request->hasFile('archivo')){
      
      $fileName = $request->file('archivo')->store('archivos/videos', 'public');

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
    $video->publicaciones->update($updatePublicacion);
    //actualiza los autores enlazados a la publicacion
    $video->publicaciones->autores()->sync($validated['autor_id']);

    $updateVideo = [
      'asignatura_id' => $validated['asignatura_id'],
      'descripcion' => $validated['descripcion'],
    ];

    $video->update($updateVideo);

    return redirect('/videos')->with('message', 'Video actualizado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Video $video)
  {
    $video->publicaciones->autores()->detach();
    $video->publicaciones->visualizaciones()->detach();
    $video->delete() ;
    $video->publicaciones->delete();

    return redirect('/videos')->with('message','Video eliminado con éxito');
  }
  
}

?>