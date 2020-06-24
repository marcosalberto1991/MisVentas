@extends('layouts.app')

@section('content')
<div class="row" style="margin-left: 0px;margin-right: 0px;">
    <div class="col-lg-12 connectedSortable" >
        
        <h3 class="page-title">Frutas</h3>
        @if($operacion=='editar')
            {!! Form::model($data_form, ['method' => 'PUT', 'route' => ['frutas.update', $data_form->id]]) !!}
        @else 
            {!! Form::open(['method' => 'POST', 'route' => ['frutas.store']]) !!}
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar 
            </div>
            
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('nombre', 'Nombre*', ['class' => 'control-label']) !!}
                        {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        @if($errors->has('nombre'))
                        <div class="alert alert-danger" role="alert">
                            <b >{{ $errors->first('nombre') }}</b>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    {!! Form::submit('Aceptar', ['class' => 'btn btn-primary']) !!}
    <a class="btn btn-danger" href="{{ route('frutas.index') }}">Cancelar</a>
    {!! Form::close() !!}


    </div>
    <?php var_dump($errors) ?>
    @foreach($errors as $men)
           <h1>sss  $men->messages
    @endforeach
</div>
   
@stop
