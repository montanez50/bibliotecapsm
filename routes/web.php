<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\GuiaAcademicaController;
use App\Http\Controllers\VisualizacionController;
use App\Http\Controllers\TrabajosDeGradoController;
use App\Http\Controllers\ProyectoComunitarioController;
use App\Http\Controllers\LineaDeInvestigacionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//mostrar index (homepage)
Route::middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/libro-first-page/{id}', [PdfController::class, 'libroShowFirstPageAsImage']);
    Route::group(['middleware', 'can:manage libros'], function(){
        //mostrar formulario de creación de registro (Libros)
        Route::get('/libros/create', [LibroController::class, 'create'])->name('libro.create');

        // Ejecutar registro con los datos provistos
        Route::post('/libros', [LibroController::class, 'store'])->name('libro.store');
    });

    //Mostrar listado de libros
    Route::get('/libros', [LibroController::class, 'index'])->name('libro.index');
    Route::group(['middleware', 'can:manage libros'], function(){
        //mostrar formulario de edición de libros
        Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libro.edit');

        //actualizar libro
        Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libro.update');

        //eliminar libro
        Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libro.destroy');
    });
    
    //mostrar un solo libro y sus datos asociados
    Route::get('libros/{libro}', [LibroController::class, 'show'])->name('libro.show');

    Route::group(['middleware', 'can:manage tdg'], function(){
        //mostrar formulario de creación de registro (Trabajos de Grado)
        Route::get('/tdg/create', [TrabajosDeGradoController::class, 'create'])->name('tdg.create');

        // Ejecutar registro con los datos provistos
        Route::post('/tdg', [TrabajosDeGradoController::class, 'store'])->name('tdg.store');
    });

    //Mostrar listado de tdg
    Route::get('/tdg', [TrabajosDeGradoController::class, 'index'])->name('tdg.index');
    
    Route::group(['middleware', 'can:manage tdg'], function(){
        //mostrar formulario de edición de trabajos de grado
        Route::get('/tdg/{tdg}/edit', [TrabajosDeGradoController::class, 'edit'])->name('tdg.edit');

        //actualizar trbajo de grado
        Route::put('/tdg/{tdg}', [TrabajosDeGradoController::class, 'update'])->name('tdg.update');

        //eliminar trabajo de grado
        Route::delete('/tdg/{tdg}', [TrabajosDeGradoController::class, 'destroy'])->name('tdg.destroy');
    });

    //mostrar un solo trabajo de grado y sus datos asociados
    Route::get('tdg/{tdg}', [TrabajosDeGradoController::class, 'show'])->name('tdg.show');

    Route::group(['middleware', 'can:manage proyectos'], function(){
        //mostrar formulario de creación de registro (Proyectos Comunitarios)
        Route::get('/proyectos/create', [ProyectoComunitarioController::class, 'create'])->name('proyecto.create');

        // Ejecutar registro con los datos provistos
        Route::post('/proyectos', [ProyectoComunitarioController::class, 'store'])->name('proyecto.store');
    });

    //Mostrar listado de proyectos
    Route::get('/proyectos', [ProyectoComunitarioController::class, 'index'])->name('proyecto.index');

    Route::group(['middleware', 'can:manage proyectos'], function(){
        //mostrar formulario de edición de proyectos comunitarios
        Route::get('/proyectos/{proyecto}/edit', [ProyectoComunitarioController::class, 'edit'])->name('proyecto.edit');

        //actualizar proyecto comunitario
        Route::put('/proyectos/{proyecto}', [ProyectoComunitarioController::class, 'update'])->name('proyecto.update');

        //eliminar proyecto
        Route::delete('/proyectos/{proyecto}', [ProyectoComunitarioController::class, 'destroy'])->name('proyecto.destroy');
    });

    //mostrar un solo proyecto y sus datos asociados
    Route::get('proyectos/{proyecto}', [ProyectoComunitarioController::class, 'show'])->name('proyecto.show');

    Route::group(['middleware', 'can:manage videos'], function(){
        //mostrar formulario de creación de registro (videos)
        Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');

        // Ejecutar registro con los datos provistos
        Route::post('/videos', [VideoController::class, 'store'])->name('video.store');
    });

    //Mostrar listado de videos
    Route::get('/videos', [VideoController::class, 'index'])->name('video.index');

    Route::group(['middleware', 'can:manage videos'], function(){
        //mostrar formulario de edición de videos 
        Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('video.edit');

        //actualizar video 
        Route::put('/videos/{video}', [VideoController::class, 'update'])->name('video.update');

        //eliminar video
        Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
    });

    //mostrar un solo video y sus datos asociados
    Route::get('videos/{video}', [VideoController::class, 'show'])->name('video.show');

    Route::group(['middleware', 'can:manage guias'], function(){
        //mostrar formulario de creación de registro (guías académicas)
        Route::get('/guias/create', [GuiaAcademicaController::class, 'create'])->name('guia.create');

        // Ejecutar registro con los datos provistos
        Route::post('/guias', [GuiaAcademicaController::class, 'store'])->name('guia.store');
    });

    //Mostrar listado de guías
    Route::get('/guias', [GuiaAcademicaController::class, 'index'])->name('guia.index');

    Route::group(['middleware', 'can:manage guias'], function(){
        //mostrar formulario de edición de videos 
        Route::get('/guias/{guia}/edit', [GuiaAcademicaController::class, 'edit'])->name('guia.edit');

        //actualizar video 
        Route::put('/guias/{guia}', [GuiaAcademicaController::class, 'update'])->name('guia.update');

        //eliminar guía
        Route::delete('/guias/{guia}', [GuiaAcademicaController::class, 'destroy'])->name('guia.destroy');
    });

    //mostrar una sola guía y sus datos asociados
    Route::get('guias/{guia}', [GuiaAcademicaController::class, 'show'])->name('guia.show');

    Route::group(['middleware', 'can:manage dbfields'], function(){
        //administración de carreras (forma para crear, registrar, mostrar listado, forma para editar, actualizar, eliminar)
        Route::get('/carreras/create', [CarreraController::class, 'create'])->name('carrera.create');
        Route::post('/carreras', [CarreraController::class, 'store'])->name('carrera.store');
        Route::get('/carreras', [CarreraController::class, 'index'])->name('carrera.index');
        Route::get('/carreras/{carrera}/edit', [CarreraController::class, 'edit'])->name('carrera.edit');
        Route::put('/carreras/{carrera}', [CarreraController::class, 'update'])->name('carrera.update');
        Route::delete('/carreras/{carrera}', [CarreraController::class, 'destroy'])->name('carrera.destroy');

        //administración de asignaturas (forma para crear, registrar, mostrar listado, forma para editar, actualizar, eliminar)
        Route::get('/asignaturas/create', [AsignaturaController::class, 'create'])->name('asignatura.create');
        Route::post('/asignaturas', [AsignaturaController::class, 'store'])->name('asignatura.store');
        Route::get('/asignaturas', [AsignaturaController::class, 'index'])->name('asignatura.index');
        Route::get('/asignaturas/{asignatura}/edit', [AsignaturaController::class, 'edit'])->name('asignatura.edit');
        Route::put('/asignaturas/{asignatura}', [AsignaturaController::class, 'update'])->name('asignatura.update');
        Route::delete('/asignaturas/{asignatura}', [AsignaturaController::class, 'destroy']);

        //administración de líneas de investigación (forma para crear, registrar, mostrar listado, forma para editar, actualizar, eliminar)
        Route::get('/lineas/create', [LineaDeInvestigacionController::class, 'create'])->name('linea.create');
        Route::post('/lineas', [LineaDeInvestigacionController::class, 'store'])->name('linea.store');
        Route::get('/lineas', [LineaDeInvestigacionController::class, 'index'])->name('linea.index');
        Route::get('/lineas/{linea}/edit', [LineaDeInvestigacionController::class, 'edit'])->name('linea.edit');
        Route::put('/lineas/{linea}', [LineaDeInvestigacionController::class, 'update'])->name('linea.update');
        Route::delete('/lineas/{linea}', [LineaDeInvestigacionController::class, 'destroy'])->name('linea.destroy');

        //administración de autores (forma para crear, registrar, mostrar listado, forma para editar, actualizar, eliminar)
        Route::get('/autores/create', [AutorController::class, 'create'])->name('autor.create');
        Route::post('/autores', [AutorController::class, 'store'])->name('autor.store');
        Route::get('/autores', [AutorController::class, 'index'])->name('autor.index');
        Route::get('/autores/{autor}/edit', [AutorController::class, 'edit'])->name('autor.edit');
        Route::put('/autores/{autor}', [AutorController::class, 'update'])->name('autor.update');
        Route::delete('/autores/{autor}', [AutorController::class, 'destroy'])->name('autor.destroy');

        //administración de editoriales (forma para crear, registrar, mostrar listado, forma para editar, actualizar, eliminar)
        Route::get('/editoriales/create', [EditorialController::class, 'create'])->name('editorial.create');
        Route::post('/editoriales', [EditorialController::class, 'store'])->name('editorial.store');
        Route::get('/editoriales', [EditorialController::class, 'index'])->name('editorial.index');
        Route::get('/editoriales/{editorial}/edit', [EditorialController::class, 'edit'])->name('editorial.edit');
        Route::put('/editoriales/{editorial}', [EditorialController::class, 'update'])->name('editorial.update');
        Route::delete('/editoriales/{editorial}', [EditorialController::class, 'destroy'])->name('editorial.destroy');
    });

    Route::group(['middleware', 'can:manage users'], function(){
        // mostrar form para registrar admin
        Route::get('/usuarios/registrar', [UserController::class, 'create'])->name('user.create');

        // submit reg admin
        Route::post('/usuarios', [UserController::class, 'store'])->name('user.store');

        //mostrar listado de administradores
        Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
        Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('user.destroy');
    });
    
    Route::group(['middleware', 'can:reportes'], function(){
        Route::get('/reportes', [VisualizacionController::class, 'reportes'])->name('reportes');
    });

    Route::group(['middleware', 'can:reportes visualización de documentos'], function(){
        //Generación de listados y reportes
        Route::get('/reportes/librosPorAsignatura/pdf', [ReporteController::class, 'generarLibrosPorAsignaturaPDF'])->name('reportes.pdf.librosPorAsignatura');
        Route::get('/reportes/videosPorAsignatura/pdf', [ReporteController::class, 'generarVideosPorAsignaturaPDF'])->name('reportes.pdf.videosPorAsignatura');
        Route::get('/reportes/pdf/visualizacionesMensuales', [ReporteController::class, 'generarPDFVisualizacionesMensuales'])->name('reportes.pdf.visualizacionesMensuales');
        Route::post('/reportes/pdf/visualizacionesPorFechas', [ReporteController::class, 'generarPDFVisualizacionesPorFechas'])->name('reportes.pdf.visualizacionesPorFechas');
    });

    Route::group(['middleware', 'can:reportes listado de usuarios'], function(){
    Route::get('/reportes/pdf/personal', [ReporteController::class, 'generarPDFPersonal'])->name('reportes.pdf.personal');
    Route::get('/reportes/pdf/docentes', [ReporteController::class, 'generarPDFDocentes'])->name('reportes.pdf.docentes');
    Route::get('/reportes/pdf/estudiantes', [ReporteController::class, 'generarPDFEstudiantes'])->name('reportes.pdf.estudiantes');
    });

    Route::get('/get-asignaturas/{carrera}', [CarreraController::class, 'getAsignaturas'])->name('show.asignaturas');
    Route::get('/get-lineas/{carrera}', [CarreraController::class, 'getLineas'])->name('show.lineas');
    Route::get('/get-publicaciones/{tipo}', [ReporteController::class, 'getPublicaciones'])->name('get.publicaciones');

    Route::group(['middleware', 'can:backups'], function(){
        //crear respaldos de la base de datos
        Route::get('/avanzadas', [BackupController::class, 'show'])->name('avanzadas');
        Route::get('/backup/create', [BackupController::class, 'create']);
        Route::get('/backup/restore/{backupPath}', [BackupController::class, 'restore']);
        Route::get('/backup/clean', [BackupController::class, 'clean']);
    });
});

Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate'])->name('login.post')->middleware('guest');
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


// //mostrar listado de docentes
// Route::get('/list-docente', [DocenteController::class, 'index']);

// //mostrar form para registrar docente
// Route::get('/reg-docente', [DocenteController::class, 'create']);

// //mostrar listado de estudiantes
// Route::get('/list-estudiante', [EstudianteController::class, 'index']);

// //mostrar form para registrar estudiante
// Route::get('/reg-estudiante', [EstudianteController::class, 'create']);

// //mostrar listado de personal administrativo
// Route::get('/list-pers-admin', [Pers_AdminController::class, 'index']);

// //mostrar form para registrar personal administrativo
// Route::get('/reg-pers-admin', [Pers_AdminController::class, 'create']);

// Route::get('/reg-libro', function () {
//     return view('recursos.reg-libro');
// });

// Route::get('/reg-tdg', function () {
//     return view('recursos.reg-tdg');
// });