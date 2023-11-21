<!-- resources/views/reportes/index.blade.php -->

@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <h1>Lista de Tickets</h1>
@stop

@section('content')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha de Ingreso</th>
                    <th>Placa</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehiculos as $vehiculo)
                    <tr>
                        <td>{{ $vehiculo->id }}</td>
                        <td>{{ $vehiculo->fecha_entrada }}</td>
                        <td>{{ $vehiculo->placa_vehiculo }}</td>
                        <td>{{ $vehiculo->categoria->nombre_categoria }}</td>
                        <td style="color: {{ $vehiculo->estado == 'estacionado' ? 'green' : 'red' }}">
                            {{ ucfirst($vehiculo->estado) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
