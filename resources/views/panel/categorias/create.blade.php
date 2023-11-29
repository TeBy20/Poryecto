@extends('adminlte::page')

@section('title', 'Gestión de Vehículos')

@section('content_header')
<h1>Gestión de Vehículos</h1>
@stop

@section('content')

    

                    <form action="{{ route('categorias.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="nombre_categorias">Nombre de categoria:</label>
                            <input class="form-control @error('nombre_categoria') is-invalid @enderror" type="text" name="nombre_categoria" value="{{ old('nombre_categoria') }}">
                            @error('nombre_categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tarifas">Tadsdrifa:</label>
                            <input class="form-control @error('tarifas') is-invalid @enderror" type="number" name="tarifas" value="{{ old('tarifas') }}">
                            @error('tarifas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <br>
                        <br>

                        <button class="btn btn-primary" type="submit">Guardar Categoria</button>
                        <a class="btn btn-secondary" href="{{ route('categorias.index') }}">Cancelar</a>
                    </form>

@stop