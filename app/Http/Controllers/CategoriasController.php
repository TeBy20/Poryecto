<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;


class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categorias::all();

        return view('panel.categorias.index', compact('categorias'));
    }


    public function create()
    {
        return view('panel.categorias.create');
    }

    public function store(Request $request)
    {

        $rules = [
            'nombre_categoria' => 'required|string|max:200|regex:/^[A-Za-z0-9\s]+$/',
            'tarifas' => 'required|max:15|numeric',
        ];
        
        // Define los mensajes de error personalizados
        $messages = [
            'nombre_categoria.required' => 'El campo Nombre de categoria es obligatorio.',
            'nombre_categoria.max' => 'El campo Nombre de categoria no debe tener mas de 200 caracteres.',
            'nombre_categoria.regex' => 'El campo Nombre de categoria no debe contener caracteres especiales.',
            'tarifas.required' => 'El campo tarifas es obligatorio.',
            'tarifas.max' => 'El campo tarifas no debe tener mas 15 caracteres.',
            'tarifas.regex' => 'El campo tarifas no debe contener caracteres especiales.',
        ];

        $request->validate($rules, $messages);

        Categorias::create($request->all());

        return redirect()->route('categorias.index')->with('status', 'Categoría creada satisfactoriamente');
    }

    public function edit($id)
        {
            $categorias = Categorias::findOrFail($id);
            return view('panel.categorias.edit', ['categorias' => $categorias]);
        }

        public function update(Request $request, $id)
        {

            $rules = [
                'nombre_categoria' => 'required|string|max:200|regex:/^[A-Za-z0-9\s]+$/',
                'tarifas' => 'required|numeric|max:999999999999999',
            ];
            
            // Define los mensajes de error personalizados
            $messages = [
                'nombre_categoria.required' => 'El campo Nombre de categoria es obligatorio.',
                'nombre_categoria.max' => 'El campo Nombre de categoria no debe tener más de 200 caracteres.',
                'nombre_categoria.regex' => 'El campo Nombre de categoria no debe contener caracteres especiales.',
                'tarifas.required' => 'El campo tarifas es obligatorio.',
                'tarifas.numeric' => 'Los valores deben ser numéricos.',
                'tarifas.max' => 'El campo tarifas no debe tener más de 15 dígitos.',
            ];
    
            $request->validate($rules, $messages);

            $categorias = Categorias::findOrFail($id);

            $categorias->update($request->all());

            return redirect()->route("categorias.index")->with("status", "Categoría actualizada satisfactoriamente!");
        }

        public function destroy($id)
        {
            $categoria = Categorias::findOrFail($id);
        
            // Eliminar vehículos asociados
            $categoria->vehiculos()->delete();
        
            // Luego eliminar la categoría
            $categoria->delete();
        
            return redirect()->route('categorias.index')->with('status', 'Categoría eliminada satisfactoriamente');
        }
        
}
