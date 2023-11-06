<?php

namespace App\Http\Controllers;

use App\Models\Aparcamiento;
use App\Models\Vehiculo;
use App\Models\Zonas;
use Illuminate\Http\Request;

class AparcamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aparcamientos = Aparcamiento::all();
        return view('panel.lista_aparcamiento.index', compact('aparcamientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehiculo::whereNotIn('id', Aparcamiento::pluck('id_vehiculo'))->get();
        $zonas = Zonas::all();
        return view('panel.lista_aparcamiento.create', compact('vehiculos', 'zonas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_vehiculo' => 'required',
            'id_zona' => 'required',
            // Agrega aquí las reglas de validación para otros campos si es necesario
        ]);

        $aparcamiento = new Aparcamiento;
        $aparcamiento->id_vehiculo = $request->id_vehiculo;
        $aparcamiento->id_zona = $request->id_zona;
        // Asigna otros campos del aparcamiento si es necesario
        $aparcamiento->save();

        return redirect()->route('aparcamiento.index')->with('success', 'Aparcamiento creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aparcamiento $aparcamiento)
    {
        //
    }
}
