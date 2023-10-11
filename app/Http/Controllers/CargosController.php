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
