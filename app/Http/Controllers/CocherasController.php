<?php

namespace App\Http\Controllers;

use App\Models\cocheras;
use Illuminate\Http\Request;

class CocherasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cocheras = cocheras::all();

        return view("panel.lista_cocheras.index", compact("cocheras"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('panel.lista_cocheras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    

    

    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
        $cantidad = $request->input('cantidad', 1); // Obtiene la cantidad desde el formulario o usa 1 como valor predeterminado
        $piso = $request->input('piso', 1); // Obtiene el piso desde el formulario o usa 1 como valor predeterminado

        for ($i = 0; $i < $cantidad; $i++) {
            cocheras::create([
                'num_lugar' => $this->generateNextNumLugar($piso), // Ajusta esto según tus necesidades
                'piso' => $piso,
            ]);
        }
    

        return redirect()->route('panel.cocheras.index')->with('status', $cantidad . ' cocheras creadas satisfactoriamente');
    }

    private function generateNextNumLugar($piso)
    {
        $lastNumLugar = cocheras::where('piso', $piso)->max('num_lugar');
    
        if ($lastNumLugar !== null) {
            return $lastNumLugar + 1;
        } else {
            // No hay cocheras en este piso, comienza desde 1.
            return 1;
        }
    }
    
    public function show(cocheras $cocheras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cochera = cocheras::findOrFail($id);
        return view("panel.lista_cocheras.edit", ["cochera" => $cochera]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cochera = cocheras::findOrFail($id);

        $cochera->update($request->all());

        return redirect()->route("panel.lista_cocheras.index")->with("status", "Cochera actualizada satisfactoriamente!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cocheras = cocheras::findOrFail($id);

        $cocheras->delete();

        return redirect()->route('panel.cocheras.index')->with('status', 'Cochera eliminada satisfactoriamente');
    }
}
