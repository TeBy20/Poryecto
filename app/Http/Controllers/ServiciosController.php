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
        // Definir reglas de validación
        $rules = [
            'nombre_servicio' => 'required|max:255',
            'precio' => 'required|numeric',
            'fecha' => 'required|date',
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_servicio.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio.max' => 'El nombre del servicio no puede tener más de 255 caracteres.',
            'precio.required' => 'El campo de precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'fecha.required' => 'El campo de fecha es obligatorio.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

        // Crear el servicio si pasa la validación
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

