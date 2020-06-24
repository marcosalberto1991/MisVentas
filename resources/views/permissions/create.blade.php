@extends('layouts.app_admin_ui')

@section('title', '| Create Permission')

@section('content')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous"></script>

<div class='col-lg-4 col-lg-offset-4'>

    {{-- @include ('errors.list') --}}

    <h1><i class='fa fa-key'></i> Añadir nuevo permiso</h1>
    <br>

    <p>Show</p>
    <p>Editar</p>
    <p>Add</p>
    <p>Eliminar</p>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Nombre') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>
    <br>

    @if(!$roles->isEmpty())

    <h4>Asignar permiso a roles</h4>

    @foreach ($roles as $role)
    {{ Form::checkbox('roles[]',  $role->id ) }}
    {{ Form::label($role->name, ucfirst($role->name)) }}<br>

    @endforeach

    @endif

    <br>
    {{ Form::submit('Añadir', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection