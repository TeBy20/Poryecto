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
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 180px;">
                    <div class="card-body">
                        <h1>{{ $vehiculosRegistradosHoy }}</h1>
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
                <div class="card bg-success text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">TARIFA MOTOS</h2>
                    </div>
                    <img src="https://cdn.icon-icons.com/icons2/3635/PNG/512/motorbike_motorcycle_transport_icon_227559.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 200px;">
                    <div class="card-body">
                        @php
                            $tarifasMotos = app('App\Http\Controllers\CategoriasController')->tarifasMotos();
                        @endphp
                        
                        @foreach ($tarifasMotos as $tarifa)
                            <h1>{{ $tarifa->tarifas }}</h1>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card bg-purple text-white text-center">
                    
                    <div class="card-header">
                        <h2 class="card-title text-center">TARIFA AUTOS</h2>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2555/2555021.png"
                         class="card-img-top mx-auto d-block" alt="Icono de Aparcamiento" style="width: 180px; height: 200px;">
                    <div class="card-body">
                        @php
                            $tarifasAutos = app('App\Http\Controllers\CategoriasController')->tarifasAutos();
                        @endphp
                        
                        @foreach ($tarifasAutos as $tarifas)
                            <h1>{{ $tarifas->tarifas }}</h1>
                        @endforeach
                    </div>
                </div>
            </div>
            

            

            
        </div>

        <div class="row">

            <div class="col-md-3">
                <div class="card bg-danger text-white text-center">
                    
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
