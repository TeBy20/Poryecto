<!-- resources/views/reportes/entradas.blade.php -->

@extends('adminlte::page')

@section('title', 'Reporte de Entradas')

@section('content_header')
<h1>Reporte de Entradas</h1>
@stop

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Placa del Vehículo</th>
                <th>Categoría ID</th>
                <th>Fecha de Entrada</th>
                <th>Hora de Entrada</th>
                <th>Código</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($entradas as $entrada)
            <tr>
                <td>{{ $entrada->id }}</td>
                <td>{{ $entrada->placa_vehiculo }}</td>
                <td>{{ $entrada->categoria_id }}</td>
                <td>{{ $entrada->fecha_entrada }}</td>
                <td>{{ $entrada->hora_entrada }}</td>
                <td>{{ $entrada->codigo }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop