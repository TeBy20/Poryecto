@extends("layouts.app")

@section("title", "Edición del Medio de pago #" . $mediopago->id)

@section("content")
<h1 class="d-flex justify-content-center mx-auto">Edición de Medio de pago #{{ $mediopago->id }}</h1>

<div class="card border border-info mx-auto p-3 m-3" style="width: 40rem;">
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif

    <form action="{{ route('mediopago.update', $mediopago->id) }}" method="POST" novalidate>
        @csrf
        @method("PUT")

        <label class="form-label" for="name">Nombre de Medio de pago:</label><br>
        <input class="form-control" type="text" name="nombre_mediopago" value="{{ old('nombre_mediopago', $mediopago->nombre_mediopago) }}">

        <br>

        <button class="btn btn-primary" type="submit">Guardar Medio de pago</button>
        <a class="btn btn-secondary" href="{{ route('mediopago.index') }}">Cancelar</a>
    </form>
</div>
@endsection