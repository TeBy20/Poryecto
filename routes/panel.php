<?php

use App\Http\Controllers\AparcamientoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CocherasController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Route;

// Route::get("/", function () {
//     return view("panel.inicioPrincipal");
// });
Route::redirect('/', '/panel/inicio');

Route::resource('/vehiculos', VehiculoController::class)->names('vehiculo');

Route::resource('/aparcamientos', AparcamientoController::class)->names('aparcamiento');

Route::resource('/cocheras', CocherasController::class)->names('panel.cocheras');

Route::resource('/categorias', CategoriasController ::class)->names('categorias');

Route::resource('/users', UserController::class)->names('users');

Route::get('/inicio', [InicioController::class, 'index'])->name('panel.inicioPrincipal');

Route::get('exportar-vehiculo-pdf/{vehiculo}', [VehiculoController::class, 'exportarVehiculoPDF'])->name('exportar-vehiculos-pdf');

Route::get('/buscar-vehiculo', [AparcamientoController::class, 'buscarVehiculo'])->name('buscar-vehiculo');
Route::post('/procesar-busqueda', [AparcamientoController::class, 'buscarVehiculo'])->name('procesar-busqueda');
Route::post('/registrar-salida/{vehiculo}', [AparcamientoController::class, 'registrarSalida'])->name('registrar-salida');

Route::get('/aparcamiento', [AparcamientoController::class, 'index'])->name('panel.aparcamiento');

Route::get('/caja', [CajaController::class, 'index'])->name('caja.index');
Route::post('/caja/ingreso', [CajaController::class, 'ingreso'])->name('caja.ingreso');
Route::post('/caja/egreso', [CajaController::class, 'egreso'])->name('caja.egreso');
// Ruta para procesar la búsqueda de movimientos
Route::get('/caja/movimientos', [CajaController::class, 'buscarMovimientos'])->name('caja.movimientos');

// Ruta para mostrar los ingresos
Route::get('/caja/ingresos', function () {
    return view('caja.ingresos');
})->name('caja.ingresos');

// Ruta para mostrar los egresos
Route::get('/caja/egresos', function () {
    return view('caja.egresos');
})->name('caja.egresos');

Route::get('/reportes', [VehiculoController::class, 'index'])->name('reportes.index');
Route::get('/reportes/lista-tickets', [VehiculoController::class, 'listaTickets'])->name('lista_tickets');
Route::get('/reportes/salidas', [VehiculoController::class, 'reporteSalidas'])->name('reporte_salidas');
Route::get('/reportes/entradas', [VehiculoController::class, 'reporteEntradas'])->name('reporte_entradas');



