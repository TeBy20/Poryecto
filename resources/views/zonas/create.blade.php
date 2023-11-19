@extends("layouts.app")

@section("title", "Crear una nueva Zona")

@section("content")

<h1 class="d-flex justify-content-center">Crear una nueva Zona</h1>

<!-- @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif -->

<div class="card border border-info mx-auto p-2" style="width: 40rem;">

    <form action="{{ route('zonas.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nombre_zona">Nombre:</label>
            <input class="form-control @error('nombre_zona') is-invalid @enderror" type="text" name="nombre_zona" value="{{ old('nombre_zona') }}">
            @error('nombre_zona')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>

        <div class="form-group">
            <label for="capacidad">capacidad:</label>
            <input class="form-control @error('capacidad') is-invalid @enderror" type="number" name="capacidad" value="{{ old('capacidad') }}">
            @error('capacidad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <br>
        

        <button class="btn btn-primary" type="submit">Guardar Zona</button>
        <a class="btn btn-secondary" href="{{ route('zonas.indexZonas') }}">Cancelar</a>
    </form>
</div>

@endsection