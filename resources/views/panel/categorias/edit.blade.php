@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Cocheras')

@section('content_header')
    


@section('content')

    <div class="container-fluid">
        <div class="row">


        <div class="col-12">
            <div class="card">
                <div class="card-body">

                <form action="{{ route('categorias.update', $categorias->id) }}" method="POST" novalidate>
                    @csrf
                    @method("PUT")

                    <div class="form-group">
                            <label for="nombre_categorias">Nombre de categoria:</label>
                            <input class="form-control @error('nombre_categoria') is-invalid @enderror" type="text" name="nombre_categoria" value="{{ old('nombre_categoria', $categorias->nombre_categoria) }}">
                            @error('nombre_categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>

                    <br>
                    <br>

                    <div class="form-group">
                            <label for="tarifas">Tadsdrifa:</label>
                            <input class="form-control @error('tarifas') is-invalid @enderror" type="number" name="tarifas" value="{{ old('tarifas', $categorias->tarifas) }}">
                            @error('tarifas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                    </div>
                    
                    <br>
                    <br>

                    <button class="btn btn-primary" type="submit">Guardar Categoria</button>
                    <a class="btn btn-secondary" href="{{ route('categorias.index') }}">Cancelar</a>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop

