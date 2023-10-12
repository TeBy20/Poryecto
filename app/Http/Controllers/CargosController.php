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
            'nombre_cargo' => 'required|max:255', // Establecer el límite en 255 caracteres, puedes ajustarlo según tus necesidades
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_cargo.required' => 'El nombre del cargo es obligatorio.',
            'nombre_cargo.max' => 'El nombre del cargo no puede tener más de 255 caracteres.',
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

        $cargos->update($request->all());

        return redirect()->route("cargos.index")->with("status", "Cargos actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $cargos = Cargos::findOrFail($id);

        $cargos->delete();

        return redirect()->route('cargos.index')->with('status', 'Cargo eliminado satisfactoriamente');
    }
}
