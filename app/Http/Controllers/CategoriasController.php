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

    public function tarifasMotos()
    {

        $tarifasMotos = \DB::select("SELECT tarifas FROM categorias WHERE nombre_categoria = 'Motos'");
        

        return $tarifasMotos;
    }

    public function tarifasAutos()
    {

        $tarifasAutos = \DB::select("SELECT tarifas FROM categorias WHERE nombre_categoria = 'Autos'");
        

        return $tarifasAutos;
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {

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

        return redirect()->route('categorias.index')->with('status', 'Categoria eliminada satisfactoriamente');
    }
}
