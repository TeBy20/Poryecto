@extends("layouts.app")

@section("title", "Crear un nuevo Cargo")

@section("content")

<h1 class="d-flex justify-content-center">Crear un nuevo Cargo</h1>

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

    <form action="{{ route('cargos.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nombre_cargo">Nombre de cargo:</label>
            <input class="form-control @error('nombre_cargo') is-invalid @enderror" type="text" name="nombre_cargo" value="{{ old('nombre_cargo') }}">
            @error('nombre_cargo')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        

        <button class="btn btn-primary" type="submit">Guardar Cargo</button>
        <a class="btn btn-secondary" href="{{ route('cargos.index') }}">Cancelar</a>
    </form>
</div>

@endsection