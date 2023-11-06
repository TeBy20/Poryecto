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
<<<<<<< HEAD
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

=======
        // Definir reglas de validación
        $rules = [
            'nombre_servicio' => 'required|max:255',
            'precio' => 'required|numeric',
            'fecha' => 'required|date',
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre_servicio.required' => 'El nombre del servicio es obligatorio.',
            'nombre_servicio.max' => 'El nombre del servicio no puede tener más de 255 caracteres.',
            'precio.required' => 'El campo de precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'fecha.required' => 'El campo de fecha es obligatorio.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

        // Crear el servicio si pasa la validación
>>>>>>> 98eb702dce549bc68ccae9d8514219da131aff58
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

