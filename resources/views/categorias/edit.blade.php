@extends("layouts.app")

@section("title", "Edición de la Categoria #" . $categorias->id)

@section("content")
<h1 class="d-flex justify-content-center mx-auto">Edición de categoria #{{ $categorias->id }}</h1>

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
@endsection