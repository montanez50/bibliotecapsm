<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\GuiaAcademica;
use App\Models\Carrera;
use App\Models\Asignatura;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use App\Models\Visualizacion;

class GuiaAcademicaController extends Controller
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
      $query = GuiaAcademica::with('publicaciones.autores')
        ->join('publicaciones as pub', 'pub.id', '=', 'guias_academicas.publicacion_id')
        ->leftJoin('autor_publicacion as ap', 'pub.id', '=', 'ap.publicacion_id')
        ->leftJoin('autores as a', 'ap.autor_id', '=', 'a.id')
        ->leftJoin('asignaturas as ag', 'guias_academicas.asignatura_id', '=', 'ag.id')
        ->select('pub.*', 'guias_academicas.*', 'ag.nombre as asignatura_nombre', 'a.nombre as autor_nombre') // Selecciona todas las columnas de publicaciones y de guias_academicas (v)
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
                $subSubQuery->select('guias_academicas.publicacion_id')
                  ->from('guias_academicas')
                  ->whereColumn('guias_academicas.publicacion_id', 'pub.id')
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
      $guias = $query->paginate(10);
      $activeTab = 'guia';
      $carreras = Carrera::all(); 
      return view('recursos.guias_academicas.index', compact('guias', 'activeTab', 'carreras'));
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
      $activeTab = 'guia';
      return view('recursos.guias_academicas.create', compact('autores', 'carreras', 'asignaturas', 'activeTab'));
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
        'archivo' => 'required|file|mimes:pdf',
        'descripcion' => 'required',
      ]);
      
      $fileName = $request->file('archivo')->store('archivos/guias_academicas', 'public');
  
      $publicacion = Publicacion::create([
          'user_id' => auth()->user()->id, // assuming the user is authenticated
          'titulo' => $validated['titulo'],
          'carrera_id' => $validated['carrera_id'],
          'anio' => $validated['anio'],
          'archivo' => $fileName,
      ]);
  
      $publicacion->autores()->attach($validated['autor_id']);
  
      $guia = GuiaAcademica::create([
        'publicacion_id' => $publicacion->id,
        'asignatura_id' => $validated['asignatura_id'],
        'descripcion' => $validated['descripcion'],
      ]);
      // $publicacion = $request->only()
      // $formFields['user_id'] = auth()->id();
        
      return redirect('/guias')->with('message', 'Carga de guía exitosa');
    }
  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(GuiaAcademica $guia)
    {
      Visualizacion::create([
        'user_id' => auth()->user()->id, 
        'publicacion_id' => $guia->publicacion_id,
      ]);
      return view('recursos.guias_academicas.show', compact('guia'));
    }
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(GuiaAcademica $guia)
    {
      $autores = Autor::all() ;
      $carreras = Carrera::all();
      $asignaturas = $guia->publicaciones->carreras->asignaturas;
      return view('recursos.guias_academicas.edit', compact('guia', 'autores', 'carreras', 'asignaturas'));
    }
  
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, GuiaAcademica $guia)
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
        
        $fileName = $request->file('archivo')->store('archivos/guias_academicas', 'public');
  
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
      $guia->publicaciones->update($updatePublicacion);
      //actualiza los autores enlazados a la publicacion
      $guia->publicaciones->autores()->sync($validated['autor_id']);
  
      $updateGuia = [
        'asignatura_id' => $validated['asignatura_id'],
        'descripcion' => $validated['descripcion'],
      ];
  
      $guia->update($updateGuia);
  
      return redirect('/guias')->with('message', 'Guía actualizada con éxito');
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(GuiaAcademica $guia)
    {
      $guia->publicaciones->autores()->detach();
      $guia->publicaciones->visualizaciones()->detach();
      $guia->delete() ;
      $guia->publicaciones->delete();
  
      return redirect('/guias')->with('message','Guía eliminada con éxito');
    }
    
  }
