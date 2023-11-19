<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Rules\NoSpecialCharacters;

class ServiciosController extends Controller
{

    public function index()
    {
        $servicios = Servicios::all();

        return view('servicios.index', compact('servicios'));
    }

    public function create()
    {
        return view('servicios.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre_servicio' => ['required', 'string', 'max:50', new NoSpecialCharacters],
            'precio' => ['required', 'string', 'regex:/^\d{1,13}$/'],
        ];

        $messages = [
            'nombre_servicio.required' => 'El campo nombre es obligatorio.',
            'nombre_servicio.max' => 'El campo nombre no debe tener más de 50 caracteres.',
            'nombre_servicio.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'precio.required' => 'El campo tarifas es obligatorio.',
            'precio.regex' => 'El campo tarifas debe contener entre 1 y 13 dígitos.',
        ];

        $request->validate($rules, $messages);

        Servicios::create($request->all());

        return redirect()->route('servicios.index')->with('status', 'Servicio agregado satisfactoriamente');
    }

    public function update(Request $request, $id)
    {
        $servicios = Servicios::findOrFail($id);

        $rules = [
            'nombre_servicio' => ['required', 'string', 'max:50', new NoSpecialCharacters],
            'precio' => ['required', 'string', 'regex:/^\d{1,7}$/'],
        ];

        $messages = [
            'nombre_servicio.required' => 'El campo nombre es obligatorio.',
            'nombre_servicio.max' => 'El campo nombre no debe tener más de 50 caracteres.',
            'nombre_servicio.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'precio.required' => 'El campo precio es obligatorio.',
            'precio.regex' => 'El campo precio debe contener entre 1 y 13 dígitos.',
        ];

        $request->validate($rules, $messages);

        $servicios->update($request->all());

        return redirect()->route("servicios.index")->with("status", "Servicio actualizado satisfactoriamente!");
    }

    public function destroy($id)
    {
        $servicios = Servicios::findOrFail($id);

        $servicios->delete();

        return redirect()->route('servicios.index')->with('status', 'Servicio eliminado satisfactoriamente');
    }
    
}
