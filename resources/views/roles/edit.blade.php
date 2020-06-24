@extends('layouts.app_admin_ui')

@section('title', '| Editar Rol')

@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>

<div class='col-lg-4 col-lg-offset-4'>
    <h1><i class='fa fa-key'></i> Editar Rol: {{$role->name}}</h1>
    <hr>
    {{-- @include ('errors.list')
 --}}
    {{ Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre de rol') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}


    </div>

    <h5><b>Asignar permisos</b></h5>
    @foreach ($permissions as $permission)

    {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
    {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
    {{ Form::submit('Editar', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}
</div>

@endsection