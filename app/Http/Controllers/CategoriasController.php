<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        Categorias::create($request->all());

        return redirect()->route('categorias.index')->with('status', 'Categoria creada satisfactoriamente');
    }

    public function edit($id)
    {
        $categorias = Categorias::findOrFail($id);
        return view('categorias.edit', ['categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $categorias = Categorias::findOrFail($id);

        $categorias->update($request->all());

        return redirect()->route("categorias.index")->with("status", "Categoria actualizada satisfactoriamente!");
    }

    public function destroy($id)
    {
        $categorias = Categorias::findOrFail($id);

        $categorias->delete();

        return redirect()->route('categorias.index')->with('status', 'Categoria eliminada satisfactoriamente');
    }
}
