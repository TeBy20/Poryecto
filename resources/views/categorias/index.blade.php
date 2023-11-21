{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Categoiras')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Lista de Categoiras</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('categorias.create') }}" class="btn btn-success text-uppercase">
                Nueva categoria
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
                            <th scope="col" class="text-uppercase">Nombre Categoira</th>
                            <th scope="col" class="text-uppercase">Tarifas</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre_categoria }}</td>
                            <td>{{ $categoria->tarifas }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST">
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