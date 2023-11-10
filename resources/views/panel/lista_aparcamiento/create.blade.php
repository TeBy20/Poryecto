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
                <form action="{{ route('aparcamiento.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="id_vehiculo">Selecciona un vehículo:</label>
                        <select name="id_vehiculo" class="form-control">
                            @foreach($vehiculos as $vehiculo)
                                <option value="{{ $vehiculo->id }}">{{ $vehiculo->nombre_modelo }}</option>
                            @endforeach
                        </select>
                        @error('id_vehiculo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="id_zona">Selecciona una zona:</label>
                        <select name="id_zona" class="form-control">
                            @foreach($zonas as $zona)
                                <option value="{{ $zona->id }}">{{ $zona->nombre_zona }}</option>
                            @endforeach
                        </select>
                        @error('id_zona')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    
                    <br>

                    <button class="btn btn-primary" type="submit">Guardar Aparcamiento</button>
                    <a class="btn btn-secondary" href="{{ route('aparcamiento.index') }}">Cancelar</a>
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