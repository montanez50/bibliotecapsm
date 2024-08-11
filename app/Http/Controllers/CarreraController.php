<?php 

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Models\LineaDeInvestigacion;

class CarreraController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $activeTab = 'carrera';
    $carreras = Carrera::all();
    return view('administracion.carreras.index_carrera', compact('activeTab', 'carreras'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $activeTab = 'carrera';
    return view('administracion.carreras.create_carrera', compact('activeTab'));
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
    ]);

    $carrera = Carrera::create([
      'nombre' => $validated['nombre']
    ]);

    return redirect('/carreras')->with('message', 'Carga de carrera exitosa');
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
  public function edit(Carrera $carrera)
  {
    $activeTab = 'carrera';
    return view('administracion.carreras.edit_carrera', compact('carrera', 'activeTab'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Carrera $carrera)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
    ]);
    $carrera->update($request->only('nombre'));
    return redirect('/carreras')->with('message', 'Carrera editada con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Carrera $carrera)
  {
    $carrera->delete();
    return redirect('/carreras')->with('message','Carrera eliminada con éxito');
  }
  
  public function getAsignaturas(Carrera $carrera)
  {
    $asignaturas = $carrera->asignaturas->map(function ($data) {
      return "<option value='{$data->id}'>{$data->nombre}</option>";
    })->toArray();
    return response()->json(['data' => implode('', $asignaturas)], 200);
  }

  public function getLineas(Carrera $carrera)
  {
    $lineas = $carrera->lineas->map(function ($data) {
      return "<option value='{$data->id}'>{$data->nombre}</option>";
    })->toArray();
    return response()->json(['data' => implode('', $lineas)], 200);
  }
}

?>