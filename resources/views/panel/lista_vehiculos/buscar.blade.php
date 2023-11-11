@extends('adminlte::page')

@section('title', 'Gestión de Vehículos')

@section('content_header')
    <h1>Gestión de Vehículos</h1>
@stop

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('procesar-busqueda') }}" method="post">
        @csrf

        <div class="mb-3">
            <label for="placa" class="form-label">Buscar por placa:</label>
            <input type="text" class="form-control" name="placa">
        </div>

        <div class="mb-3">
            <label for="codigo" class="form-label">Buscar por código de ticket:</label>
            <input type="text" class="form-control" name="codigo">
        </div>

        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    @isset($vehiculo)
        <!-- Muestra detalles del vehículo -->
        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <h2>Detalles del Vehículo</h2>
                <p><strong>Placa:</strong> {{ $vehiculo->placa_vehiculo }}</p>
                <p><strong>Codigo:</strong> {{ $vehiculo->codigo }}</p>
                <p><strong>Categoría:</strong> {{ $vehiculo->categoria->nombre_categoria }}</p>
                <p><strong>Tarifa: </strong>{{ $vehiculo->categoria->tarifas }}</p>
                <p><strong>Fecha Entrada</strong> {{ $vehiculo->fecha_entrada }}</p>
                <p><strong>Hora Entrada</strong> {{ $vehiculo->hora_entrada }}</p>
            </div>

            <div class="col-5">
                <!-- Muestra hora de salida, fecha de salida, tiempo transcurrido, tarifa, y formulario de pago -->
                <h2>Detalles de Salida</h2>
                <p><strong>Hora de Salida:</strong> {{ \Carbon\Carbon::now()->format('H:i:s') }}</p>
                <p><strong>Fecha de Salida:</strong> {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>

                @isset($diferenciaHoras)
                    <p><strong>Tiempo Transcurrido:</strong> {{ $diferenciaHoras }} horas</p>
                @else
                    <p><strong>Tiempo Transcurrido:</strong> No disponible</p>
                @endisset

                <p><strong>Monto Total: </strong> {{ $diferenciaHoras * $vehiculo->categoria->tarifas }}</p>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <!-- Info Box para mostrar la fecha actual -->
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-calendar"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Fecha Actual</span>
                        <span class="info-box-number">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span>
                    </div>
                </div>
            </div>

            <div class="col-5">
                <!-- Info Box para mostrar la hora actual -->
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="far fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Hora Actual</span>
                        <span class="info-box-number">{{ \Carbon\Carbon::now()->format('H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form class="d-flex justify-content-center" action="{{ route('registrar-salida', $vehiculo) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success m-5">Ir a Pagar</button>
        </form>

    @endisset

@stop
