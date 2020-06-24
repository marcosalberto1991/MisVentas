@extends('layouts.app')

@section('content')
   
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Editar {{$editar->name}}</h1>
    <hr>
    {{-- @include ('errors.list') --}}

    {{ Form::model($editar, array('route' => array('frutas.update', $editar->id), 'method' => 'PUT')) }} {{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('nombre', 'Nombre') }}
        {{ Form::text('nombre', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Correo') }}
        {{ Form::email('email', null, array('class' => 'form-control')) }}
    </div>

   

    {{ Form::submit('Añadir', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>
   
@stop