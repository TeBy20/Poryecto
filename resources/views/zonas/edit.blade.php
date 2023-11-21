@extends("layouts.app")

@section("title", "Edición del Zona #" . $zona->id)

@section("content")
<h1 class="d-flex justify-content-center mx-auto">Edición del Zona #{{ $zona->id  }}</h1>

<div class="card border border-info mx-auto p-3 m-3" style="width: 40rem;">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('zonas.update', $zona->id) }}" method="POST" novalidate>
        @csrf
        @method("PUT")

        <label class="form-label" for="name">Nombre:</label><br>
        <input class="form-control" type="text" name="nombre_zona" value="{{ old('nombre_zona', $zona->nombre_zona) }}">

        <br>
        <br>

        <label class="form-label" for="unit_price">capacidad:</label><br>
        <input class="form-control" type="number" name="capacidad" value="{{ old('capacidad', $zona->capacidad) }}">
        
        <br>
        <br>

        <button class="btn btn-primary" type="submit">Guardar Zona</button>
        <a class="btn btn-secondary" href="{{ route('zonas.indexZonas') }}">Cancelar</a>
    </form>
</div>
@endsection