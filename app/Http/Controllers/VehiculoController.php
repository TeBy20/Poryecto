<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Categorias;
use App\Models\cocheras;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
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
     
     

    public function create()
    {
        
        $categorias = Categorias::all(); // Obtener todas las categorías disponibles
        return view('panel.lista_vehiculos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */

     private function generarCodigoUnico()
     {
         return Str::random(8); // Puedes ajustar la longitud del código según tus necesidades
     }


    public function contadorVehiculos()
    {
        $contadorVehiculos = \DB::select("SELECT COUNT(*) as count FROM vehiculos")[0]->count;
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
            // ... otras columnas ...
            'fecha_entrada' => Carbon::now()->toDateString(), // Establecer la fecha actual
            'hora_entrada' => Carbon::now()->toTimeString(), // Establecer la hora actual
            'codigo' => $this->generarCodigoUnico(), // Debes implementar tu lógica para generar un código único
        ]);

        // Decrementar el contador de cocheras
       

        return $this->generarYMostrarPDF($vehiculo);
    }
    
    private function generarYMostrarPDF(Vehiculo $vehiculo)
    {
        // Cargar la vista del PDF
        $pdfView = view('panel.lista_vehiculos.pdf_vehiculo', compact('vehiculo'));

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
    public function edit($id)
    {
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

        $vehiculo->update($request->all());

        return redirect()->route("vehiculo.index")->with("status", "Vehiculo actualizada satisfactoriamente!");
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
}
