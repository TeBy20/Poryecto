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
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('categorias.update', $categorias->id) }}" method="POST" novalidate>
                    @csrf
                    @method("PUT")

                    <label class="form-label" for="name">Nombre de Categoria:</label><br>
                    <input class="form-control" type="text" name="nombre_categoria" value="{{ old('nombre_categoria', $categorias->nombre_categoria) }}">

                    <br>
                    <br>

                    <label class="form-label" for="tarifas">Tarifas:</label><br>
                    <input class="form-control" type="number" name="tarifas" value="{{ old('tarifas', $categorias->tarifas) }}">
                    
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

