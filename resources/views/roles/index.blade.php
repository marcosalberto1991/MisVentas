@extends('layouts.app_admin_ui')
@section('title', '| Roles')
@section('content')
<div class="col-lg-10 col-lg-offset-1">
    <h1><i class="fa fa-key"></i> Roles
        <script src="https://code.jquery.com/jquery-2.2.4.js"
            integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

        <a href="{{ route('users.index') }}" class="btn btn-default pull-right">Usuarios</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permiso</a></h1>
    <hr>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover compact nowrap" id="postTable">
            <thead>
                <tr>
                    <th>Roles</th>
                    <th>Permiso</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($roles as $role)
                <tr>

                    <td>{{ $role->name }}</td>

                    <td>{{  $role->permissions()->pluck('name')->implode(' ') }}</td>
                    {{-- Retrieve array of permissions associated to a role and convert to string --}}
                    <td>
                        <a href="{{ URL::to('roles/'.$role->id.'/edit') }}" class="btn btn-info pull-left"
                            style="margin-right: 3px;">Editar</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]) !!}

                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                        <!--
                    @role('noticias_add')
                     I am a writer!
                    @else
                    I am not a writer...
                    @endrole

                    @can('noticias_add')
                     I am a writer!
                    @else
                    I am not a writer...
                    @endrole

                    @can('postscreate_2')
                     I am a postscreate!
                    @else
                    I am not a postscreate...
                    @endrole

                    @can('postscreate')
                     I am a postscreate!
                    @else
                    I am not a postscreate...
                    @endrole
                -->
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ URL::to('roles/create') }}" class="btn btn-success">Añadir un Rol</a>

</div>

@endsection