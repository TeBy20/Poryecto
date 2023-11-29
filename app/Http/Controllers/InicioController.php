<?php

namespace App\Http\Controllers;
use App\Models\Vehiculo;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Obtén el número de vehículos retirados hoy
        $vehiculosRetiradosHoy = Vehiculo::whereDate('created_at', today())
            ->where('estado', 'Retirado')
            ->count();

        // Pasa los datos a la vista
        return view('panel.inicioPrincipal', compact('vehiculosRetiradosHoy'));
    }
}
