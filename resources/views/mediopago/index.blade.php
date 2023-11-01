@extends('layouts.app')

@section('title', 'Listado de Medio Pago')

@section('content')

    @if(session("status"))
    <div class="alert alert-success">
        {{ session("status") }}
    </div>
    @endif

    <a class="btn btn-primary m-2" href="{{ route('mediopago.create') }}">Agregar</a>

    @if ($mediopagos->count())
    <table class="table table-striped mx-auto m-3">
        <thead class="table-dark">
            <tr>
                <th>Id</th>
                <th>Nombre de Medio Pago</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="table-primary">
            @foreach ($mediopagos as $mediopago)
            <tr>
                <td>{{ $mediopago->id }}</td>
                <td>{{ $mediopago->nombre_mediopago }}</td>
                <td>
                    <div class="btn-group" role="group">
                        
                        <a class="btn btn-warning" href="{{ route('mediopago.edit', $mediopago->id) }}">Editar</a>
                        
                        <form action="{{ route('mediopago.destroy', $mediopago->id) }}" method='POST'>
                            @csrf @method('DELETE')
                            
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
   
    @else
    <h4>¡No hay medio de pago cargadas!</h4>
    @endif
    @endsection
