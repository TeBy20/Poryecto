@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Resumen del Día</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card bg-primary text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">VEHICULOS REGISTRADOS HOY</h2>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2343/2343894.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 150px; height: 200px;">
                    <div class="card-body">
                        <h1>{{ $vehiculosRegistradosHoy }}</h1>
                    </div>
                </div>
            </div>
            <!-- Agrega más tarjetas según sea necesario -->
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Agrega estilos adicionales según sea necesario */
        .bg-success {
            background-color: #1a1a1a;/* Naranja */ /* Un color verde, puedes ajustar el color según tus preferencias */
        }
    </style>
@stop
