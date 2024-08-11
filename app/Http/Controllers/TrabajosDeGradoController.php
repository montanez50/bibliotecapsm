<?php 

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Autor;
use App\Models\Carrera;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;
use App\Models\TrabajoDeGrado;
use App\Models\LineaDeInvestigacion;

class TrabajosDeGradoController extends Controller 
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
    $query = TrabajoDeGrado::with('publicaciones.autores')
      ->join('publicaciones as pub', 'trabajos_de_grado.publicacion_id', '=', 'pub.id')
      ->leftJoin('autor_publicacion as ap', 'trabajos_de_grado.publicacion_id', '=', 'ap.publicacion_id')
      ->leftJoin('autores as a', 'ap.autor_id', '=', 'a.id')
      ->leftJoin('lineas_de_investigacion as lineas', 'trabajos_de_grado.linea_de_investigacion_id', '=', 'lineas.id')
      ->select('pub.*', 'trabajos_de_grado.*', 'lineas.nombre as linea_nombre') // Selecciona todas las columnas de publicaciones y de trabajos_de_grado (tdg)
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
          ->orWhere('trabajos_de_grado.descriptores', 'like', "%{$buscar}%")
          ->orWhere('lineas.nombre', 'like', "%{$buscar}%")
          ->orWhere('pub.anio', 'like', "%{$buscar}%")
          ->orWhereExists(function ($subSubQuery) use ($buscar) {
            $subSubQuery->select('trabajos_de_grado.publicacion_id')
              ->from('trabajos_de_grado')
              ->whereColumn('trabajos_de_grado.publicacion_id', 'pub.id')
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
        case 'mencion_asc':
          $query->orderBy('trabajos_de_grado.mencion', 'asc');
          break;
        case 'mencion_desc':
            $query->orderBy('trabajos_de_grado.mencion', 'desc');
            break;
      }
    }

    // Get the results
    $tdg = $query->paginate(10);
    $activeTab = 'tdg';
    $carreras = Carrera::all(); 
    return view('recursos.tdg.index_tdg', compact('tdg', 'activeTab', 'carreras'));
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
    $lineas = LineaDeInvestigacion::all();
    $docentes = User::role('Docente')->get();
    $activeTab = 'tdg';
    return view('recursos.tdg.create_tdg', compact('autores', 'carreras', 'lineas', 'docentes', 'activeTab'));
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
      'linea_de_investigacion_id' => 'required|integer',
      'tutor' => 'required|string|max:70',
      'resumen' => 'required',
      'descriptores' => 'required|string|',
      'mencion' => 'required|string|max:30',
    ]);
    
    $fileName = $request->file('archivo')->store('archivos/tdg', 'public');

    $publicacion = Publicacion::create([
      'user_id' => auth()->user()->id, // assuming the user is authenticated
      'titulo' => $validated['titulo'],
      'carrera_id' => $validated['carrera_id'],
      'anio' => $validated['anio'],
      'archivo' => $fileName,
    ]);

    $publicacion->autores()->attach($validated['autor_id']);

    $tdg = TrabajoDeGrado::create([
      'publicacion_id' => $publicacion->id,
      'linea_de_investigacion_id' => $validated['linea_de_investigacion_id'],
      'tutor' => $validated['tutor'],
      'resumen' => $validated['resumen'],
      'descriptores' => $validated['descriptores'],
      'mencion' => $validated['mencion'],
    ]);
      // $publicacion = $request->only()
      // $formFields['user_id'] = auth()->id();
      
    return redirect('/tdg')->with('message', 'Carga de Trabajo de Grado exitosa');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(TrabajoDeGrado $tdg)
  {
    Visualizacion::create([
      'user_id' => auth()->user()->id, 
      'publicacion_id' => $tdg->publicacion_id,
    ]);
    return view('recursos.tdg.show_tdg', compact('tdg'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(TrabajoDeGrado $tdg)
  {
    $autores = Autor::all() ;
    $carreras = Carrera::all();
    $lineas = $tdg->publicaciones->carreras->lineas;
    $docentes = User::role('Docente')->get();
    return view('recursos.tdg.edit_tdg', compact('tdg', 'autores', 'carreras', 'docentes', 'lineas',));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, TrabajoDeGrado $tdg)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor_id' => 'required',
      'carrera_id' => 'required|integer',
      'anio' => 'required|integer',
      'linea_de_investigacion_id' => 'required|integer',
      'tutor' => 'required|string|max:70',
      'resumen' => 'required',
      'descriptores' => 'required|string|',
      'mencion' => 'required|string|max:30',
    ]);
    if($request->hasFile('archivo')){
      
      $fileName = $request->file('archivo')->store('archivos/tdg', 'public');

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

    $tdg->publicaciones->update($updatePublicacion);
    $tdg->publicaciones->autores()->sync($validated['autor_id']);

    $updateTdg = [
      'linea_de_investigacion_id' => $validated['linea_de_investigacion_id'],
      'tutor' => $validated['tutor'],
      'resumen' => $validated['resumen'],
      'descriptores' => $validated['descriptores'],
      'mencion' => $validated['mencion'],
    ];
      // $publicacion = $request->only()
      // $formFields['user_id'] = auth()->id();
    
    $tdg->update($updateTdg);
    return redirect('/tdg')->with('message', 'Trabajo de Grado actualizado con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(TrabajoDeGrado $tdg)
  {
    $tdg->publicaciones->autores()->detach();
    $tdg->publicaciones->visualizaciones()->detach();
    $tdg->delete();
    $tdg->publicaciones->delete();

    return redirect('/tdg')->with('message','Trabajo de Grado eliminado con éxito');
  }
  
}

?>