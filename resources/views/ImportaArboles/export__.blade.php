@extends('layouts.app')
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Reg Excel</title>
	<!--
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('css/editablegrid/editablegrid.css') }}" type="text/css" media="screen">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/micss.css') }}">
</head>
<body>
	<!--
	<header>
		<div class="container">
			<h3>Registro Excel</h3>
		</div>
	</header>
	-->
@section('content')
<div class="container-fluid">
	<section class=" col-lg-12 main row">

		
		<div class="">
		<div>
		{{ Form::open (['url' => 'export', 'method' => 'POST', 'class' => 'form-horizontal']) }}

		{!! csrf_field() !!}
		<br><a href="{{ route('home') }}" class="btn btn-lg btn-primary btn-danger">Cancelar</a>
		{{ Form::submit('Procesar', ['class' => 'btn btn-lg btn-primary pull-right', 'id' => 'request'])}}
		<!-- <a href="#" class="btn btn-primary pull-right">Procesar</a> --><br><br>
		</div>

			<!-- <table class="table table-hover">
			<script>
		        console.log(value);
        	</script>
				<div id="tablecontent"></div>
				@
			</table> -->

		<div class="table-responsive">
			<table class="table table-striped">
	            <thead>
	                <tr>
	                	<th>#</th>
	                    <th>ID Arbol</th>
	                    <th>Codigo</th>
	                    <th>Nombre Comun</th>
	                    <th>Comuna</th>
	                    <th>Barrio</th>
	                    <th>espacios</th>
	                    <th>DAP</th>
	                    <th>Altura_total</th>
	                    <th>diametro_mayor</th>
	                    <th>diametro_menor</th>
	                    <th>estado_arbol</th>
	                    <th>estado_sanitario</th>
	                    <th>observaciones</th>
	                    <th>concepto_tecnico</th>
	                    <th>longitud</th>
	                    <th>lantitud</th>
	                </tr>
	            </thead>
	            <tbody>
	            	@foreach($data as $key => $value)
					<tr>
						<td>{!! $i = $value['id'] + 1 !!}</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="id_arbol[]" value="{{ $value['id_arbol'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['id_arbol'])) ? $errors[$value['id']]['id_arbol'] : '' }}" class="{{ (isset($errors[$value['id']]['id_arbol'])) ? 'form-control has-error' : '' }}">
						</td>
						<td style="width: 30px;">
							<input type="text" size="10" id="{{ $value['id'] }}" name="codigo[]" value="{{ $value['codigo'] }}" data-toggle="popover" style="width: 71px;" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['codigo'])) ? $errors[$value['id']]['codigo'] : '' }}" class="{{ (isset($errors[$value['id']]['codigo'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="nombre_comun[]" value="{{ $value['nombre_comun'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['nombre_comun'])) ? $errors[$value['id']]['nombre_comun'] : '' }}" class="{{ (isset($errors[$value['id']]['nombre_comun'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="comunas[]" value="{{ $value['comunas'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['comunas'])) ? $errors[$value['id']]['comunas'] : '' }}" class="{{ (isset($errors[$value['id']]['comunas'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="barrio[]" value="{{ $value['barrio'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['barrio'])) ? $errors[$value['id']]['barrio'] : '' }}" class="{{ (isset($errors[$value['id']]['barrio'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="espacios[]" value="{{ $value['espacios'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['espacios'])) ? $errors[$value['id']]['espacios'] : '' }}" class="{{ (isset($errors[$value['id']]['espacios'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="dap[]" value="{{ $value['dap'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['dap'])) ? $errors[$value['id']]['dap'] : '' }}" class="{{ (isset($errors[$value['id']]['dap'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="altura_total[]" value="{{ $value['altura_total'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['altura_total'])) ? $errors[$value['id']]['altura_total'] : '' }}" class="{{ (isset($errors[$value['id']]['altura_total'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="diametro_mayor[]" value="{{ $value['diametro_mayor'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['diametro_mayor'])) ? $errors[$value['id']]['diametro_mayor'] : '' }}" class="{{ (isset($errors[$value['id']]['diametro_mayor'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="diametro_menor[]" value="{{ $value['diametro_menor'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['diametro_menor'])) ? $errors[$value['id']]['diametro_menor'] : '' }}" class="{{ (isset($errors[$value['id']]['diametro_menor'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="estado_arbol[]" value="{{ $value['estado_arbol'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['estado_arbol'])) ? $errors[$value['id']]['estado_arbol'] : '' }}" class="{{ (isset($errors[$value['id']]['estado_arbol'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="estado_sanitario[]" value="{{ $value['estado_sanitario'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['estado_sanitario'])) ? $errors[$value['id']]['estado_sanitario'] : '' }}" class="{{ (isset($errors[$value['id']]['estado_sanitario'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="observaciones[]" value="{{ $value['observaciones'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['observaciones'])) ? $errors[$value['id']]['observaciones'] : '' }}" class="{{ (isset($errors[$value['id']]['observaciones'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="concepto_tecnico[]" value="{{ $value['concepto_tecnico'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['concepto_tecnico'])) ? $errors[$value['id']]['concepto_tecnico'] : '' }}" class="{{ (isset($errors[$value['id']]['concepto_tecnico'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="longitud[]" value="{{ $value['longitud'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['longitud'])) ? $errors[$value['id']]['longitud'] : '' }}" class="{{ (isset($errors[$value['id']]['longitud'])) ? 'form-control has-error' : '' }}">
						</td>
						<td>
							<input type="text" size="10" id="{{ $value['id'] }}" name="lantitud[]" value="{{ $value['lantitud'] }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ (isset($errors[$value['id']]['lantitud'])) ? $errors[$value['id']]['lantitud'] : '' }}" class="{{ (isset($errors[$value['id']]['lantitud'])) ? 'form-control has-error' : '' }}">
						</td>


					</tr>

					@endforeach

	                {{ Form::close() }}
		        </tbody>
	        </table>
	        </div>
		</div>	
	</section>
</div>	



	
		<!-- <script src="{{ asset('js/editablegrid/editablegrid.js') }}"></script> -->
	<!-- [DO NOT DEPLOY] --> <!-- <script src="{{ asset('js/editablegrid/editablegrid_renderers.js') }}" ></script> -->
	<!-- [DO NOT DEPLOY] --> <!-- <script src="{{ asset('js/editablegrid/editablegrid_editors.js') }}" ></script> -->
	<!-- [DO NOT DEPLOY] --> <!-- <script src="{{ asset('js/editablegrid/editablegrid_validators.js') }}" ></script> -->
	<!-- [DO NOT DEPLOY] --> <!-- <script src="{{ asset('js/editablegrid/editablegrid_utils.js') }}" ></script> -->
	<!-- [DO NOT DEPLOY] --> <!-- <script src="{{ asset('js/editablegrid/editablegrid_charts.js') }}" ></script> -->
	<!-- <script type="text/javascript" src="{{ asset('js/tableEdit.js') }}"></script> -->	<!-- tabla editable-->
	@section('page-js-script')
	<!--
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
	-->
		<!-- mi ajax -->
	<script type="text/javascript" src="{{ asset('js/mijs.js') }} "></script>
	@endsection
@endsection

</body>
</html>