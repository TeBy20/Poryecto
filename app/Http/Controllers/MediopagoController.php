<?php

namespace App\Http\Controllers;

use App\Models\Mediopago;
use App\Rules\NoSpecialCharacters;
use Illuminate\Http\Request;

class MediopagoController extends Controller
{
    public function index(){

        $mediopagos = Mediopago::all();

        return view('mediopago.index', compact('mediopagos'));

    }

    public function create(){

        return view('mediopago.create');

    }
    
    public function store(Request $request){

        Mediopago::create($request->all());

        return redirect()->route('mediopago.index')->with('status','Nuevo medio de pago creado satisfactoriamente');

    }
    
    public function edit($id)
        {
            $mediopagos = Mediopago::findOrFail($id);
            return view('mediopago.edit', ['mediopago' => $mediopagos]);
        }

    public function update(Request $request, $id)
    {
            $mediopagos = Mediopago::findOrFail($id);

            $rules = [
                'nombre_mediopago' => ['required', 'string', 'max:50', new NoSpecialCharacters],
            ];

            $messages = [
                'nombre_mediopago.required' => 'El campo nombre es obligatorio.',
                'nombre_mediopago.max' => 'El campo nombre no debe tener más de 50 caracteres.',
                'nombre_mediopago.regex' => 'El campo nombre no debe contener caracteres especiales.',
            ];

            $request->validate($rules, $messages);

            $mediopagos->update($request->all());

            return redirect()->route("mediopago.index")->with("status", "Medio de pago actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $mediopagos = Mediopago::findOrFail($id);

        $mediopagos->delete();

        return redirect()->route('mediopago.index')->with('status', 'Medio de pago eliminado satisfactoriamente');
    }

}