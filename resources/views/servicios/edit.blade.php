@extends("layouts.app")

@section("title", "Edición del Servicio #" . $servicios->id)

@section("content")
<h1 class="d-flex justify-content-center mx-auto">Edición de servicio #{{ $servicios->id }}</h1>

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

    <form action="{{ route('servicios.update', $servicios->id) }}" method="POST" novalidate>
        @csrf
        @method("PUT")

        <label class="form-label" for="name">Nombre de Servicio:</label><br>
        <input class="form-control" type="text" name="nombre_servicio" value="{{ old('nombre_servicio', $servicios->nombre_servicio) }}">

        <br>

        <label class="form-label" for="precio">Precio:</label><br>
        <input class="form-control" type="number" name="Precio" value="{{ old('precio', $servicios->precio) }}">
        
        <br>

        <button class="btn btn-primary" type="submit">Guardar Servicios</button>
        <a class="btn btn-secondary" href="{{ route('servicios.index') }}">Cancelar</a>
    </form>
</div>
@endsection