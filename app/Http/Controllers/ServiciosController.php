<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{

    public function index()
    {
        $servicios = Servicios::all();

        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        Servicios::create($request->all());

        return redirect()->route('servicios.index')->with('status', 'Servicio agregado satisfactoriamente');
    }

    public function edit($id)
    {
        $servicios = Servicios::findOrFail($id);
        return view('servicios.edit', ['servicios' => $servicios]);
    }

    public function update(Request $request, $id)
    {
        $servicios = Servicios::findOrFail($id);

        $servicios->update($request->all());

        return redirect()->route("servicios.index")->with("status", "Servicio actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $servicios = Servicios::findOrFail($id);

        $servicios->delete();

        return redirect()->route('servicios.index')->with('status', 'Servicio eliminado satisfactoriamente');
    }
    
}
