{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Aparcamiento')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Lista de Aparcamientos</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('aparcamiento.create') }}" class="btn btn-success text-uppercase">
                Nuevo aparcamiento
            </a>
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
                <table id="tabla-productos" class="table table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-uppercase">Vehiculo</th>
                            <th scope="col" class="text-uppercase">Zona</th>
                            <th scope="col" class="text-uppercase">Fecha entrada</th>
                            <th scope="col" class="text-uppercase">Fecha salida</th>
                            <th scope="col" class="text-uppercase">Estado</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aparcamientos as $aparcamiento)
                        <tr>
                            <td>{{ $aparcamiento->id }}</td>
                            <td>{{ $aparcamiento->vehiculo->id }}</td>
                            <td>{{ $aparcamiento->zona->id }}</td>
                            <td>{{ $aparcamiento->fecha_hora_entrada }}</td>
                            <td>{{ $aparcamiento->fecha_hora_salida }}</td>
                            <td>{{ $aparcamiento->estado }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <a href="{{ route('aparcamiento.edit', $aparcamiento) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('aparcamiento.destroy', $aparcamiento) }}" method="POST">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-uppercase">
                                            Eliminar
                                        </button>
                                    </form>
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
@stop

{{-- Importacion de Archivos CSS --}}
@section('css')
    
@stop


{{-- Importacion de Archivos JS --}}
@section('js')

    {{-- La funcion asset() es una funcion de Laravel PHP que nos dirige a la carpeta "public" --}}
    <script src="{{ asset('js/productos.js') }}"></script>
@stop