<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('panel.lista_vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */

     public function exportarVehiculoPDF($id)
     {
         $vehiculo = Vehiculo::findOrFail($id);
     
         $pdf = Pdf::loadView('panel.lista_vehiculos.pdf_vehiculo', compact('vehiculo'));
     
         return $pdf->stream('vehiculo_' . $vehiculo->id . '.pdf');
     }
     
     public function buscarVehiculo(Request $request)
     {
         $request->validate([
             'placa' => 'nullable|string|max:255',
             'codigo' => 'nullable|string|min:6', // Cambiado a string y ajustado a 6 caracteres
         ]);
     
         $placa = $request->input('placa');
         $codigo = $request->input('codigo');
     
         $vehiculo = null;
     
         if ($placa) {
             $vehiculo = Vehiculo::where('placa_vehiculo', $placa)->first();
         } elseif ($codigo) {
             $vehiculo = Vehiculo::where('codigo', $codigo)->first();
         }
     
         if ($vehiculo) {
             // Calcula la diferencia de horas
             $horaEntrada = \Carbon\Carbon::parse($vehiculo->fecha_entrada . ' ' . $vehiculo->hora_entrada);
             $horaSalida = \Carbon\Carbon::now();
             $diferenciaHoras = $horaSalida->diffInHours($horaEntrada);
     
             return view('panel.lista_vehiculos.buscar', compact('vehiculo', 'diferenciaHoras'));
         } else {
             return view('panel.lista_vehiculos.buscar')->with('error', 'Vehículo no encontrado.');
         }
     }
 
     public function procesarBusqueda(Request $request)
     {
         $request->validate([
             'placa' => 'required_without:codigo|string',
             'codigo' => 'required_without:placa|numeric',
         ]);
 
         $filtro = $request->has('placa') ? 'placa_vehiculo' : 'codigo';
 
         $vehiculo = Vehiculo::where($filtro, $request->input($filtro))->first();
 
         if (!$vehiculo) {
            return redirect()->route('buscar-vehiculo')->with('error', 'No se encontró ningún vehículo con la información proporcionada.');
        }
    
        // Calcula la diferencia de horas
        $horaEntrada = \Carbon\Carbon::parse($vehiculo->fecha_hora_entrada);
        $horaSalida = \Carbon\Carbon::now();
        $diferenciaHoras = $horaSalida->diffInHours($horaEntrada);

        $tarifa = $vehiculo->categoria->tarifas;


        $montoTotal = $diferenciaHoras * $tarifa;
    
        return view('panel.lista_vehiculos.buscar', compact('vehiculo', 'diferenciaHoras', 'montoTotal'));
    }

 
     public function registrarSalida(Vehiculo $vehiculo)
     {
         // Agrega lógica para registrar la salida del vehículo (actualizar hora de salida, calcular tarifa, etc.)
         // ...
 
         return view('panel.lista_vehiculos.pago', compact('vehiculo'));
     }

    public function create()
    {
        
        $categorias = Categorias::all(); // Obtener todas las categorías disponibles
        return view('panel.lista_vehiculos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Vehiculo::create($request->all());

        return redirect()->route('vehiculo.index')->with('status', 'Vehiculo agregado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        //
    }
}
