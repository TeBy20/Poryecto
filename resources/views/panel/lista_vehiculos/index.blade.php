@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Vehiculos')

@section('content_header')
    <h1>Lista de Vehiculos</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('vehiculo.create') }}" class="btn btn-success text-uppercase" target="_blank">
                Nuevo vehiculo
            </a>

            <button class="btn btn-primary text-uppercase" onclick="actualizarPagina()">
                Actualizar Página
            </button>
        </div>
        
        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tabla-vehiculos" class="table table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-uppercase">Número de Placa</th>
                                <th scope="col" class="text-uppercase">Categoría</th>
                                <th scope="col" class="text-uppercase">Fecha de Entrada</th>
                                <th scope="col" class="text-uppercase">Hora de Entrada</th>
                                <th scope="col" class="text-uppercase">Codigo</th>
                                <th scope="col" class="text-uppercase">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                            <tr>
                                <td>{{ $vehiculo->id }}</td>
                                <td>{{ $vehiculo->placa_vehiculo }}</td>
                                <td>{{ $vehiculo->categoria->nombre_categoria }}</td>
                                <td>{{ $vehiculo->fecha_entrada }}</td>
                                <td>{{ $vehiculo->hora_entrada }}</td>
                                <td>{{ $vehiculo->codigo }}</td>

                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('vehiculo.edit', $vehiculo) }}" class="btn btn-sm btn-warning text-white text-uppercase m-1">
                                            Editar
                                        </a>
                                        <form action="{{ route('vehiculo.destroy', $vehiculo) }}" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger text-uppercase m-1">
                                                Eliminar
                                            </button>
                                        </form>
                                        <a href="{{ route('exportar-vehiculos-pdf', $vehiculo) }}" class="btn btn-sm btn-danger m-1" title="PDF" target="blank">
                                            <i class="fas fa-file-pdf"></i>PDF
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    
@stop

@section('js')
    <script src="{{ asset('js/productos.js') }}"></script>
    <script>
        function actualizarPagina() {
            location.reload(true); // Esto recargará la página forzando la recarga desde el servidor
        }
    </script>
@stop
