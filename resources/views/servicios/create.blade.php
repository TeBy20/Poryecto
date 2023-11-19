@extends("layouts.app")

@section("title", "Crear un nuevo Servicio")

@section("content")

<h1 class="d-flex justify-content-center">Crear un nuevo Servicio</h1>

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

    <form action="{{ route('servicios.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nombre_servicio">Nombre de servicio:</label>
            <input class="form-control @error('nombre_servicio') is-invalid @enderror" type="text" name="nombre_servicio" value="{{ old('nombre_servicio') }}">
            @error('nombre_servicio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <br>

        <div class="form-group">
            <label for="capacidad">Precio:</label>
            <input class="form-control @error('precio') is-invalid @enderror" type="number" name="precio" value="{{ old('precio') }}">
            @error('precio')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        <br>
        

        <button class="btn btn-primary" type="submit">Guardar Servicio</button>
        <a class="btn btn-secondary" href="{{ route('servicios.index') }}">Cancelar</a>
    </form>
</div>

@endsection