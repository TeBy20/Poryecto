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
        $rules = [
            'nombre_zona' => ['required', 'string', 'max:30', 'regex:/^[A-Za-z0-9\s]+$/'],
            'capacidad' => ['required', 'numeric', 'regex:/^\d{1,3}$/'],
        ];

        $messages = [
            'nombre_zona.required' => 'El campo nombre es obligatorio.',
            'nombre_zona.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'nombre_zona.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'capacidad.required' => 'El campo capacidad es obligatorio.',
            'capacidad.numeric' => 'El campo capacidad debe ser un número.',
            'capacidad.regex' => 'El campo capacidad debe tener exactamente 3 dígitos.',
        ];

        $request->validate($rules, $messages);

        Zonas::create($request->all());

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona creada satisfactoriamente');
    }

    public function edit($id)
    {
        $zona = Zonas::findOrFail($id);
        return view("zonas.edit", ["zona" => $zona]);
    }

    public function update(Request $request, $id)
    {
        $zona = Zonas::findOrFail($id);

        $rules = [
            'nombre_zona' => ['required', 'string', 'max:30', 'regex:/^[A-Za-z0-9\s]+$/'],
            'capacidad' => ['required', 'numeric', 'regex:/^\d{1,3}$/'],
        ];

        $messages = [
            'nombre_zona.required' => 'El campo nombre es obligatorio.',
            'nombre_zona.max' => 'El campo nombre no debe tener más de 30 caracteres.',
            'nombre_zona.regex' => 'El campo nombre no debe contener caracteres especiales.',
            'capacidad.required' => 'El campo capacidad es obligatorio.',
            'capacidad.numeric' => 'El campo capacidad debe ser un número.',
            'capacidad.regex' => 'El campo capacidad debe tener exactamente 3 dígitos.',
        ];

        $request->validate($rules, $messages);

        $zona->update($request->all());

        return redirect()->route("zonas.indexZonas")->with("status", "Zona actualizada satisfactoriamente!");
    }

    public function destroy($id)
    {
        $zona = Zonas::findOrFail($id);

        $zona->delete();

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona eliminada satisfactoriamente');
    }
}
