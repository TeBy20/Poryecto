<?php

use App\Http\Controllers\CargosController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\ZonasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MediopagoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


//Zonas
Route::get('/zonas', [ZonasController::class, 'indexZonas'])->name('zonas.indexZonas');
Route::post('/zonas', [ZonasController::class, 'store'])->name('zonas.store');
Route::get('/zonas/create', [ZonasController::class, 'create'])->name('zonas.create');
Route::put("/zonas/{zona}", [ZonasController::class, "update"])->name("zonas.update");
Route::delete('/zonas/{zona}', [ZonasController::class, 'destroy'])->name('zonas.destroy');
Route::get("/zonas/{zona}/edit", [ZonasController::class, "edit"])->name("zonas.edit");

//Categorias
Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
Route::put("/categorias/{categoria}", [CategoriasController::class, "update"])->name("categorias.update");
Route::delete('/categorias/{categoria}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');
Route::get("/categorias/{categoria}/edit", [CategoriasController::class, "edit"])->name("categorias.edit");

//Cargos
Route::get('/cargos', [CargosController::class, 'index'])->name('cargos.index');
Route::post('/cargos', [CargosController::class, 'store'])->name('cargos.store');
Route::get('/cargos/create', [CargosController::class, 'create'])->name('cargos.create');
Route::put("/cargos/{cargo}", [CargosController::class, "update"])->name("cargos.update");
Route::delete('/cargos/{cargo}', [CargosController::class, 'destroy'])->name('cargos.destroy');
Route::get("/cargos/{cargo}/edit", [CargosController::class, "edit"])->name("cargos.edit");

//Servicios
Route::get('/servicios', [ServiciosController::class, 'index'])->name('servicios.index');
Route::post('/servicios', [ServiciosController::class, 'store'])->name('servicios.store');
Route::get('/servicios/servicio', [ServiciosController::class, 'create'])->name('servicios.create');
Route::put("/servicios/{servicio}", [ServiciosController::class, "update"])->name("servicios.update");
Route::delete('/servicios/{servicio}', [ServiciosController::class, 'destroy'])->name('servicios.destroy');
Route::get("/servicios/{servicio}/edit", [ServiciosController::class, "edit"])->name("servicios.edit");

//MedioPago
Route::get('/mediopagos', [MediopagoController::class, 'index'])->name('mediopago.index');
Route::post('/mediopagos', [MediopagoController::class, 'store'])->name('mediopago.store');
Route::get('/mediopagos/mediopago', [MediopagoController::class, 'create'])->name('mediopago.create');
Route::put("/mediopagos/{mediopago}", [MediopagoController::class, "update"])->name("mediopago.update");
Route::delete('/mediopagos/{mediopago}', [MediopagoController::class, 'destroy'])->name('mediopago.destroy');
Route::get("/mediopagos/{mediopago}/edit", [MediopagoController::class, "edit"])->name("mediopago.edit");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
