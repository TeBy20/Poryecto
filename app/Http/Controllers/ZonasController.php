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
        Zonas::create($request->all());

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona creada satisfactoriamente');
    }

    public function edit($id)
    {
        $zonas = Zonas::findOrFail($id);
        return view("zonas.edit", ["zona" => $zonas]);
    }

    public function update(Request $request, $id)
    {
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

        return redirect()->route("zonas.indexZonas")->with("status", "Zona actualizada satisfactoriamente!");
    }

    public function destroy($id)
    {
        $zonas = Zonas::findOrFail($id);

        $zonas->delete();

        return redirect()->route('zonas.indexZonas')->with('status', 'Zona eliminada satisfactoriamente');
    }
}

