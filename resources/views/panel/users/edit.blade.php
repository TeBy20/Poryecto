@extends('adminlte::page')

@section('content')
    @php
        use Collective\Html\FormFacade as Form;
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Usuario</h3>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="h5">Nombre:</label>
                    <p class="form-control">{{ $user->name }}</p>
                </div>

                <div class="form-group">
                    <label for="email" class="h5">Correo Electrónico:</label>
                    <p class="form-control">{{ $user->email }}</p>
                </div>

                <h2 class="h5">Listado de roles</h2>

                {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put', 'id' => 'roleForm']) !!}

                @foreach ($roles as $role)
                    <div class="form-check">
                        {!! Form::checkbox('roles[]', $role->id, in_array($role->id, $user->roles->pluck('id')->toArray()), ['class' => 'form-check-input', 'onclick' => 'checkRoles(this)']) !!}
                        {!! Form::label('roles[]', $role->name, ['class' => 'form-check-label']) !!}
                    </div>
                @endforeach

                {!! Form::submit('Asignar rol', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Volver al Inicio</a>
    </div>

    <script>
        function checkRoles(checkbox) {
            var checkboxes = document.querySelectorAll('.form-check-input');
            
            checkboxes.forEach(function (element) {
                if (element !== checkbox) {
                    element.checked = false;
                }
            });
        }
    </script>
@endsection
