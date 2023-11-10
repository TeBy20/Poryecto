<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use App\Rules\NoSpecialCharacters;

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
            'nombre_categoria' => ['required', 'string', 'max:50', new NoSpecialCharacters],
            'tarifas' => ['required', 'numeric', 'regex:/^\d{1,13}$/'],
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_categoria.required' => 'El campo nombre es obligatorio.',
            'nombre_categoria.max' => 'El campo nombre no debe tener más de 50 caracteres.',
            'nombre_categoria.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'tarifas.required' => 'El campo tarifas es obligatorio.',
            'tarifas.numeric' => 'El campo tarifas debe ser un número.',
            'tarifas.regex' => 'El campo tarifas no debe tener más de 13 dígitos.',
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

        // Reglas de validación para la actualización
        $rules = [
            'nombre_categoria' => ['required', 'string', 'max:50', new NoSpecialCharacters],
            'tarifas' => ['required', 'numeric', 'regex:/^\d{1,13}$/'],
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_categoria.required' => 'El campo nombre es obligatorio.',
            'nombre_categoria.max' => 'El campo nombre no debe tener más de 50 caracteres.',
            'nombre_categoria.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'tarifas.required' => 'El campo tarifas es obligatorio.',
            'tarifas.numeric' => 'El campo tarifas debe ser un número.',
            'tarifas.regex' => 'El campo tarifas no debe tener más de 13 dígitos.',
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

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
