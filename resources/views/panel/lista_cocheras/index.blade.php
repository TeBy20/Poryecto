{{-- Extiende de la plantilla de Admin LTE, nos permite tener el panel en la vista --}}
@extends('adminlte::page')

{{-- Activamos el Plugin de Datatables instalado en AdminLTE --}}
@section('plugins.Datatables', true)

{{-- Titulo en las tabulaciones del Navegador --}}
@section('title', 'Cocheras')

{{-- Titulo en el contenido de la Pagina --}}
@section('content_header')
    <h1>Lista de Cocheras</h1>
@stop

{{-- Contenido de la Pagina --}}
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mb-3">
            
            <a href="{{ route('panel.cocheras.create') }}" class="btn btn-success text-uppercase">
                Nuevas Cocheras
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
                    <h4 class="card-title">{{ \App\Models\cocheras::where('disponible', 1)->count() }}</h4>
                </div>
            </div>
        </div>

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="tabla-productos" class="table table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" class="text-uppercase">Lugar</th>
                            <th scope="col" class="text-uppercase">Piso</th>
                            <th scope="col" class="text-uppercase">Disponible</th>
                            <th scope="col" class="text-uppercase">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cocheras as $cochera)
                        <tr>
                            <td>{{ $cochera->id }}</td>
                            <td>{{ $cochera->num_lugar }}</td>
                            <td>{{ $cochera->piso }}</td>
                            <td>{{ $cochera->disponible }}</td>
                            <td>
                                <div class="d-flex">
                                    
                                    <a href="{{ route('panel.cocheras.edit', $cochera) }}" class="btn btn-sm btn-warning text-white text-uppercase me-1">
                                        Editar
                                    </a>
                                    <form action="{{ route('panel.cocheras.destroy', $cochera) }}" method="POST">
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