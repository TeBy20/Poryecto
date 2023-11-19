<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;

class CajaController extends Controller
{
    public function index()
    {
        // Agrega lógica para obtener el monto de la caja
        $montoDeCaja = Caja::sum('monto');

        return view('caja.index', compact('montoDeCaja'));
    }

    public function ingreso(Request $request)
    {
        // Agrega lógica para manejar el ingreso de dinero a la caja
        $montoIngreso = $request->input('ingresoMonto');

        Caja::create([
            'motivos_accion' => 'Ingreso',
            'monto' => $montoIngreso,
            'fecha' => now(),
            'hora' => now()->format('H:i:s'), // Ajusta para reflejar el campo 'hora' en la migración
            'tipo' => 'ingreso', // Establece el tipo como 'ingreso'
        ]);

        return redirect()->route('caja.index')->with('success', 'Ingreso registrado correctamente');
    }

    public function egreso(Request $request)
    {
        // Obtén el motivo de retiro desde el formulario
        $motivoEgreso = $request->input('egresoMotivo');

        // Validar el motivo de egreso con una expresión regular
        if (!preg_match('/^[a-zA-Z0-9\s\-.,]+$/', $motivoEgreso)) {
            // La entrada no cumple con la expresión regular
            return redirect()->back()->with('error', 'Motivo de egreso no válido');
        }

        // Obtén el monto de egreso desde el formulario
        $montoEgreso = $request->input('egresoMonto');

        // Crea una nueva entrada en la tabla Caja con los datos proporcionados
        Caja::create([
            'motivos_accion' => $motivoEgreso, // Usa el motivo ingresado
            'monto' => -$montoEgreso, // Resta el monto para representar un egreso
            'fecha' => now(),
            'hora' => now()->format('H:i:s'), // Ajusta para reflejar el campo 'hora' en la migración
            'tipo' => 'egreso', // Establece el tipo como 'egreso'
        ]);

        // Redirige de nuevo a la vista de la caja con un mensaje de éxito
        return redirect()->route('caja.index')->with('success', 'Egreso registrado correctamente');
    }

    public function buscarMovimientos(Request $request)
{
    $fechaInicio = $request->input('fechaInicio');
    $fechaFin = $request->input('fechaFin');
    $tipoMovimiento = $request->input('tipoMovimiento');

    switch ($tipoMovimiento) {
        case 'ingresos':
            $movimientos = Caja::whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->where('tipo', 'ingreso') // Filtra por tipo de ingreso
                ->get();
            break;

        case 'egresos':
            $movimientos = Caja::whereBetween('fecha', [$fechaInicio, $fechaFin])
                ->where('tipo', 'egreso')
                ->get();
            break;

        case 'movimientos':
            // Obtén tanto ingresos como egresos sin filtrar por tipo
            $movimientos = Caja::whereBetween('fecha', [$fechaInicio, $fechaFin])->get();
            break;

        default:
            // Manejar otro caso si es necesario
            return redirect()->back(); // Redirigir a la página anterior si el tipo no coincide
    }

    $montoTotal = $movimientos->sum('monto');

    return view('caja.movimientos', compact('movimientos', 'fechaInicio', 'fechaFin', 'montoTotal'));
}

}
