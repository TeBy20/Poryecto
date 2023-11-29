@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<h1>Reportes</h1>
@stop

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="card col-md-4 mr-3 ml-3">
            <div class="card-body text-center">
                <h2>Seleccione un Reporte</h2>
                <div class="d-flex flex-column align-items-center">
                    <a href="{{ route('lista_tickets') }}" class="btn btn-outline-light btn-sm mt-3">
                        <i class="fas fa-list"></i> Lista de Tickets
                    </a>
                    <a href="{{ route('reporte_salidas') }}" class="btn btn-outline-light btn-sm mt-3">
                        <i class="fas fa-sign-out-alt"></i> Reporte Salidas
                    </a>
                    <a href="{{ route('reporte_entradas') }}" class="btn btn-outline-light btn-sm mt-3">
                        <i class="fas fa-sign-in-alt"></i> Reporte Entradas
                    </a>
                </div>
            </div>
        </div>

        <div class="card col-md-4 ml-3 mr-3">
            <div class="card-body">
                <h5 class="card-title text-center">Movimiento de Caja - Filtros</h5>
                <div class="row mt-4">
                    <div class="col-md-12 mx-auto text-center">
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
                                <button type="submit" name="tipoMovimiento" value="ingresos" class="btn btn-outline-primary btn-sm btn-block">
                                    <i class="fas fa-arrow-up"></i> Ingresos de Caja
                                </button>
                            </div>
                            <div class="row mb-2">
                                <button type="submit" name="tipoMovimiento" value="egresos" class="btn btn-outline-danger btn-sm btn-block">
                                    <i class="fas fa-arrow-down"></i> Egresos de Caja
                                </button>
                            </div>
                            <div class="row mb-2">
                                <button type="submit" name="tipoMovimiento" value="movimientos" class="btn btn-outline-info btn-sm btn-block">
                                    <i class="fas fa-sync-alt"></i> Todos los movimientos de Caja
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
        // Obtener la fecha y hora actual
        var fechaActual = new Date();

        // Restar 24 horas en milisegundos
        var fechaInicio = new Date(fechaActual.getTime() - 24 * 60 * 60 * 1000);

        // Establecer automáticamente las fechas
        document.getElementById('fechaInicio').valueAsDate = fechaInicio;
        document.getElementById('fechaFin').valueAsDate = fechaActual;
    });
</script>
@stop