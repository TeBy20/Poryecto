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
        // Definir reglas de validación
        $rules = [
            'nombre_categoria' => 'required|max:255', // Establecer el límite en 255 caracteres, puedes ajustarlo según tus necesidades
            'tarifas' => 'required|numeric', // Asegurar que las tarifas sean numéricas y obligatorias
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio.',
            'nombre_categoria.max' => 'El nombre de la categoría no puede tener más de 255 caracteres.',
            'tarifas.required' => 'El campo de tarifas es obligatorio.',
            'tarifas.numeric' => 'Las tarifas deben ser un valor numérico.',
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

        // Crear la categoría si pasa la validación
        Categorias::create($request->all());

        return redirect()->route('categorias.index')->with('status', 'Categoría creada satisfactoriamente');
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

        return redirect()->route("categorias.index")->with("status", "Categoría actualizada satisfactoriamente!");
    }

    public function destroy($id)
    {
        $categorias = Categorias::findOrFail($id);

        $categorias->delete();

        return redirect()->route('categorias.index')->with('status', 'Categoría eliminada satisfactoriamente');
    }
}
