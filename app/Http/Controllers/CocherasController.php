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
        $ultimoPiso = cocheras::max('piso');
        
        $piso = $ultimoPiso + 1;

        return view('panel.lista_cocheras.create', compact('piso'));
    }

    /**
     * Store a newly created resource in storage.
     */
    

    

    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
        $rules = [
            'num_lugar' => 'required|numeric|min:1|max:200|regex:/^[A-Za-z0-9\s]+$/',
        ];
        
        // Define los mensajes de error personalizados
        $messages = [
            'num_lugar.required' => 'El campo Cantidad de cocheras es obligatorio.',
            'num_lugar.min' => 'La cantidad de cocheras debe ser al menos 1.',
            'num_lugar.max' => 'La cantidad de cocheras no debe ser más de 200.',
            'num_lugar.regex' => 'La cantidad de cocheras no debe contener caracteres especiales.',
        ];

        $request->validate($rules, $messages);

        $cantidad = $request->input('num_lugar', 1); // Obtiene la cantidad desde el formulario o usa 1 como valor predeterminado

        $ultimoPiso = cocheras::max('piso'); // Obtener el piso más alto existente

        for ($i = 0; $i < $cantidad; $i++) {
            cocheras::create([
                'num_lugar' => $this->generateNextNumLugar($ultimoPiso + 1), // Generar número de lugar para el siguiente piso
                'piso' => $ultimoPiso + 1, // Establecer el siguiente piso
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

    public function destroyByPiso(Request $request)
    {
        $pisos = cocheras::distinct()->pluck('piso');

        return view('panel.lista_cocheras.delete', compact('pisos'));
    }

    public function deleteByPiso(Request $request)
    {
        $piso = $request->input('piso');

        // Eliminar cocheras del piso seleccionado
        cocheras::where('piso', $piso)->delete();

        // También puedes eliminar el piso en sí si es necesario
        // cocheras::where('piso', $piso)->delete();

        return redirect()->route('panel.cocheras.index')->with('status', 'Cocheras del piso ' . $piso . ' eliminadas satisfactoriamente');
    }

    
    public function destroy($id)
    {
        $cocheras = cocheras::findOrFail($id);

        $cocheras->delete();

        return redirect()->route('panel.cocheras.index')->with('status', 'Cochera eliminada satisfactoriamente');
    }
}
