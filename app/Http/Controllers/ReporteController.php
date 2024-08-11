<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Libro;
use App\Models\Video;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;
use App\Models\TrabajoDeGrado;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ProyectoComunitario;

class ReporteController extends Controller
{

    public function generarLibrosPorAsignaturaPDF(){
        $libros = Libro::join('asignaturas as a', 'a.id', '=', 'libros.asignatura_id')
            ->select([
                'a.nombre',
                \DB::raw('COUNT(*) as total'),
                'libros.asignatura_id'
            ])
            ->groupBy('a.nombre', 'libros.asignatura_id')
            ->get();
        
        $librosTotal = Libro::all()->count();
        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = PDF::loadView('reportes.librosPorAsignatura_PDF', compact('libros', 'fecha', 'librosTotal'));
        return $pdf->download('reportes_librosPorAsignatura.pdf');
    }

    public function generarVideosPorAsignaturaPDF(){
        $videos = Video::join('asignaturas as a', 'a.id', '=', 'videos.asignatura_id')
        ->select([
            'a.nombre',
            \DB::raw('COUNT(*) as total'),
        ])
        ->groupBy('a.nombre', 'asignatura_id')
        ->get();
    
        $videosTotal = Video::all()->count();
        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = PDF::loadView('reportes.videosPorAsignatura_PDF', compact('videos', 'fecha', 'videosTotal'));
        return $pdf->download('reportes_videosPorAsignatura.pdf');
    }


