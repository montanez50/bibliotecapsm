<?php 

namespace App\Http\Controllers;

use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $activeTab = 'editorial';
    $editoriales = Editorial::all();
    return view('administracion.editoriales.index_editorial', compact('activeTab', 'editoriales'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    $activeTab = 'editorial';
    return view('administracion.editoriales.create_editorial', compact('activeTab'));
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

    $editorial = Editorial::create([
      'nombre' => $validated['nombre']
    ]);

    return redirect('/editoriales')->with('message', 'Carga de editorial exitosa');
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
  public function edit(Editorial $editorial)
  {
    $activeTab = 'editorial';
    return view('administracion.editoriales.edit_editorial', compact('editorial', 'activeTab'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, Editorial $editorial)
  {
    $validated = $request->validate([
      'nombre' => 'required|string|max:50',
    ]);
    $editorial->update($request->only('nombre'));
    return redirect('/editoriales')->with('message', 'Editorial editada con éxito');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Editorial $editorial)
  {
    $editorial->delete();
    return redirect('/editoriales')->with('message','Editorial eliminada con éxito');
  }
  
}

?>