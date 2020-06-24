@extends('layouts.app_admin_ui')
@section('title', '| Add Role')
@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Añadir un Rol</h1>
    <hr>
    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Asignar permisos</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
        {{ Form::checkbox('permissions[]',  $permission->id ) }}
        {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>

        @endforeach
    </div>

    {{ Form::submit('Añadir', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection