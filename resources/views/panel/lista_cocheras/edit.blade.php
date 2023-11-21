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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('panel.cocheras.update', $cochera->id) }}" method="POST" novalidate>
                @csrf
                @method("PUT")

                <label class="form-label" for="name">Lugar:</label><br>
                <input class="form-control" type="num" name="num_lugar" value="{{ old('num_lugar', $cochera->num_lugar) }}">

                <br>

                <label class="form-label" for="piso">Piso:</label><br>
                <input class="form-control" type="number" name="Piso" value="{{ old('piso', $cochera->piso) }}">
                
                <br>

                <button class="btn btn-primary" type="submit">Guardar Cochera</button>
                <a class="btn btn-secondary" href="{{ route('panel.cocheras.index') }}">Cancelar</a>
            </form>
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