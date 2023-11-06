<?php

use App\Http\Controllers\AparcamientoController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {
    return view("panel.index");
});


Route::resource('/vehiculos', VehiculoController::class)->names('vehiculo');

Route::resource('/aparcamientos', AparcamientoController::class)->names('aparcamiento');
