@extends('layouts.app')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">
<!-- CSFR token for ajax call -->
<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<!-- icheck checkboxes -->
<!--<link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">-->
{{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}
<!-- toastr notifications -->
{{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Font Awesome -->
{{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<style>
	.panel-heading {
		padding: 0;
	}
	.panel-heading ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
	}
	.panel-heading li {
		float: left;
		border-right:1px solid #bbb;
		display: block;
		padding: 14px 16px;
		text-align: center;
	}
	.panel-heading li:last-child:hover {
		background-color: #ccc;
	}
	.panel-heading li:last-child {
		border-right: none;
	}
	.panel-heading li a:hover {
		text-decoration: none;
	}

	.table.table-bordered tbody td {
		vertical-align: baseline;
	}
</style>
<script>

</script>
@section('content')
<section class="col-lg-12 connectedSortable">
	
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Reportes siembra de arboles</h3>
		<br>
		<form class="form-horizontal" id="formmass" target="_blank"  method="post" action="{{ action('ReportesController@auditoria_pdf') }}" role="form">
			<div class="col-md-6">
				<div class='form-group' id='nombre' >
					
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

					<label class='control-label col-sm-2' for='descripcion'>Fecha inicial:</label>
					<div class='col-sm-10'>
						<input type='text' autocomplete="off" class='form-control input-number-line datepicker' name="fecha_inicial"/>
						<p class='errornombre text-center alert alert-danger hidden'></p>
					</div>
				</div>
				<br>
				<div class='form-group' id='nombre' >
					<label class='control-label col-sm-2' for='descripcion'>Fecha Final:</label>
					<div class='col-sm-10'>
						<input type='text' autocomplete="off" class='form-control input-number-line datepicker' name="fecha_final"/>
						<p class='errornombre text-center alert alert-danger hidden'></p>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-warning" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span> Imprimir reportes
					</button>
				</div>
		   	</div>
			<div class="col-md-6">
				<div class='form-group' id='nombre' >
					<label class='control-label col-sm-2' for='descripcion'>Usuario:</label>
					<div class='col-sm-10'>
						<select class="form-control multiple-select" id="multiples_wqa" name="usuario[]" multiple="multiple">
						@foreach($usuario as $lists) 
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
						@endforeach
						</select>
						<!--
						<input type='text' class='form-control input-number-line datepicker' name="fecha_final"/>
						<p class='errornombre text-center alert alert-danger hidden'></p>
						-->
					</div>
				</div>
				<div class='form-group' id='nombre' >
					<label class='control-label col-sm-2' for='descripcion'>Modelo o controlador:</label>
					<div class='col-sm-10'>
						<select class="form-control multiple-select" id="multiples_wer" name="modelo[]" multiple="multiple">
						@foreach($auditable_type as $lists) 
							<option value="{{$lists->nombre}}">{{$lists->nombre}}</option>
						@endforeach
						</select>

						<!--
						<input type='text' class='form-control input-number-line datepicker' name="fecha_final"/>
						<p class='errornombre text-center alert alert-danger hidden'></p>
						-->
					</div>
				</div>
				<div class='form-group' id='nombre' >
					<label class='control-label col-sm-2' for='descripcion'>Eventos:</label>
					<div class='col-sm-10'>
						<select class="form-control multiple-select" id="multiples_swe" name="eventos[]" multiple="multiple">
						@foreach($event as $lists) 
							<option value="{{$lists->nombre}}">{{$lists->nombre}}</option>
						@endforeach
						</select>

						<!--
						<input type='text' class='form-control input-number-line datepicker' name="fecha_final"/>
						<p class='errornombre text-center alert alert-danger hidden'></p>
						-->
					</div>
				</div>
		   	
		   	</div>

		</form>
		</div>

	</div>
	
	  
</section>
@endsection

	<!-- Modal form to mass a form -->
	
	
@section("page-js-files")	
<!--
	-->
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop	
@section("page-js-script")


	



@stop
</body>
</html>

				
