<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('panel.lista_vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function exportarVehiculoPDF($id)
     {
         $vehiculo = Vehiculo::findOrFail($id);
     
         $pdf = Pdf::loadView('panel.lista_vehiculos.pdf_vehiculo', compact('vehiculo'));
     
         return $pdf->stream('vehiculo_' . $vehiculo->id . '.pdf');
     }
     


    public function create()
    {
        
        $categorias = Categorias::all(); // Obtener todas las categorías disponibles
        return view('panel.lista_vehiculos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehiculo::create($request->all());

        return redirect()->route('vehiculo.index')->with('status', 'Vehiculo agregado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
