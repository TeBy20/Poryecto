@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
<h1>Lista de Tickets</h1>
@stop

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <table id="tabla-productos" class="table table-striped table-hover w-100">
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
    </div>

    <div class="mt-3">
        <!-- Agrega los botones de Ver Gráfico y Volver Atrás -->
        <a href="{{ route('graficocategoriaxestado') }}" class="btn btn-primary">
            <i class="fas fa-chart-bar"></i> Ver Gráfico
        </a>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            Volver Atrás
        </a>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<!-- Asegúrate de cargar jQuery y DataTables antes de tu script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- Agrega el JS de DataTables desde el archivo local -->
<script src="{{ asset('js/productos.js') }}"></script>
@stop