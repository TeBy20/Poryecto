<?php

namespace App\Http\Controllers;

use App\Models\Cargos;
use Illuminate\Http\Request;

class CargosController extends Controller
{
    public function index()
    {
        $cargos = Cargos::all();

        return view('cargos.index', compact('cargos'));
    }

    public function create()
    {
        return view('cargos.create');
    }

    public function store(Request $request)
    {
        // Definir reglas de validación
        $rules = [
            'nombre_cargo' => 'required|string|max:50',
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_cargo.required' => 'El campo nombre es obligatorio.',
            'nombre_cargo.max' => 'El campo nombre no debe tener más de 50 caracteres.',
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

        // Crear el cargo si pasa la validación
        Cargos::create($request->all());

        return redirect()->route('cargos.index')->with('status', 'Cargo creado satisfactoriamente');
    }

    public function edit($id)
    {
        $cargos = Cargos::findOrFail($id);
        return view('cargos.edit', ['cargos' => $cargos]);
    }

    public function update(Request $request, $id)
    {
        $cargos = Cargos::findOrFail($id);

        // Reglas de validación para la actualización
        $rules = [
            'nombre_cargo' => 'required|string|max:50',
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_cargo.required' => 'El campo nombre es obligatorio.',
            'nombre_cargo.max' => 'El campo nombre no debe tener más de 50 caracteres.',
        ];

        $request->validate($rules, $messages);

        $cargos->update($request->all());

        return redirect()->route("cargos.index")->with("status", "Cargo actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $cargos = Cargos::findOrFail($id);

        $cargos->delete();

        return redirect()->route('cargos.index')->with('status', 'Cargo eliminado satisfactoriamente');
    }
}
