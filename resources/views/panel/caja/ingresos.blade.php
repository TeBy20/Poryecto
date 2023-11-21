{{-- Extiende la plantilla de AdminLTE --}}
@extends('adminlte::page')

{{-- Define el título de la página --}}
@section('title', 'Ingresos de Caja desde ' . $fechaInicio . ' hasta ' . $fechaFin)

{{-- Define el contenido de la página --}}
@section('content')
    <div class="container-fluid">

        {{-- Encabezado de la página --}}
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Ingresos de Caja desde {{ $fechaInicio }} hasta {{ $fechaFin }}</h1>
            </div>
        </div>

        {{-- Contenido de la tabla --}}
        @if(count($resultados) > 0)
            <table class="table mt-4">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Motivo</th>
                        <th scope="col">Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resultados as $resultado)
                        <tr>
                            <td>{{ $resultado->fecha }}</td>
                            <td>{{ $resultado->motivos_accion }}</td>
                            <td>{{ $resultado->monto }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-center mt-4">Monto Total: {{ $montoTotal }}</p>
            <p class="text-center">Resultados encontrados: {{ count($resultados) }}</p>
        @else
            <p class="text-center mt-4">No hay ingresos registrados para el período seleccionado.</p>
        @endif

        {{-- Botón para volver --}}
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>

    </div>
@endsection
