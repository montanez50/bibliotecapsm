<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\ProyectoComunitario;
use App\Models\TrabajoDeGrado;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Users
        $admins = User::role('Administrador')->count();
        $estudiantes = User::role('Estudiante')->count();
        $docentes = User::role('Docente')->count();
        $personalAdministrativo = User::role('Personal Administrativo')->count();

        // Publics
        $libros = Libro::all()->count();
        $tdg = TrabajoDeGrado::all()->count();
        $proyectos = ProyectoComunitario::all()->count();
        $videos = Video::all()->count();

        return view('index', compact('admins', 'estudiantes', 'docentes', 'personalAdministrativo', 'libros', 'tdg', 'proyectos', 'videos'));
    }
}
