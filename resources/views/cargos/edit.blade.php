@extends("layouts.app")

@section("title", "Edición del cargo #" . $cargos->id)

@section("content")
<h1 class="d-flex justify-content-center mx-auto">Edición de cargo #{{ $cargos->id }}</h1>

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

    <form action="{{ route('cargos.update', $cargos->id) }}" method="POST" novalidate>
        @csrf
        @method("PUT")

        <label class="form-label" for="name">Nombre de Cargo:</label><br>
        <input class="form-control" type="text" name="nombre_cargo" value="{{ old('nombre_cargo', $cargos->nombre_cargo) }}">

        <br>

        <button class="btn btn-primary" type="submit">Guardar Cargo</button>
        <a class="btn btn-secondary" href="{{ route('cargos.index') }}">Cancelar</a>
    </form>
</div>
@endsection