@extends('layouts.app_admin_ui')

@section('title', '| Permissions')

@section('content')
<!--
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>
-->
<div class="col-lg-12">
    <h1><i class="fa fa-key"></i>Lista de permiso

        <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Usuarios</a>
        <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a></h1>
    <hr>
    <div class="table-responsive">
        <a href="{{ URL::to('permissions/create') }}" class="btn btn-success">Añadir permiso</a>
        <table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">

            <thead>
                <tr>
                    <th>Permiso</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ URL::to('permissions/'.$permission->id.'/edit') }}" class="btn btn-info pull-left"
                            style="margin-right: 3px;">Editar</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id] ]) !!}
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