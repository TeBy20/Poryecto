<?php

namespace App\Http\Controllers;

use App\Models\Zonas;
use Illuminate\Http\Request;


class ZonasController extends Controller
{
    public function indexZonas()
    {
        $zonas = Zonas::all();

        return view('zonas.indexZonas', compact('zonas'));
    }

    public function create()
    {
        return view('zonas.create');
    }

    public function store(Request $request)
    {
        Zonas::create($request->all());

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona creada stisfactoriamente');
    }

    public function edit($id)
    {
        $zonas = Zonas::findOrFail($id);
        return view("zonas.edit", ["zona" => $zonas]);
    }

    public function update(Request $request, $id)
    {
        $zonas = Zonas::findOrFail($id);

        $zonas->update($request->all());

        return redirect()->route("zonas.indexZonas")->with("status", "Zona actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $zonas = Zonas::findOrFail($id);

        $zonas->delete();

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona eliminada satisfactoriamente');
    }
}
