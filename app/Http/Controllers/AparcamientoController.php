<?php

namespace App\Http\Controllers;

use App\Models\Aparcamiento;
use App\Models\Vehiculo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Categorias;

class AparcamientoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aparcamientos = Aparcamiento::all();

        $vehiculosRegistradosHoy = Vehiculo::whereDate('created_at', today())->count();

        return view('panel.lista_aparcamiento.buscar', compact('aparcamientos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehiculo::whereNotIn('placa_vehiculo', Aparcamiento::pluck('placa_vehiculo'))->get();


        return view('panel.lista_aparcamiento.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */

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

            return view('panel.lista_aparcamiento.create', compact('vehiculo', 'diferenciaHoras'));
        } else {
            return view('panel.lista_aparcamiento.create')->with('error', 'Vehículo no encontrado.');
        }
    }

    public function procesarBusqueda(Request $request)
    {
        $request->validate([
            'placa' => 'required_without:codigo|string',
            'codigo' => 'required_without:placa|string|min:6',
        ]);

        $filtro = $request->has('placa') ? 'placa_vehiculo' : 'codigo';

        $vehiculo = Vehiculo::where($filtro, $request->input($filtro))->first();

        if (!$vehiculo) {
            return view('panel.lista_aparcamiento.create')->with('error', 'No se encontró ningún vehículo con la información proporcionada.');
        }

        // Calcula la diferencia de horas
        $horaEntrada = \Carbon\Carbon::parse($vehiculo->fecha_entrada . ' ' . $vehiculo->hora_entrada);
        $horaSalida = \Carbon\Carbon::now();
        $diferenciaHoras = $horaSalida->diffInHours($horaEntrada);

        $tarifa = $vehiculo->categoria->tarifas;

        $montoTotal = $diferenciaHoras * $tarifa;

        Aparcamiento::create([
            'placa_vehiculo' => $vehiculo->placa_vehiculo,
            'codigo' => $vehiculo->codigo,
            'categoria_id' => $vehiculo->categoria_id,
            'fecha_entrada' => $vehiculo->fecha_entrada,
            'hora_entrada' => $vehiculo->hora_entrada,
            'fecha_salida' => now()->format('Y-m-d'),
            'hora_salida' => now()->format('H:i:s'),
            'tiempo_estancia' => $diferenciaHoras,
            'monto_total' => $montoTotal,
        ]);

        return view('panel.lista_aparcamiento.buscar', compact('vehiculo', 'diferenciaHoras', 'montoTotal'));
    }


    private function generarYMostrarPDF(Vehiculo $vehiculo)
    {
        // Cargar la vista del PDF
        $pdfView = view('panel.lista_aparcamiento.pdf_salida', compact('vehiculo'));

        // Generar el PDF
        $pdf = PDF::loadHtml($pdfView);

        // Establecer el nombre del archivo PDF
        $filename = 'vehiculo_' . $vehiculo->id . '.pdf';

        // Descargar el PDF en una nueva ventana
        return $pdf->stream($filename);
    }


    //  public function registrarSalida(Vehiculo $vehiculo)
    //  {

    //      return view('panel.lista_vehiculos.pago', compact('vehiculo'));
    //  }

    public function store(Request $request)
    {
        $request->validate([
            // Agrega las reglas de validación necesarias
        ]);

        // Obtener datos del formulario
        $placaVehiculo = $request->input('placa_vehiculo');
        $codigo = $request->input('codigo');
        $categoriaNombre = $request->input('categoria');
        $fechaEntrada = $request->input('Fecha_entrada');
        $horaEntrada = $request->input('Hora_entrada');
        $fechaSalida = $request->input('Fecha_salida');
        $horaSalida = $request->input('Hora_salida');
        $tiempoEstancia = $request->input('Tiempo_estancia');
        $montoTotal = $request->input('Monto');

        // Buscar la categoría por nombre
        $categoria = Categorias::where('nombre_categoria', $categoriaNombre)->first();

        // Verificar si la categoría existe
        if ($categoria) {
            // Crear el Aparcamiento y asignar los valores
            $aparcamiento = new Aparcamiento();
            $aparcamiento->placa_vehiculo = $placaVehiculo;
            $aparcamiento->codigo = $codigo;
            $aparcamiento->categoria()->associate($categoria); // Asociar la categoría al Aparcamiento
            $aparcamiento->fecha_entrada = $fechaEntrada;
            $aparcamiento->hora_entrada = $horaEntrada;
            $aparcamiento->fecha_salida = $fechaSalida;
            $aparcamiento->hora_salida = $horaSalida;
            $aparcamiento->monto_total = $montoTotal;
            
            // Guardar el Aparcamiento en la base de datos
            $aparcamiento->save();

            // Redirigir a la vista de index con un mensaje de éxito
            return redirect()->route('aparcamiento.index')->with('status', 'Aparcamiento creado satisfactoriamente');
        } else {
            // Manejar el caso donde la categoría no existe
            return redirect()->route('aparcamiento.index')->with('error', 'Categoría no encontrada');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aparcamiento $aparcamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aparcamiento $aparcamiento)
    {
        //
    }
}
