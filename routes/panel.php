<?php

use App\Http\Controllers\AparcamientoController;
use App\Http\Controllers\CocherasController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("panel.index");
});


Route::resource('/vehiculos', VehiculoController::class)->names('vehiculo');

Route::resource('/aparcamientos', AparcamientoController::class)->names('aparcamiento');

Route::resource('/cocheras', CocherasController::class)->names('panel.cocheras');

Route::get('/inicio', [InicioController::class, 'index'])->name('panel.inicioPrincipal');

Route::get('exportar-vehiculo-pdf/{vehiculo}', [VehiculoController::class, 'exportarVehiculoPDF'])->name('exportar-vehiculos-pdf');

Route::get('/buscar-vehiculo', [VehiculoController::class, 'buscarVehiculo'])->name('buscar-vehiculo');
Route::post('/procesar-busqueda', [VehiculoController::class, 'buscarVehiculo'])->name('procesar-busqueda');
Route::post('/registrar-salida/{vehiculo}', [VehiculoController::class, 'registrarSalida'])->name('registrar-salida');


