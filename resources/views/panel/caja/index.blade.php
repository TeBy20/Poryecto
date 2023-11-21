{{-- Extiende la plantilla de AdminLTE --}}
@extends('adminlte::page')

{{-- Define el título de la página --}}
@section('title', 'Caja')

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container mx-auto">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="mt-4 text-center">Monto de Caja: {{ $montoDeCaja }}</h1>

    {{-- Ingresos --}}
    <div class="row mt-4 justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h5 class="card-title text-center">Ingresos</h5>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <form action="{{ route('caja.ingreso') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="ingresoMonto">Monto:</label>
                                <input type="number" class="form-control" id="ingresoMonto" name="ingresoMonto" required>
                            </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-success btn-block">Agregar Dinero a Caja</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Egresos --}}
    <div class="row mt-4 justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h5 class="card-title text-center">Egresos</h5>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <form action="{{ route('caja.egreso') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="egresoMotivo">Motivo de Retiro:</label>
                                <input type="text" class="form-control" id="egresoMotivo" name="egresoMotivo" required>
                            </div>
                            <div class="form-group">
                                <label for="egresoMonto">Monto:</label>
                                <input type="number" class="form-control" id="egresoMonto" name="egresoMonto" required>
                            </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <button type="submit" class="btn btn-danger btn-block">Retirar Dinero de Caja</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Movimientos de Caja - Filtros --}}
    <div class="row mt-4 justify-content-center">
        <div class="card col-md-8">
            <div class="card-body">
                <h5 class="card-title text-center">Movimiento de Caja - Filtros</h5>
                <div class="row mt-4">
                    <div class="col-md-8 mx-auto text-center">
                        <form method="get" action="{{ route('caja.movimientos') }}">
                            @csrf
                            <div class="row mb-2">
                                <div class="form-group">
                                    <label for="fechaInicio">Fecha de Inicio:</label>
                                    <input type="date" class="form-control mr-2" id="fechaInicio" name="fechaInicio" required>
                                </div>
                                <div class="form-group">
                                    <label for="fechaFin">Fecha de Finalización:</label>
                                    <input type="date" class="form-control ml-2" id="fechaFin" name="fechaFin" required>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <button type="submit" name="tipoMovimiento" value="ingresos" class="btn btn-primary btn-block">
                                    Ingresos de Caja
                                </button>
                            </div>
                            <div class="row mb-2">
                                <button type="submit" name="tipoMovimiento" value="egresos" class="btn btn-danger btn-block">
                                    Egresos de Caja
                                </button>
                            </div>
                            <div class="row mb-2">
                                <button type="submit" name="tipoMovimiento" value="movimientos" class="btn btn-info btn-block">
                                    Todos los Movimientos
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Establecer automáticamente las fechas en el día actual
        document.getElementById('fechaInicio').valueAsDate = new Date();
        document.getElementById('fechaFin').valueAsDate = new Date();
    });
</script>
@endsection