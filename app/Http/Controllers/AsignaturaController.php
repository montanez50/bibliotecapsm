<?php 

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Asignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $activeTab = 'asignatura';
    $asignaturas = Asignatura::all();
    return view('administracion.asignaturas.index_asignatura', compact('activeTab', 'asignaturas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $activeTab = 'asignatura';
    $carreras = Carrera::all();
    return view('administracion.asignaturas.create_asignatura', compact('activeTab', 'carreras'));
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
      'carrera_id' => 'required'
    ]);

    $asignatura = Asignatura::create([
      'nombre' => $validated['nombre']
    ]);

    $asignatura->carreras()->attach($validated['carrera_id']);

    return redirect('/asignaturas')->with('message', 'Carga de asignatura exitosa');
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
  public function edit(Asignatura $asignatura)
  {
    $carreras = Carrera::all();
    $activeTab = 'asignatura';
    return view('administracion.asignaturas.edit_asignatura', compact('asignatura', 'carreras', 'activeTab'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Asignatura $asignatura)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
      'carrera_id' => 'required'
    ]);

    $asignatura->update($request->only('nombre'));
    $asignatura->carreras()->sync($validated['carrera_id']);
    return redirect('/asignaturas')->with('message', 'Asignatura editada con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Asignatura $asignatura)
  {
    
    $asignatura->carreras()->detach();
    $asignatura->delete();
    return redirect('/asignaturas')->with('message','Asignatura eliminada con éxito');
  }
  
}

?>