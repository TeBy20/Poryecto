<?php

namespace App\Http\Controllers;

use App\Models\Aparcamiento;
use App\Models\Vehiculo;

use App\Models\Mediopago;
use App\Models\Caja;

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


        $mediopagos = Mediopago::all();

        return view('panel.lista_aparcamiento.create', compact('vehiculos', 'mediopagos'));
    }

    /**
     * Store a newly created resource in storage.
     */

     public function buscarVehiculo(Request $request)
     {
        $rules = [
            'placa' => 'nullable|string|min:6|regex:/^[A-Za-z0-9\s]+$/',
            'codigo' => 'nullable|string|min:6|regex:/^[A-Za-z0-9]+$/',
        ];
        
        // Define los mensajes de error personalizados
        $messages = [
            'placa.required_without' => 'El campo placa es obligatorio si el campo código no está presente.',
            'placa.min' => 'El campo placa debe tener al menos 6 caracteres.',
            'placa.regex' => 'El campo placa no debe contener caracteres especiales.',
            'codigo.required_without' => 'El campo código es obligatorio si el campo placa no está presente.',
            'codigo.min' => 'El campo código debe tener al menos 6 caracteres.',
            'codigo.regex' => 'El campo código no debe contener caracteres especiales.',
        ];
        
     
         $request->validate($rules, $messages);
     
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
             // Manejar el caso donde el vehículo no se encuentra
             return view('panel.lista_aparcamiento.create')->with('error', 'Vehículo no encontrado.')->withErrors(['error' => 'Vehículo no encontrado.']);
         }
     }
     

    public function procesarBusqueda(Request $request)
    {

        $rules = [
            'placa' => 'nullable|string|min:6|regex:/^[A-Za-z0-9\s]+$/',
            'codigo' => 'nullable|string|min:6|regex:/^\d{1,3}$/',
        ];
        
        // Define los mensajes de error personalizados
        $messages = [
            'placa.required_without' => 'El campo placa es obligatorio si el campo código no está presente.',
            'placa.min' => 'El campo placa debe tener al menos 6 caracteres.',
            'placa.regex' => 'El campo placa no debe contener caracteres especiales.',
            'codigo.required_without' => 'El campo código es obligatorio si el campo placa no está presente.',
            'codigo.min' => 'El campo código debe tener al menos 6 caracteres.',
            'codigo.regex' => 'El campo código debe tener exactamente 3 dígitos.',
        ];
    
        // Valida los datos del formulario
        $request->validate($rules, $messages);

        $mediopagos = Mediopago::all();

        $request->validate([
            'placa' => 'required_without:codigo|string',
            'codigo' => 'required_without:placa|string|min:6',
        ]);

        $filtro = $request->has('placa') ? 'placa_vehiculo' : 'codigo';

        $vehiculo = Vehiculo::where($filtro, $request->input($filtro))->first();

        if ($vehiculo) {
            // Calcula la diferencia de horas
            $horaEntrada = \Carbon\Carbon::parse($vehiculo->fecha_entrada . ' ' . $vehiculo->hora_entrada);
            $horaSalida = \Carbon\Carbon::now();
            $diferenciaHoras = $horaSalida->diffInHours($horaEntrada);
    
            $tarifa = $vehiculo->categoria->tarifas;
            $montoTotal = $diferenciaHoras * $tarifa;
    
            $aparcamiento = new Aparcamiento();
    
            // Asigna manualmente los valores
            $aparcamiento->placa_vehiculo = $vehiculo->placa_vehiculo;
            $aparcamiento->codigo = $vehiculo->codigo;
            $aparcamiento->categoria_id = $vehiculo->categoria_id;
            $aparcamiento->fecha_entrada = $vehiculo->fecha_entrada;
            $aparcamiento->hora_entrada = $vehiculo->hora_entrada;
            $aparcamiento->fecha_salida = now()->format('Y-m-d');
            $aparcamiento->hora_salida = now()->format('H:i:s');
            $aparcamiento->tiempo_estancia = $diferenciaHoras;
            $aparcamiento->monto_total = $montoTotal;
    
            $aparcamiento->save();
    
            // ... el resto de tu código ...
    
            return view('panel.lista_aparcamiento.create', compact('vehiculo', 'diferenciaHoras', 'montoTotal', 'mediopagos'));
        } else {
            // Manejar el caso donde el vehículo no se encuentra
            return view('panel.lista_aparcamiento.create')->with('error', 'Vehículo no encontrado.')->withErrors(['error' => 'Vehículo no encontrado.']);
        }
    }


    private function generarYMostrarPDF(Aparcamiento $aparcamiento)
    {
        // Cargar la vista del PDF
        $pdfView = view('panel.lista_aparcamiento.pdf_salida', compact('aparcamiento'));

        // Generar el PDF
        $pdf = PDF::loadHtml($pdfView);

        // Establecer el nombre del archivo PDF

        $filename = 'aparcamiento_' . $aparcamiento->id . '.pdf';


        // Descargar el PDF en una nueva ventana
        return $pdf->stream($filename);
    }



    public function store(Request $request)
    {
        

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
        $mediopago = $request->input('mediopago');


        // Buscar la categoría por nombre
        $categoria = Categorias::where('nombre_categoria', $categoriaNombre)->first();

        // Verificar si la categoría existe
        if ($categoria) {

            // Calcula la diferencia de horas
            $horaEntrada = \Carbon\Carbon::parse($fechaEntrada . ' ' . $horaEntrada);
            $horaSalida = \Carbon\Carbon::now();
            $diferenciaHoras = $horaSalida->diffInHours($horaEntrada);

            // Calcula el monto total
            $tarifa = $categoria->tarifas;
            $montoTotal = $diferenciaHoras * $tarifa;

            // Si el monto total es 0, mantén la tarifa original
            if ($montoTotal == 0) {
                $montoTotal = $tarifa;
            }


            // Crear el Aparcamiento y asignar los valores
            $aparcamiento = new Aparcamiento();
            $aparcamiento->placa_vehiculo = $placaVehiculo;
            $aparcamiento->codigo = $codigo;
            $aparcamiento->categoria()->associate($categoria);
            $aparcamiento->fecha_entrada = $fechaEntrada;
            $aparcamiento->hora_entrada = $horaEntrada;
            $aparcamiento->fecha_salida = $fechaSalida;
            $aparcamiento->hora_salida = $horaSalida;
            $aparcamiento->tiempo_estancia = $diferenciaHoras;
            $aparcamiento->monto_total = $montoTotal;
            $aparcamiento->nombre_mediopago = $mediopago;

            // Guardar el Aparcamiento en la base de datos
            $aparcamiento->save();

            // Registrar el ingreso en la tabla de Caja
            Caja::create([
                'motivos_accion' => 'Ingreso por ticket',
                'monto' => $montoTotal,
                'fecha' => $fechaSalida,
                'hora' => $horaSalida->format('H:i:s'),
                'tipo' => 'ingreso',
            ]);

            // Generar y mostrar el PDF
            $pdf = $this->generarYMostrarPDF($aparcamiento);

            // Devolver la vista del PDF
            return $pdf;

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
