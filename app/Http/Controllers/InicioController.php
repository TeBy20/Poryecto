<?php

namespace App\Http\Controllers;
use App\Models\Vehiculo;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Obtén el número de vehículos registrados hoy
        $vehiculosRegistradosHoy = Vehiculo::whereDate('created_at', today())->count();

        // Pasa los datos a la vista
        return view('panel.inicioPrincipal', compact('vehiculosRegistradosHoy'));
    }
}
