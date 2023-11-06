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
<<<<<<< HEAD
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

=======
        // Definir reglas de validación
        $rules = [
            'nombre' => 'required|max:255', // Establecer el límite en 255 caracteres, puedes ajustarlo según tus necesidades
            'descripcion' => 'required',
            // Agrega más reglas de validación según los campos de tu modelo Zonas
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre.required' => 'El nombre de la zona es obligatorio.',
            'nombre.max' => 'El nombre de la zona no puede tener más de 255 caracteres.',
            'descripcion.required' => 'La descripción de la zona es obligatoria.',
            // Agrega más mensajes según las reglas de validación que agregues
        ];

        // Validar la solicitud
        $request->validate($rules, $messages);

        // Crear la zona si pasa la validación
>>>>>>> 98eb702dce549bc68ccae9d8514219da131aff58
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
<<<<<<< HEAD
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

=======
        // Definir reglas de validación para la actualización
        $rules = [
            'nombre' => 'required|max:255',
            'descripcion' => 'required',
            // Agrega más reglas de validación según los campos de tu modelo Zonas
        ];

        // Mensajes personalizados para las reglas de validación
        $messages = [
            'nombre.required' => 'El nombre de la zona es obligatorio.',
            'nombre.max' => 'El nombre de la zona no puede tener más de 255 caracteres.',
            'descripcion.required' => 'La descripción de la zona es obligatoria.',
            // Agrega más mensajes según las reglas de validación que agregues
        ];

        // Validar la solicitud de actualización
        $request->validate($rules, $messages);

        $zonas = Zonas::findOrFail($id);
        $zonas->update($request->all());

>>>>>>> 98eb702dce549bc68ccae9d8514219da131aff58
        return redirect()->route("zonas.indexZonas")->with("status", "Zona actualizada satisfactoriamente!");
    }

    public function destroy($id)
    {
        $zona = Zonas::findOrFail($id);

        $zona->delete();

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona eliminada satisfactoriamente');
    }
}

