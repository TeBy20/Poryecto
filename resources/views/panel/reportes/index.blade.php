<!-- resources/views/reportes/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<h1>Reportes</h1>
@stop

@section('content')
<div class="text-center">
    <h2>Seleccione un Reporte</h2>
    <div class="btn-group" role="group" aria-label="Reportes">
        <a href="{{ route('lista_tickets') }}" class="btn btn-primary">Lista de Tickets</a>
    </div>
    <div class="btn-group" role="group" aria-label="Reportes">
        <a href="{{ route('reporte_salidas') }}" class="btn btn-primary">Reporte salidas</a>
    </div>
    <div class="btn-group" role="group" aria-label="Reportes">
        <a href="{{ route('reporte_entradas') }}" class="btn btn-primary">Reporte entradas</a>
    </div>
</div>
@stop