    public function generarPDFVisualizacionesMensuales()
    {
        // Obtener el mes actual
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
                $userVisualizaciones = $visualizaciones->where('user_id', $user->id);
                $user->visualizaciones = $userVisualizaciones->count();
                $user->visualizacionesDetalles = $userVisualizaciones->map(function($vis) {
                    $publicacion = Publicacion::find($vis->publicacion_id); // Asume que tienes un modelo Publicacion
                    return [
                        'nombre_recurso' => $publicacion ? $publicacion->titulo : 'Desconocido',
                        'fecha' => $vis->created_at->format('d-m-Y H:i:s'),
                    ];
                });
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
                    'porcentaje' => $porcentaje,
                    'usuarios' => $group,
                ];
            });

        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('reportes.consultasMensuales_PDF', compact('visualizacionesPorRol', 'totalVisualizaciones', 'fecha'));
        return $pdf->download('visualizacionesDelMes.pdf');
    }


    public function generarPDFVisualizacionesPorFechas(Request $request)
    {
        $fechaInicio = Carbon::parse($request->input('fecha_inicio'));
        $fechaFin = Carbon::parse($request->input('fecha_fin'))->endOfDay();
        $recursoId = $request->input('recurso');

        $visualizaciones = Visualizacion::whereBetween('created_at', [$fechaInicio, $fechaFin])
            ->when($recursoId, function($query, $recursoId) {
                return $query->where('publicacion_id', $recursoId);
            })
            ->get();

        $totalVisualizaciones = $visualizaciones->count();

        $visualizacionesPorRol = User::with('roles')
            ->whereHas('roles', function($query) {
                $query->whereIn('name', ['Personal Administrativo', 'Docente', 'Estudiante']);
            })
            ->get()
            ->map(function($user) use ($visualizaciones) {
                $userVisualizaciones = $visualizaciones->where('user_id', $user->id);
                $user->visualizaciones = $userVisualizaciones->count();
                $user->visualizacionesDetalles = $userVisualizaciones->map(function($vis) use ($user) {
                    $publicacion = Publicacion::find($vis->publicacion_id);
                    return [
                        'nombre_usuario' => $user->nombres,
                        'nombre_recurso' => $publicacion ? $publicacion->titulo : 'Desconocido',
                        'fecha' => $vis->created_at->format('d-m-Y H:i:s'),
                    ];
                });
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
                    'porcentaje' => $porcentaje,
                    'usuarios' => $group,
                ];
            });

        $fechaGeneracion = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('reportes.consultasPorFecha_PDF', compact('visualizacionesPorRol', 'totalVisualizaciones', 'fechaGeneracion', 'fechaInicio', 'fechaFin', 'recursoId'));
        return $pdf->download('visualizacionesPorFecha.pdf');
    }


    public function getPublicaciones($tipo)
    {
        switch($tipo){
            case 1:
                $publicacion = Libro::with('publicaciones')->get();
                $publicacionMap = $publicacion->map(function ($data) {
                    return "<option value='{$data->publicacion_id}'>{$data->publicaciones->titulo}</option>";
                  })->toArray();
                break;
            case 2:
                $publicacion = TrabajoDeGrado::with('publicaciones')->get();
                $publicacionMap = $publicacion->map(function ($data) {
                    return "<option value='{$data->publicacion_id}'>{$data->publicaciones->titulo}</option>";
                  })->toArray();
                break;
            case 3:
                $publicacion = ProyectoComunitario::with('publicaciones')->get();
                $publicacionMap = $publicacion->map(function ($data) {
                    return "<option value='{$data->publicacion_id}'>{$data->publicaciones->titulo}</option>";
                  })->toArray();
                break;
            case 4:
                $publicacion = Video::with('publicaciones')->get();
                $publicacionMap = $publicacion->map(function ($data) {
                    return "<option value='{$data->publicacion_id}'>{$data->publicaciones->titulo}</option>";
                  })->toArray();
                break;
        }

        // $publicaciones = $publicacionMap->map(function ($data) {
        //     return "<option value='{$data->id}'>{$data->titulo}</option>";
        //   })->toArray();

        return response()->json(['data' => implode('', $publicacionMap)], 200);
    }

    // :(
    // public function getPublicaciones($tipo)
    // {
    //     switch($tipo){
    //         case 1:
    //             $publicacion = Libro::with('publicaciones')->get();
    //             $publicacionMap = $publicacion->map(function ($pub)
    //             {
    //                 return [
    //                     'id' => $pub->publicacion_id,
    //                     'titulo' => $pub->publicaciones->titulo
    //                 ];
    //             });
    //             break;
    //         case 2:
    //             $publicacion = TrabajoDeGrado::with('publicaciones')->get();
    //             $publicacionMap = $publicacion->map(function ($pub)
    //             {
    //                 return [
    //                     'id' => $pub->publicacion_id,
    //                     'titulo' => $pub->publicaciones->titulo
    //                 ];
    //             });
    //             break;
    //         case 3:
    //             $publicacion = ProyectoComunitario::with('publicaciones')->get();
    //             $publicacionMap = $publicacion->map(function ($pub)
    //             {
    //                 return [
    //                     'id' => $pub->publicacion_id,
    //                     'titulo' => $pub->publicaciones->titulo
    //                 ];
    //             });
    //             break;
    //         case 4:
    //             $publicacion = Video::with('publicaciones')->get();
    //             $publicacionMap = $publicacion->map(function ($pub)
    //             {
    //                 return [
    //                     'id' => $pub->publicacion_id,
    //                     'titulo' => $pub->publicaciones->titulo
    //                 ];
    //             });
    //             break;
    //     }
    //     return response()->json($publicacionMap);
    // }

    
    public function generarPDFPersonal()
    {
        $usuarios = User::role('Personal Administrativo')->get();
        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('reportes.listadoUsuarios_PDF', compact('usuarios', 'fecha'));
        return $pdf->download('personal_administrativo.pdf');
    }

    public function generarPDFDocentes()
    {
        $usuarios = User::role('Docente')->get();
        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('reportes.listadoUsuarios_PDF', compact('usuarios', 'fecha'));
        return $pdf->download('docentes.pdf');
    }

    public function generarPDFEstudiantes()
    {
        $usuarios = User::role('Estudiante')->get();
        $fecha = Carbon::now()->format('d-m-Y H:i:s');

        $pdf = Pdf::loadView('reportes.listadoUsuarios_PDF', compact('usuarios', 'fecha'));
        return $pdf->download('estudiantes.pdf');
    }

}
