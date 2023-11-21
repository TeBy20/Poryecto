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
        $rules = [
            'nombre_cargo' => 'required|string|max:50',
        ];

        $messages = [
            'nombre_cargo.required' => 'El campo nombre no cumple los requisitos o posee caracteres numericos.',
            'nombre_cargo.max' => 'El campo nombre no debe tener más de 20 caracteres.',
        ];

        $request->validate($rules, $messages);

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

        $rules = [
            'nombre_cargo' => 'required|string|max:50',
        ];

        $messages = [
            'nombre_cargo.required' => 'El campo nombre no cumple los requisitos o posee caracteres numericos.',
            'nombre_cargo.max' => 'El campo nombre no debe tener más de 20 caracteres.',
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

