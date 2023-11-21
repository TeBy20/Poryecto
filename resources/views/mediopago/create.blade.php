@extends("layouts.app")

@section("title", "Crear un nuevo Medio de pago")

@section("content")

<h1 class="d-flex justify-content-center">Crear un nuevo medio de pago</h1>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

<div class="card border border-info mx-auto p-2" style="width: 40rem;">

    <form action="{{ route('mediopago.store') }}" method="POST" novalidate>
        @csrf

        <div class="form-group">
            <label for="nombre_mediopago">Nombre de medio de pago:</label>
            <br>
            <br>
            <input class="form-control @error('nombre_mediopago') is-invalid @enderror" type="text" name="nombre_mediopago" value="{{ old('nombre_mediopago') }}">
            @error('nombre_mediopago')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <br>
        
        <button class="btn btn-primary" type="submit">Guardar medio pago</button>
        <a class="btn btn-secondary" href="{{ route('mediopago.index') }}">Cancelar</a>
    </form>
</div>

@endsection