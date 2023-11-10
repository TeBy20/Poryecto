@extends('adminlte::page')

@section('title', 'Movimientos de Caja desde ' . $fechaInicio . ' hasta ' . $fechaFin)

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="mt-4">Movimientos de Caja desde {{ $fechaInicio }} hasta {{ $fechaFin }}</h1>
            </div>
        </div>

        <div class="row mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <!-- Define las columnas de la tabla según tus datos -->
                        <th>Motivo</th>
                        <th>Monto</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($movimientos as $movimiento)
                        <tr>
                            <td>{{ $movimiento->motivos_accion }}</td>
                            <td>{{ $movimiento->monto }}</td>
                            <td>{{ $movimiento->tipo }}</td>
                            <td>{{ $movimiento->fecha }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4 justify-content-center">
            <div class="col-md-12 text-center">
                <p>Monto Total: {{ $montoTotal }}</p>
                <p>Cantidad de Resultados: {{ count($movimientos) }}</p>
            </div>
        </div>

        {{-- Botón para volver --}}
        <div class="row mt-4">
            <div class="col-md-12 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection



