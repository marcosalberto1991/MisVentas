@extends('layouts.app_admin_ui') 

@section('title', '| Users')

@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>

<div class="col-lg-11 ">
    <h1><i class="fa fa-users"></i> Administración de Usuario
        <a href="{{ route('users.create') }}" class="btn btn-success">Añadir un usuario</a>
        <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permiso</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover compact nowrap" id="postTable">

            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>correo</th>
                    <th>Fecha de creacion</th>
                    <th>Roles de usuarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                    <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>
                    {{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info pull-left"
                            style="margin-right: 3px;">Editar</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>


</div>

@endsection