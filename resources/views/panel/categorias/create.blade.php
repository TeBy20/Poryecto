@extends("layouts.app")

@section("title", "Crear una nueva Categoira")

@section("content")

<h1 class="d-flex justify-content-center">Crear una nueva Categoria</h1>

<!-- @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif -->



@endsection

@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Cocheras')

@section('content_header')
    <h1>Lista de Cocheras</h1>
</section>

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
                <div class="card border border-info mx-auto p-2" style="width: 40rem;">

                    <form action="{{ route('categorias.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="form-group">
                            <label for="nombre_categorias">Nombre de categoria:</label>
                            <input class="form-control @error('nombre_categiria') is-invalid @enderror" type="text" name="nombre_categoria" value="{{ old('nombre_categoria') }}">
                            @error('nombre_categoria')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="capacidad">Tarifa:</label>
                            <input class="form-control @error('capacidad') is-invalid @enderror" type="number" name="tarifas" value="{{ old('tarifas') }}">
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
</div>
@stop
