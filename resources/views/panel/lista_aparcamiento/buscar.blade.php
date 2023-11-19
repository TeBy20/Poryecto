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
        

        <div class="card-body">

                <form action="{{ route('aparcamiento.store') }}" method="POST" novalidate>
                    @csrf

                        <div class="form-group">
                            <label for="placa_vehiculo">Número de placa del vehículo:</label>
                            <input class="form-control" type="text" name="placa_vehiculo" value="{{ $vehiculo->placa_vehiculo }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="codigo">Código de ticket:</label>
                            <input class="form-control" type="text" name="codigo" value="{{ $vehiculo->codigo }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="categoria">Categoría del vehículo:</label>
                            <input class="form-control" type="text" name="categoria" value="{{ $vehiculo->categoria->nombre_categoria }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Fecha_entrada">Fecha Entrada:</label>
                            <input class="form-control" type="text" name="Fecha_entrada" value="{{ $vehiculo->fecha_entrada }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Hora_entrada">Hora Entrada:</label>
                            <input class="form-control" type="text" name="Hora_entrada" value="{{ $vehiculo->hora_entrada }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Fecha_salida">Fecha salida:</label>
                            <input class="form-control" type="text" name="Fecha_salida" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="Hora_salida">Hora salida:</label>
                            <input class="form-control" type="text" name="Hora_salida" value="{{ \Carbon\Carbon::now()->format('H:i:s') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Tiempo_estancia">Tiempo estancia:</label>
                            <input class="form-control" type="text" name="Tiempo_estancia" value="@isset($diferenciaHoras) {{ $diferenciaHoras }} horas
                                                                                    @else
                                                                                        No disponible
                                                                                    @endisset" readonly>
                        </div>
                        <div class="form-group">
                            <label for="Monto">Monto total:</label>
                            <input class="form-control" type="text" name="Monto" value="{{ $diferenciaHoras * $vehiculo->categoria->tarifas }}" readonly>
                        </div>

                    
                    <br>

                    <button class="btn btn-primary" type="submit">Guardar Aparcamiento</button>
                    <a class="btn btn-secondary" href="{{ route('aparcamiento.index') }}">Cancelar</a>
                </form>

            
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

       

    @endisset

    

@stop
