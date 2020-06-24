
@extends('layouts.app')

@section('content')
    <h3 class="page-title" style="text-align: center;">Listado</h3>

    <p>
        <a href="{{  route('frutas.create') }}" class="btn btn-success">Registrar</a>
    </p>

    <div class="panel panel-default">
       @include('flash-message')

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($list) > 0 ? 'datatable' : '' }}  ">
                <thead>
                    <tr>
                       
                        <th>Nombre</th>                        
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($list) > 0)
                        @foreach ($list as $lists)

                            <tr data-entry-id="{{ $lists->id }}">
                                 
                                <td>{{ $lists->nombre }}</td>  
                                <td><a href="{{ route('frutas.edit',[$id=$lists->id]) }}" class="btn btn-xs btn-success">Editar</a>{!! Form::open(array(
                                    'style' => 'display: inline-block;',
                                    'method' => 'DELETE',
                                    'onsubmit' => "return confirm('".trans("Estas seguro?")."');",
                                    'route' => ['frutas.destroy', $lists->id])) !!}
                                    {!! Form::submit('Eliminar', array('class' => 'btn btn-xs btn- red')) !!}
                                    {!! Form::close() !!} 
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7">No entries in table</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop