@extends('layouts.app')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="utf-8"/>
        <title>
            Reg Excel
        </title>
        <!--
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	-->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/editablegrid/editablegrid.css') }}" media="screen" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('css/micss.css') }}" rel="stylesheet" type="text/css"/>
    <style type="text/css">
    	.form-control{
    		width: 100px;
    	}
    </style>


    </head>
</html>
<body>
  
    @section('content')
    <div class="container-fluid">
        <section class=" col-lg-12 main row">
            <div class="">
                <div>
                    {{ Form::open (['url' => 'ImportaArboles/export', 'method' => 'POST', 'class' => 'form-horizontal']) }}
					{!! csrf_field() !!}
                    <br>
                        <a class="btn btn-lg btn-primary btn-danger" href="{{ action('ImportaArbolesController@index') }}">
                            Cancelar
                        </a>
                        {{ Form::submit('Procesar', ['class' => 'btn btn-lg btn-primary pull-right', 'id' => 'request'])}}
                        <!-- <a href="#" class="btn btn-primary pull-right">Procesar</a> -->
                        <br>
                            <br>
                            </br>
                        </br>
                    </br>
                </div>
                <!-- <table class="table table-hover">
			<script>
		        console.log(value);
        	</script>
				<div id="tablecontent"></div>
				@
			</table> -->
                <html>
                    <head>
                    </head>
                    <body>
                        <script crossorigin="anonymous" integrity="sha256-JAW99MJVpJBGcbzEuXk4Az05s/XyDdBomFqNlM3ic+I=" src="https://code.jquery.com/jquery-3.2.0.min.js">
                        </script>
                        <script>
                            //Esta es la función que una vez se cargue el documento será gatillada.
                        </script>
                    </body>
                </html>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>ID Árbol</th>
                                <th>Código</th>
                                <!--
                                <th>Categoría árbol</th>
                                -->
                                <th>Categoría árbol_foraneo</th>
                                <th>Especie árbol en el Excel</th>
                                <th>Especie árbol en la aplicación</th>
                                <th>Coordenada X</th>
                                <th>Coordenadas Y</th>
                                <th>Dirección</th>
                                <th>Barrio en el Excel</th>
                                <th>Barrio en la aplicación</th>
                                <th>Zona en el Excel</th>
                                <th>Zona en la aplicación</th>
                                <th>Latitud</th>
                                <th>Longitud</th>
                                <th>DAP</th>
                                <th>Altura total</th>
                                <th>Diámetro mayor de copa</th>
                                <th>Diámetro menor de copa</th>
                                <th>Fecha</th>
                                <th>Estado físico en el Excel</th>
                                <th>Estado físico en la aplicación</th>
                                <th>Estado sanitario</th>
                                <th>Estado sanitario en el excel</th>
                                <th>Observaciones</th>
                                <th>Responsable</th>
                                <th>Tipo de proceso</th>
                                <th>Diámetro ecuatorial</th>
                                <th>Tipo de procesos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)
                            <tr>
                                <td>
                                    {!! $i = $value['id'] + 1 !!}
                                </td>
                                <td style="width: 30px;">
                                    <input class="{{ (isset($errors[$value['id']]['id_arbol'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['id_arbol'])) ? $errors[$value['id']]['id_arbol'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="id_arbol[]" size="10" style="width: 71px;" type="text" value="{{ $value['id_arbol'] }}"/>
                                </td>
                                <td style="width: 30px;">
                                    <input class="{{ (isset($errors[$value['id']]['codigo'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['codigo'])) ? $errors[$value['id']]['codigo'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="codigo[]" size="10" style="width: 71px;" type="text" value="{{ $value['codigo'] }}"/>
                                </td>
                               
                                <td class=" {{ (isset($errors[$value['id']]['categoria_arbol_id_foraneo'])) ? 'select2-danger' : '' }}" >
                                    <select class="busca_select {{ (isset($errors[$value['id']]['categoria_arbol_id_foraneo'])) ? 'form-control has-error select2-danger' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['categoria_arbol_id_foraneo'])) ? $errors[$value['id']]['categoria_arbol_id_foraneo'] : '' }}" id="categoria_arbol_id_foraneo-{{$i}}" name="categoria_arbol_id_foraneo[]" value="{{ $value['categoria_arbol_id_foraneo'] }}"
                                    id="inputError" >
                                        <option value="">
                                        </option>
                                        @foreach($categoria_arbol_id_foraneo as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#categoria_arbol_id_foraneo-{{$i}}").val('{{ $value['categoria_arbol_id_foraneo'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['especie_id'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['especie_id'])) ? $errors[$value['id']]['especie_id'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="especie_id[]" size="10" type="text" value="{{ $value['especie_id'] }}"/>
                                </td>
                                <td>
                                    <select class="busca_select {{ (isset($errors[$value['id']]['especie_id_foraneo'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['especie_id_foraneo'])) ? $errors[$value['id']]['especie_id_foraneo'] : '' }}" id="especie_id_foraneo-{{$i}}" name="especie_id_foraneo[]" value="{{ $value['especie_id_foraneo'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($especie_id as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#especie_id_foraneo-{{$i}}").val('{{ $value['especie_id_foraneo'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['coordenadax'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['coordenadax'])) ? $errors[$value['id']]['coordenadax'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="coordenadax[]" size="10" type="text" value="{{ $value['coordenadax'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['coordenaday'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['coordenaday'])) ? $errors[$value['id']]['coordenaday'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="coordenaday[]" size="10" type="text" value="{{ $value['coordenaday'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['direccion'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['direccion'])) ? $errors[$value['id']]['direccion'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="direccion[]" size="10" type="text" value="{{ $value['direccion'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['barrio_id'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['barrio_id'])) ? $errors[$value['id']]['barrio_id'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="barrio_id[]" size="10" type="text" value="{{ $value['barrio_id'] }}"/>
                                </td>
                                <td>
                                    <select class="busca_select {{ (isset($errors[$value['id']]['barrio_id_foraneo'])) ? 'form-control has-error select2-danger' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['barrio_id_foraneo'])) ? $errors[$value['id']]['barrio_id_foraneo'] : '' }}" id="barrio_id_foraneo-{{$i}}" name="barrio_id_foraneo[]" value="{{ $value['barrio_id_foraneo'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($barrio_id as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){$("#barrio_id_foraneo-{{$i}}").val('{{ $value['barrio_id_foraneo'] }}').trigger('change.select2')});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['zona'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['zona'])) ? $errors[$value['id']]['zona'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="zona[]" size="10" type="text" value="{{ $value['zona'] }}"/>
                                </td>
                                <td>
                                    <select class="busca_select {{ (isset($errors[$value['id']]['zona_foranea'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['zona_foranea'])) ? $errors[$value['id']]['zona_foranea'] : '' }}" id="zona_foranea-{{$i}}" name="zona_foranea[]" value="{{ $value['zona_foranea'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($zona_foranea as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#zona_foranea-{{$i}}").val('{{ $value['zona_foranea'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['latitud'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['latitud'])) ? $errors[$value['id']]['latitud'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="latitud[]" size="10" type="text" value="{{ $value['latitud'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['longitud'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['longitud'])) ? $errors[$value['id']]['longitud'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="longitud[]" size="10" type="text" value="{{ $value['longitud'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['dap'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['dap'])) ? $errors[$value['id']]['dap'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="dap[]" size="10" type="text" value="{{ $value['dap'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['altura_total'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['altura_total'])) ? $errors[$value['id']]['altura_total'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="altura_total[]" size="10" type="text" value="{{ $value['altura_total'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['diametro_mayor_copa_m'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['diametro_mayor_copa_m'])) ? $errors[$value['id']]['diametro_mayor_copa_m'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="diametro_mayor_copa_m[]" size="10" type="text" value="{{ $value['diametro_mayor_copa_m'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['diametro_menor_copa_m'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['diametro_menor_copa_m'])) ? $errors[$value['id']]['diametro_menor_copa_m'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="diametro_menor_copa_m[]" size="10" type="text" value="{{ $value['diametro_menor_copa_m'] }}"/>
                                </td>
                                <td>
                                    <input class=" datepicker {{ (isset($errors[$value['id']]['fecha'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['fecha'])) ? $errors[$value['id']]['fecha'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="fecha[]" size="10" type="text" value="{{ $value['fecha'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['estadofisico'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['estadofisico'])) ? $errors[$value['id']]['estadofisico'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="estadofisico[]" size="10" type="text" value="{{ $value['estadofisico'] }}"/>
                                </td>
                                <td>
                                    <select class=" busca_select {{ (isset($errors[$value['id']]['estadofisico_foraneo'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['estadofisico_foraneo'])) ? $errors[$value['id']]['estadofisico_foraneo'] : '' }}" id="estadofisico_foraneo-{{$i}}" name="estadofisico_foraneo[]" value="{{ $value['estadofisico_foraneo'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($estadofisico_foraneo as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#estadofisico_foraneo-{{$i}}").val('{{ $value['estadofisico_foraneo'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['estadosanitario'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['estadosanitario'])) ? $errors[$value['id']]['estadosanitario'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="estadosanitario[]" size="10" type="text" value="{{ $value['estadosanitario'] }}"/>
                                </td>
                                <td>
                                    <select class="busca_select {{ (isset($errors[$value['id']]['estadosanitario_foraneo'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['estadosanitario_foraneo'])) ? $errors[$value['id']]['estadosanitario_foraneo'] : '' }}" id="estadosanitario_foraneo-{{$i}}" name="estadosanitario_foraneo[]" value="{{ $value['estadosanitario_foraneo'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($estadosanitario_foraneo as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#estadosanitario_foraneo-{{$i}}").val('{{ $value['estadosanitario_foraneo'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['observaciones'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['observaciones'])) ? $errors[$value['id']]['observaciones'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="observaciones[]" size="10" type="text" value="{{ $value['observaciones'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['responsable'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['responsable'])) ? $errors[$value['id']]['responsable'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="responsable[]" size="10" type="text" value="{{ $value['responsable'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['tipo_proceso_id'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['tipo_proceso_id'])) ? $errors[$value['id']]['tipo_proceso_id'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="tipo_proceso_id[]" size="10" type="text" value="{{ $value['tipo_proceso_id'] }}"/>
                                </td>
                                <td>
                                    <input class="{{ (isset($errors[$value['id']]['diametro_ecuatorial'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['diametro_ecuatorial'])) ? $errors[$value['id']]['diametro_ecuatorial'] : '' }}" data-placement="top" data-toggle="popover" data-trigger="hover" id="{{ $value['id'] }}" name="diametro_ecuatorial[]" size="10" type="text" value="{{ $value['diametro_ecuatorial'] }}"/>
                                </td>
                                <td>
                                    <select class="busca_select {{ (isset($errors[$value['id']]['tipo_proceso_id_foraneo'])) ? 'form-control has-error' : 'form-control' }}" data-content="{{ (isset($errors[$value['id']]['tipo_proceso_id_foraneo'])) ? $errors[$value['id']]['tipo_proceso_id_foraneo'] : '' }}" id="tipo_proceso_id_foraneo-{{$i}}" name="tipo_proceso_id_foraneo[]" value="{{ $value['tipo_proceso_id_foraneo'] }}">
                                        <option value="">
                                        </option>
                                        @foreach($tipo_proceso_id_foraneo as $lists)
                                        <option value="{{$lists->id}}">
                                            {{$lists->nombre}}
                                        </option>
                                        @endforeach
                                    </select>
                                    <script type="text/javascript">
                                        $(function(){
        										$("#tipo_proceso_id_foraneo-{{$i}}").val('{{ $value['tipo_proceso_id_foraneo'] }}').trigger('change.select2')
    										});
                                    </script>
                                </td>
                            </tr>
                            <?php
                            /*
                            if($i==8){
                            exit();
                            	
                            }
                            */
                             ?>
                            @endforeach
	                {{ Form::close() }}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>


        


    </div>
    <style type="text/css">
    	.form-control{
    		width: 100px;
    	}
    	.select2-danger >select{	
    		border: 1px solid #f70303 !important;
    		border-radius: 0 !important;
    		padding: 6px 12px !important;
    		height: 34px !important;
    	}
        .has-error>span>span>span{
            border: 1px solid #ff5722 !important;
        }
        .form-control{
            border-color: #00a65a;
        }
    </style>

    <!-- <script src="{{ asset('js/editablegrid/editablegrid.js') }}"></script> -->
    <!-- [DO NOT DEPLOY] -->
    <!-- <script src="{{ asset('js/editablegrid/editablegrid_renderers.js') }}" ></script> -->
    <!-- [DO NOT DEPLOY] -->
    <!-- <script src="{{ asset('js/editablegrid/editablegrid_editors.js') }}" ></script> -->
    <!-- [DO NOT DEPLOY] -->
    <!-- <script src="{{ asset('js/editablegrid/editablegrid_validators.js') }}" ></script> -->
    <!-- [DO NOT DEPLOY] -->
    <!-- <script src="{{ asset('js/editablegrid/editablegrid_utils.js') }}" ></script> -->
    <!-- [DO NOT DEPLOY] -->
    <!-- <script src="{{ asset('js/editablegrid/editablegrid_charts.js') }}" ></script> -->
    <!-- <script type="text/javascript" src="{{ asset('js/tableEdit.js') }}"></script> -->
    <!-- tabla editable-->
    @section('page-js-script')
    <!--
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	-->
    <!-- mi ajax -->
    <script src="{{ asset('js/mijs.js') }} " type="text/javascript">
    </script>
    @endsection
@endsection
</body>
