<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Categorias;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Aparcamiento;
use Database\Seeders\VehiculoSeeder;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {

        return view('panel.reportes.index');

    }

    public function reporteSalidas()
    {
        // Obtén los datos de la tabla aparcamientos
        $salidas = Aparcamiento::all();

        // Retorna la vista con los datos de salidas

        return view('panel.reportes.salidas', compact('salidas'));

    }

    public function reporteEntradas()
    {
        // Obtén los datos de la tabla vehiculos
        $entradas = Vehiculo::all();

        // Retorna la vista con los datos de entradas

        return view('panel.reportes.entradas', compact('entradas'));

    }

    public function listaTickets(Request $request)
    {
        // Obtén la lista de vehículos con la relación de categoría y aplica el filtro por fecha
        $query = Vehiculo::with('categoria');

        if ($request->has('fechaInicio') && $request->has('fechaFin')) {
            $fechaInicio = Carbon::parse($request->input('fechaInicio'))->startOfDay();
            $fechaFin = Carbon::parse($request->input('fechaFin'))->endOfDay();

            $query->whereBetween('fecha_entrada', [$fechaInicio, $fechaFin]);
        }

        $vehiculos = $query->get();

        // Itera sobre los vehículos
        foreach ($vehiculos as $vehiculo) {
            $codigo = $vehiculo->codigo;

            // Busca si existe el código en la tabla aparcamiento
            $aparcamiento = Aparcamiento::where('codigo', $codigo)->first();

            // Si se encuentra una coincidencia, actualiza el estado
            if ($aparcamiento) {
                // Actualiza el estado a "retirado"
                $vehiculo->estado = 'retirado';

                // Guarda los cambios en el vehículo
                $vehiculo->save();

                // Puedes realizar otras acciones según tus necesidades

                // Elimina la entrada correspondiente en la tabla aparcamiento
                $aparcamiento->delete();
            }
        }

        // Retorna la vista con la lista de vehículos actualizada
        return view('panel.reportes.lista-tickets', compact('vehiculos'));
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

    public function create()
    {
        $categorias = Categorias::all(); // Obtener todas las categorías disponibles
        return view('panel.lista_vehiculos.create', compact('categorias'));
    }

    private function generarCodigoUnico()
    {
        return Str::random(8); // Puedes ajustar la longitud del código según tus necesidades
    }

    public function contadorVehiculos()
    {
        $contadorVehiculos = \DB::select("SELECT COUNT(*) as count FROM vehiculos WHERE estado = 'Estacionado'")[0]->count;
        return $contadorVehiculos;
    }

    public function contadorCocheras()
    {
        $contadorCocheras = \DB::select("SELECT COUNT(*) as count FROM cocheras")[0]->count;
        return $contadorCocheras;
    }

    public function cocherasTotal()
    {
        $cocherasTotal = $this->contadorCocheras();
        $vehiculosTotal = $this->contadorVehiculos();

        $total = $cocherasTotal - $vehiculosTotal;

        return $total;
    }

    public function store(Request $request)
    {

        $rules = [
            'placa_vehiculo' => ['required', 'string', 'min:6', 'max:15', 'regex:/^[A-Za-z0-9\s]+$/'],
            'categoria_id' => 'required|numeric',
        ];

        $messages = [
            'placa_vehiculo.required' => 'El campo nombre es obligatorio.',
            'placa_vehiculo.min' => 'El campo nombre no debe tener menos de 6 caracteres.',
            'placa_vehiculo.max' => 'El campo nombre no debe tener mas de 15 caracteres.',
            'placa_vehiculo.regex' => 'El campo nombre no debe contener caracteres especiales.',
       
        ];

        $request->validate($rules, $messages);

        // Validar los datos del formulario según sea necesario
        $request->validate([
            'placa_vehiculo' => 'required|string|max:255',
            'categoria_id' => 'required|numeric',
            // ... otras reglas de validación ...
        ]);

        // Crear un nuevo vehículo y establecer la fecha y hora de entrada
        $vehiculo = Vehiculo::create([
            'placa_vehiculo' => $request->input('placa_vehiculo'),
            'categoria_id' => $request->input('categoria_id'),
            'fecha_entrada' => Carbon::now()->toDateString(),
            'hora_entrada' => Carbon::now()->toTimeString(),
            'codigo' => $this->generarCodigoUnico(),
            'estado' => 'estacionado',
            'tarifas_id' => Categorias::find($request->input('categoria_id'))->tarifas, // Obtener la tarifa de la categoría
        ]);

        return $this->generarYMostrarPDF($vehiculo);
    }

    private function generarYMostrarPDF(Vehiculo $vehiculo)
    {
        // Obtener la tarifa de la categoría del vehículo
        $tarifa = $vehiculo->categoria->tarifas;

        // Cargar la vista del PDF y pasar la tarifa
        $pdfView = view('panel.lista_vehiculos.pdf_vehiculo', compact('vehiculo', 'tarifa'));

        // Generar el PDF
        $pdf = PDF::loadHtml($pdfView);

        // Establecer el nombre del archivo PDF
        $filename = 'vehiculo_' . $vehiculo->id . '.pdf';

        // Descargar el PDF en una nueva ventana
        return $pdf->stream($filename);
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
    public function edit($id, Request $request )
    {
        $rules = [
            'placa_vehiculo' => ['required', 'string', 'min:6', 'max:15', 'regex:/^[A-Za-z0-9\s]+$/'],
            
        ];

        $messages = [
            'placa_vehiculo.required' => 'El campo nombre es obligatorio.',
            'placa_vehiculo.min' => 'El campo nombre no debe tener menos de 6 caracteres.',
            'placa_vehiculo.max' => 'El campo nombre no debe tener mas de 15 caracteres.',
            'placa_vehiculo.regex' => 'El campo nombre no debe contener caracteres especiales.',
       
        ];

        $request->validate($rules, $messages);

        $vehiculo = Vehiculo::findOrFail($id);
        $categorias = Categorias::all();
        return view("panel.lista_vehiculos.edit", ["vehiculo" => $vehiculo, "categorias" => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        // Evita la edición de la tarifa
        $request->request->remove('tarifas_id');

        $vehiculo->update($request->all());

        return redirect()->route("vehiculo.index")->with("status", "Vehiculo actualizado satisfactoriamente!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $vehiculo->delete();

        return redirect()->route('vehiculo.index')->with('status', 'Vehiculo eliminada satisfactoriamente');
    }

    public function graficocategoriaxestado()
    {
        // If it is an AJAX request
        if (request()->ajax()) {
            $labels = [];
            $counts = [];

            // Count the number of vehicles retired each month
            for ($mes = 1; $mes <= 12; $mes++) {
                $labels[] = $mes;

                $counts[] = Vehiculo::whereMonth('fecha_entrada', $mes)->count();
            }

            // Define the title, legend, and range of the chart
            $titulo = 'Cantidad de vehículos retirados por mes';
            $leyenda = ['Retirados'];
            $rango = [0, 100];

            $response = [
                'success' => true,
                'titulo' => $titulo,
                'leyenda' => $leyenda,
                'rango' => $rango,
                'data' => [
                    'labels' => $labels,
                    'counts' => $counts
                ]
            ];

            return json_encode($response);
        }

        return view('panel.reportes.grafico');
    }
}
