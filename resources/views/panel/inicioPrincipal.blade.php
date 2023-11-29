@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')

    <h1>Resumen del Día</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row d-flex justify-content-center">

            <div class="col-md-3">
                <div class="card bg-primary text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">VEHICULOS INGRESADOS HOY</h2>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2343/2343894.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 200px;">
                    <div class="card-body">
                        <h1>{{ $vehiculosRetiradosHoy }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-danger text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">COCHERAS DISPONIBLES</h2>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/12338/12338246.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 200px;">
                    <div class="card-body">
                        <h1>{{ app('App\Http\Controllers\VehiculoController')->cocherasTotal() }}</h1>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3">
                <div class="card bg-yellow text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">DINERO EN CAJA</h2>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/4305/4305547.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 200px;">
                    <div class="card-body">
                        <h1>{{ app('App\Http\Controllers\CajaController')->montoTotalCaja() }}</h1>
                    </div>
                    </div>
                </div>
            </div>

            

            
        </div>

    

        

    </div>
@stop

@section('css')
    <style>
        
        .bg-success {
            background-color: #1a1a1a;/* Naranja */ /* Un color verde, puedes ajustar el color según tus preferencias */
        }
    </style>
@stop

