<!-- resources/views/reportes/salidas.blade.php -->

@extends('adminlte::page')

@section('title', 'Reporte de Salidas')

@section('content_header')
    <h1>Reporte de Salidas</h1>
@stop

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Placa del Vehículo</th>
                    <th>Categoría ID</th>
                    <th>Fecha de Salida</th>
                    <th>Hora de Salida</th>
                    <th>Fecha de Entrada</th>
                    <th>Hora de Entrada</th>
                    <th>Tiempo de Estancia</th>
                    <th>Monto Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salidas as $salida)
                    <tr>
                        <td>{{ $salida->id }}</td>
                        <td>{{ $salida->codigo }}</td>
                        <td>{{ $salida->placa_vehiculo }}</td>
                        <td>{{ $salida->categoria_id }}</td>
                        <td>{{ $salida->fecha_salida }}</td>
                        <td>{{ $salida->hora_salida }}</td>
                        <td>{{ $salida->fecha_entrada }}</td>
                        <td>{{ $salida->hora_entrada }}</td>
                        <td>{{ $salida->tiempo_estancia }}</td>
                        <td>{{ $salida->monto_total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop
