<?php 

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;
use App\Models\LineaDeInvestigacion;

class LineaDeInvestigacionController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $activeTab = 'linea';
    $lineas = LineaDeInvestigacion::all();
    return view('administracion.lineas.index_linea', compact('activeTab', 'lineas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $activeTab = 'linea';
    $carreras = Carrera::all();
    return view('administracion.lineas.create_linea', compact('activeTab', 'carreras'));
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
      'carrera_id' => 'required|integer'
    ]);
    $linea = LineaDeInvestigacion::create([
      'nombre' => $validated['nombre'],
      'carrera_id' => $validated['carrera_id']
    ]);

    return redirect('/lineas')->with('message', 'Línea de investicación creada con éxito');
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
  public function edit(LineaDeInvestigacion $linea)
  {
    $carreras = Carrera::all();
    $activeTab = 'linea';
    return view('administracion.lineas.edit_linea', compact('linea', 'carreras', 'activeTab'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, LineaDeInvestigacion $linea)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
      'carrera_id' => 'required'
    ]);

    $linea->update($validated);
    return redirect('/lineas')->with('message', 'Línea de investigación editada con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(LineaDeInvestigacion $linea)
  {
    $linea->delete();
    return redirect('/lineas')->with('message','Línea de investigación eliminada con éxito');
  }
  
}

?>