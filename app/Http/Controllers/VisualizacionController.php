<?php 

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Libro;
use App\Models\Video;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;

class VisualizacionController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    //
  }
  
  public function reportes(){
    $libros = Libro::join('asignaturas as a', 'a.id', '=', 'libros.asignatura_id')
      ->select([
        'a.nombre',
        \DB::raw('COUNT(*) as total'),
      ])
      ->groupBy('a.nombre' ,'asignatura_id')
      ->get();
      
    $librosTotal = Libro::all()->count();
    
    $videos = Video::join('asignaturas as a', 'a.id', '=', 'videos.asignatura_id')
      ->select([
        'a.nombre',
        \DB::raw('COUNT(*) as total'),
      ])
      ->groupBy('a.nombre', 'asignatura_id')
      ->get();
    
    $videosTotal = Video::all()->count();

    $inicioMes = Carbon::now()->startOfMonth();
    $finMes = Carbon::now()->endOfMonth();

    // Obtener las visualizaciones del mes en curso
    $visualizaciones = Visualizacion::whereBetween('created_at', [$inicioMes, $finMes])->get();

    // Obtener el total de visualizaciones del mes en curso
    $totalVisualizaciones = $visualizaciones->count();

    // Obtener las visualizaciones por rol
    $visualizacionesPorRol = User::with('roles')
            ->whereHas('roles', function($query) {
                $query->whereIn('name', ['Personal Administrativo', 'Docente', 'Estudiante']);
            })
            ->get()
            ->map(function($user) use ($visualizaciones) {
                $user->visualizaciones = $visualizaciones->where('user_id', $user->id)->count();
                return $user;
            })
            ->groupBy(function($user) {
                return $user->roles->pluck('name')->first();
            })
            ->map(function($group) use ($totalVisualizaciones) {
                $totalPorRol = $group->sum('visualizaciones');
                $porcentaje = $totalPorRol > 0 ? ($totalPorRol / $totalVisualizaciones) * 100 : 0;
                return [
                    'total' => $totalPorRol,
                    'porcentaje' => $porcentaje
                ];
            });
    return view('reportes.reportes', compact('libros', 'videos', 'librosTotal', 'videosTotal', 'visualizacionesPorRol', 'totalVisualizaciones'));
}
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>