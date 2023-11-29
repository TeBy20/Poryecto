@extends('adminlte::page')

@section('plugins.Datatables', true)

@section('title', 'Cocheras')

@section('content_header')
@stop

@section('content')

<h1>Nueva de Cochera</h1>

<div class="container-fluid">
    <div class="row">
        @if (session('alert'))
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('alert') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('panel.cocheras.store') }}" method="POST" novalidate>

                        @csrf

                        <div class="form-group">
                            <label for="num_lugar">Cantidad de Cocheras:</label>
                            <input class="form-control @error('num_lugar') is-invalid @enderror" type="number" name="num_lugar" value="{{ old('num_lugar') }}">
                            @error('num_lugar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="piso">Piso para Cocheras:</label>
                            <input class="form-control" type="text" name="piso" value="{{ $piso }}" readonly>
                        </div>

                        <br>

                        <button class="btn btn-primary" type="submit">Crear Cocheras</button>

                        <a class="btn btn-secondary" href="{{ route('panel.cocheras.index') }}">Cancelar</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
