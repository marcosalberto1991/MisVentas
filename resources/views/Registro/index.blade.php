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
<script type='text/javascript'>
			<?php echo "const  Foraparqueadero_vehiculo_id= $parqueadero_vehiculo_id;"; ?>
			<?php echo "const  Forauser_id= $user_id;"; ?>
			</script>
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
			<h3 class="box-descripcion">Lista de Registro</h3>
		</div>          
		<div class="box-body">
	   		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<ul>
						<li><i class="fa fa-file-text-o"></i> Acciones</li>
						@can('Registro Add')
							<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Registro</li></a>
						@endcan
					</ul>
				</div>

				<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
					<thead>
					   

					<tr>
						<th>ID</th>
						<th>Consecutivo</th>
						<th>Fecha de ingreso</th>
						<th>Fecha de salida</th>
						<th>Fecha de pago</th>
						<th>Modificado en</th>
						<th>Creado en</th>
						<th>Valor de pagado</th>
						<th>Zona de estacionamiento</th>
						<th>Placa de vehículo</th>
						<th>Precio de Estacionamiento</th>
						<th>Usuario pago</th>
						<th>Ultima Modificación</th><th>Accion</th>
								
					</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>


					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}"" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
						<td class="col1">{{ $lists->cosecutivo }}</td>
						<td class="col1">{{ $lists->fecha_ingreso }}</td>
						<td class="col1">{{ $lists->fecha_salida }}</td>
						<td class="col1">{{ $lists->fecha_pago }}</td>
						<td class="col1">{{ $lists->updated_at }}</td>
						<td class="col1">{{ $lists->created_at }}</td>
						<td class="col1">{{ $lists->valor_pagado }}</td>
						<td class="col1">
						<script type="text/javascript">
							resulmunicipios_id=Foraparqueadero_vehiculo_id.find( cas => cas.id == {{ $lists->parqueadero_vehiculo_id }} );
							document.write(resulmunicipios_id.nombre); 
						</script>
						</td>
							<td class="col1">{{ $lists->placa_vehiculo }}</td>
						<td class="col1">{{ $lists->precio_estacionamiento }}</td>
						<td class="col1">
						<script type="text/javascript">
							resulmunicipios_id=Forauser_id.find( cas => cas.id == {{ $lists->user_id }} );
							document.write(resulmunicipios_id.nombre); 
						</script>
						</td>
							
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
						<td>
						@can('Registro Show')
						<button class="massshow-modal btn btn-success" 
						data-id="{{ $lists->id}}"
						data-cosecutivo="{{ $lists->cosecutivo}}"
						data-fecha_ingreso="{{ $lists->fecha_ingreso}}"
						data-fecha_salida="{{ $lists->fecha_salida}}"
						data-fecha_pago="{{ $lists->fecha_pago}}"
						data-updated_at="{{ $lists->updated_at}}"
						data-created_at="{{ $lists->created_at}}"
						data-valor_pagado="{{ $lists->valor_pagado}}"
						data-parqueadero_vehiculo_id="{{ $lists->parqueadero_vehiculo_id}}"
						data-placa_vehiculo="{{ $lists->placa_vehiculo}}"
						data-precio_estacionamiento="{{ $lists->precio_estacionamiento}}"
						data-user_id="{{ $lists->user_id}}"
						
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('Registro Editar')
						<button class="edit-modal btn btn-info" 
						data-id="{{ $lists->id}}"
						data-cosecutivo="{{ $lists->cosecutivo}}"
						data-fecha_ingreso="{{ $lists->fecha_ingreso}}"
						data-fecha_salida="{{ $lists->fecha_salida}}"
						data-fecha_pago="{{ $lists->fecha_pago}}"
						data-updated_at="{{ $lists->updated_at}}"
						data-created_at="{{ $lists->created_at}}"
						data-valor_pagado="{{ $lists->valor_pagado}}"
						data-parqueadero_vehiculo_id="{{ $lists->parqueadero_vehiculo_id}}"
						data-placa_vehiculo="{{ $lists->placa_vehiculo}}"
						data-precio_estacionamiento="{{ $lists->precio_estacionamiento}}"
						data-user_id="{{ $lists->user_id}}"
						
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('Registro Eliminar') 
						
						<button class="massdelete-modal btn btn-danger"
						data-id="{{ $lists->id}}"
						data-cosecutivo="{{ $lists->cosecutivo}}"
						data-fecha_ingreso="{{ $lists->fecha_ingreso}}"
						data-fecha_salida="{{ $lists->fecha_salida}}"
						data-fecha_pago="{{ $lists->fecha_pago}}"
						data-updated_at="{{ $lists->updated_at}}"
						data-created_at="{{ $lists->created_at}}"
						data-valor_pagado="{{ $lists->valor_pagado}}"
						data-parqueadero_vehiculo_id="{{ $lists->parqueadero_vehiculo_id}}"
						data-placa_vehiculo="{{ $lists->placa_vehiculo}}"
						data-precio_estacionamiento="{{ $lists->precio_estacionamiento}}"
						data-user_id="{{ $lists->user_id}}"
						
						
						><span class="glyphicon glyphicon-trash"></span>Eliminar</button>
				
						@endcan
										


						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		</div><!-- /.panel-body -->
		</div><!-- /.panel panel-default -->
	   </div>
	   </div>
	   </div>
	   </div>
</section>
@endsection

	<!-- Modal form to mass a form -->
	<div id="massModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-descripcion"></h4>
				</div>
				<div class="modal-body">
					<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
					<form class="form-horizontal" id="formmass" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="id_mass"  disabled>
							</div>
						</div>

							<!-- 
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>id:</label>
							<div class='col-sm-10'>
							-->
								<input type='hidden' class='form-control' id='id_mass' required='required' autofocus>
							<!--
								<p class='errorid text-center alert alert-danger hidden'></p>
							</div>
						</div>
						-->
							
						<div class='form-group' id='cosecutivo' >
							<label class='control-label col-sm-2' for='descripcion'>consecutivo:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='cosecutivo_mass' maxlength='45'   required='required' autofocus>
								<p class='errorcosecutivo text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fecha_ingreso' >
							<label class='control-label col-sm-2' for='descripcion'>Fecha de ingreso:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fecha_ingreso_mass' maxlength='45'   required='required' autofocus>
								<p class='errorfecha_ingreso text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fecha_salida' >
							<label class='control-label col-sm-2' for='descripcion'>Fecha de salida:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fecha_salida_mass'     required='required' autofocus>
								<p class='errorfecha_salida text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fecha_pago' >
							<label class='control-label col-sm-2' for='descripcion'>Fecha de pago:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fecha_pago_mass'     required='required' autofocus>
								<p class='errorfecha_pago text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='updated_at' >
							<label class='control-label col-sm-2' for='descripcion'>Modificado en:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
								<p class='errorupdated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='created_at' >
							<label class='control-label col-sm-2' for='descripcion'>created_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='valor_pagado' >
							<label class='control-label col-sm-2' for='descripcion'>valor de pagado:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='valor_pagado_mass' maxlength='45'   required='required' autofocus>
								<p class='errorvalor_pagado text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">parqueadero_vehiculo_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="parqueadero_vehiculo_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($parqueadero_vehiculo_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=parqueadero_vehiculo_id_mass" required="required" autofocus>
								-->
								<p class="errorparqueadero_vehiculo_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class='form-group' id='placa_vehiculo' >
							<label class='control-label col-sm-2' for='descripcion'>placa_vehiculo:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='placa_vehiculo_mass'     required='required' autofocus>
								<p class='errorplaca_vehiculo text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='precio_estacionamiento' >
							<label class='control-label col-sm-2' for='descripcion'>precio_estacionamiento:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='precio_estacionamiento_mass' maxlength='45'   required='required' autofocus>
								<p class='errorprecio_estacionamiento text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">user_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="user_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($user_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=user_id_mass" required="required" autofocus>
								-->
								<p class="erroruser_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						                        

					
					</form>
					<div class="modal-footer">

						<button type="button" id="acciones" class="btn btn-primary mass" data-dismiss="modal">
							<span class="glyphicon glyphicon-check"></span> massar
						</button>
						<button type="button" class="btn btn-warning" data-dismiss="modal">
							<span class="glyphicon glyphicon-remove"></span> Cerra
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
@section("page-js-files")	
<!--
	-->
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@stop	
@section("page-js-script")
	
			
<script type='text/javascript'>
	</script>

	<script type='text/javascript'>
		 $(document).on('click','.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo Dato');
			$('#massModal').modal('show');
		});
		  // Show a post
		$(document).on('click', '.massshow-modal', function() {
			$('.modal-descripcion').text('Vista de los Datos');
			$('#msdelete').text(' ');

			$('#id_mass').val($(this).data('id'));
			$('#cosecutivo_mass').val($(this).data('cosecutivo'));
			$('#fecha_ingreso_mass').val($(this).data('fecha_ingreso'));
			$('#fecha_salida_mass').val($(this).data('fecha_salida'));
			$('#fecha_pago_mass').val($(this).data('fecha_pago'));
			$('#updated_at_mass').val($(this).data('updated_at'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#valor_pagado_mass').val($(this).data('valor_pagado'));
			$('#parqueadero_vehiculo_id_mass').val($(this).data('parqueadero_vehiculo_id'));
			$('#placa_vehiculo_mass').val($(this).data('placa_vehiculo'));
			$('#precio_estacionamiento_mass').val($(this).data('precio_estacionamiento'));
			$('#user_id_mass').val($(this).data('user_id'));
			;
									
			
			$('#massModal').modal('show');
			$('#acciones').attr('class', 'btn btn-info hibe');
			$('#acciones').text('Visible');
			$('#acciones').attr('disabled');

		});
		// delete a post
		$(document).on('click', '.massdelete-modal', function() {
			$('.modal-descripcion').text('Eliminar los datos');
			$('#msdelete').text('¿Seguro que quieres borrar los datos?');

			

			$('#id_mass').val($(this).data('id'));
			$('#cosecutivo_mass').val($(this).data('cosecutivo'));
			$('#fecha_ingreso_mass').val($(this).data('fecha_ingreso'));
			$('#fecha_salida_mass').val($(this).data('fecha_salida'));
			$('#fecha_pago_mass').val($(this).data('fecha_pago'));
			$('#updated_at_mass').val($(this).data('updated_at'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#valor_pagado_mass').val($(this).data('valor_pagado'));
			$('#parqueadero_vehiculo_id_mass').val($(this).data('parqueadero_vehiculo_id'));
			$('#placa_vehiculo_mass').val($(this).data('placa_vehiculo'));
			$('#precio_estacionamiento_mass').val($(this).data('precio_estacionamiento'));
			$('#user_id_mass').val($(this).data('user_id'));
			;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Eliminar');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Registro/'+id,
				data: {
					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
					toastr.success('Dato Eliminado!', 'Operacion Exitosa', {timeOut: 5000});
					$('#item_' + data['id']).remove();
				
				}
			});
		});
		// add a new post
		$(document).on('click', '.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo registro');
			$('#msdelete').text(' ');

			$('#massmodal').modal('show');
			$('#acciones').attr('class', 'btn btn-success add');
			//$('#formmass').attr('id', 'form_add');
			$('#acciones').text('Añadir Nuevos ');
		});
		$('.modal-footer').on('click', '.add', function() {
			// add a new post
			$.ajax({
				type: 'POST',
				url: 'Registro',
				data: {

				'id': $('#id_mass').val(),
				'cosecutivo': $('#cosecutivo_mass').val(),
				'fecha_ingreso': $('#fecha_ingreso_mass').val(),
				'fecha_salida': $('#fecha_salida_mass').val(),
				'fecha_pago': $('#fecha_pago_mass').val(),
				'updated_at': $('#updated_at_mass').val(),
				'created_at': $('#created_at_mass').val(),
				'valor_pagado': $('#valor_pagado_mass').val(),
				'parqueadero_vehiculo_id': $('#parqueadero_vehiculo_id_mass').val(),
				'placa_vehiculo': $('#placa_vehiculo_mass').val(),
				'precio_estacionamiento': $('#precio_estacionamiento_mass').val(),
				'user_id': $('#user_id_mass').val(),
				
				'_token': $('input[name=_token]').val(),
				},
				error: function(jqXHR, text, error){
            	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
        		},
				success: function(data) { 
					if ((data.errors)) {
						verificar(data);
						$('#massModal').modal('show');
            			toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {timeOut: 5000});	

					} else {
						toastr.success('Operación Exitosa!', 'Datos Guardados', {timeOut: 5000});
						operaciones(data,'add');
					}
				},
			});
		});
						
//add

	// Edit a post
	$(document).on('click', '.edit-modal', function() {
		$("#id_mass").val($(this).data("id"));
		$("#cosecutivo_mass").val($(this).data("cosecutivo"));
		$("#fecha_ingreso_mass").val($(this).data("fecha_ingreso"));
		$("#fecha_salida_mass").val($(this).data("fecha_salida"));
		$("#fecha_pago_mass").val($(this).data("fecha_pago"));
		$("#updated_at_mass").val($(this).data("updated_at"));
		$("#created_at_mass").val($(this).data("created_at"));
		$("#valor_pagado_mass").val($(this).data("valor_pagado"));
		$("#parqueadero_vehiculo_id_mass").val($(this).data("parqueadero_vehiculo_id"));
		$("#placa_vehiculo_mass").val($(this).data("placa_vehiculo"));
		$("#precio_estacionamiento_mass").val($(this).data("precio_estacionamiento"));
		$("#user_id_mass").val($(this).data("user_id"));
		
		id = $('#id_mass').val();
		$('#acciones').attr('class', 'btn btn-warning edit');
		$('#acciones').text('Editar');
		$('.modal-descripcion').text('Editar un Dato');
		$('#massModal').modal('show');
		$('#msdelete').text(' ');
	});
	//edit a post
	$('.modal-footer').on('click', '.edit', function() {
		$.ajax({
			type: 'PUT',
			url: 'Registro/' + id,
			data: {
			'id': $('#id_mass').val(),
			'cosecutivo': $('#cosecutivo_mass').val(),
			'fecha_ingreso': $('#fecha_ingreso_mass').val(),
			'fecha_salida': $('#fecha_salida_mass').val(),
			'fecha_pago': $('#fecha_pago_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'valor_pagado': $('#valor_pagado_mass').val(),
			'parqueadero_vehiculo_id': $('#parqueadero_vehiculo_id_mass').val(),
			'placa_vehiculo': $('#placa_vehiculo_mass').val(),
			'precio_estacionamiento': $('#precio_estacionamiento_mass').val(),
			'user_id': $('#user_id_mass').val(),
			'_token': $('input[name=_token]').val()
			}, 
			error: function(jqXHR, text, error){
            	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {

				if(data.errors){
					verificar(data);
            		toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});	
					$('#massModal').modal('show');
					} else {
                	toastr.success('Modificación Exitosa Registro!', 'Datos Modificados', {timeOut: 5000});
                	operaciones(data,'edit');
			

  						$('.edit_published').on('ifChanged', function(event){
                            id = $(this).data('id');
                            $.ajax({
                                type: 'POST',
                                url: "{{ URL::route('changeStatus') }}",
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'id': id
                                },
                                success: function(data) {
                                    // empty
                                },
                            });
                        });
                       
                    }
                }
            });
        });
	</script>


<script type="text/javascript">
function verificar(data) {

	$('.errorid').addClass('hidden');
	$('.errorcosecutivo').addClass('hidden');
	$('.errorfecha_ingreso').addClass('hidden');
	$('.errorfecha_salida').addClass('hidden');
	$('.errorfecha_pago').addClass('hidden');
	$('.errorupdated_at').addClass('hidden');
	$('.errorcreated_at').addClass('hidden');
	$('.errorvalor_pagado').addClass('hidden');
	$('.errorparqueadero_vehiculo_id').addClass('hidden');
	$('.errorplaca_vehiculo').addClass('hidden');
	$('.errorprecio_estacionamiento').addClass('hidden');
	$('.erroruser_id').addClass('hidden');

	if (data.errors.id) {
    	$(".errorid").removeClass("hidden");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.cosecutivo) {
    	$(".errorcosecutivo").removeClass("hidden");
    	$(".errorcosecutivo").text(data.errors.cosecutivo);
    }
    
	if (data.errors.fecha_ingreso) {
    	$(".errorfecha_ingreso").removeClass("hidden");
    	$(".errorfecha_ingreso").text(data.errors.fecha_ingreso);
    }
    
	if (data.errors.fecha_salida) {
    	$(".errorfecha_salida").removeClass("hidden");
    	$(".errorfecha_salida").text(data.errors.fecha_salida);
    }
    
	if (data.errors.fecha_pago) {
    	$(".errorfecha_pago").removeClass("hidden");
    	$(".errorfecha_pago").text(data.errors.fecha_pago);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("hidden");
    	$(".errorupdated_at").text(data.errors.updated_at);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("hidden");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    
	if (data.errors.valor_pagado) {
    	$(".errorvalor_pagado").removeClass("hidden");
    	$(".errorvalor_pagado").text(data.errors.valor_pagado);
    }
    
	if (data.errors.parqueadero_vehiculo_id) {
    	$(".errorparqueadero_vehiculo_id").removeClass("hidden");
    	$(".errorparqueadero_vehiculo_id").text(data.errors.parqueadero_vehiculo_id);
    }
    
	if (data.errors.placa_vehiculo) {
    	$(".errorplaca_vehiculo").removeClass("hidden");
    	$(".errorplaca_vehiculo").text(data.errors.placa_vehiculo);
    }
    
	if (data.errors.precio_estacionamiento) {
    	$(".errorprecio_estacionamiento").removeClass("hidden");
    	$(".errorprecio_estacionamiento").text(data.errors.precio_estacionamiento);
    }
    
	if (data.errors.user_id) {
    	$(".erroruser_id").removeClass("hidden");
    	$(".erroruser_id").text(data.errors.user_id);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resulparqueadero_vehiculo_id=Foraparqueadero_vehiculo_id.find( cas => cas.id == data.parqueadero_vehiculo_id ); 
		const resuluser_id=Forauser_id.find( cas => cas.id == data.user_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.cosecutivo+"</td>"+
		"<td>"+ data.fecha_ingreso+"</td>"+
		"<td>"+ data.fecha_salida+"</td>"+
		"<td>"+ data.fecha_pago+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.valor_pagado+"</td>"+
		"<td>"+ resulparqueadero_vehiculo_id["nombre"]  +"</td>"+
		"<td>"+ data.placa_vehiculo+"</td>"+
		"<td>"+ data.precio_estacionamiento+"</td>"+
		"<td>"+ resuluser_id["nombre"]  +"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Registro Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-cosecutivo='"+ data.cosecutivo+"'"+
		"data-fecha_ingreso='"+ data.fecha_ingreso+"'"+
		"data-fecha_salida='"+ data.fecha_salida+"'"+
		"data-fecha_pago='"+ data.fecha_pago+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-valor_pagado='"+ data.valor_pagado+"'"+
		"data-parqueadero_vehiculo_id='"+ data.parqueadero_vehiculo_id+"'"+
		"data-placa_vehiculo='"+ data.placa_vehiculo+"'"+
		"data-precio_estacionamiento='"+ data.precio_estacionamiento+"'"+
		"data-user_id='"+ data.user_id+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Registro Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-cosecutivo='"+ data.cosecutivo+"'"+
		"data-fecha_ingreso='"+ data.fecha_ingreso+"'"+
		"data-fecha_salida='"+ data.fecha_salida+"'"+
		"data-fecha_pago='"+ data.fecha_pago+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-valor_pagado='"+ data.valor_pagado+"'"+
		"data-parqueadero_vehiculo_id='"+ data.parqueadero_vehiculo_id+"'"+
		"data-placa_vehiculo='"+ data.placa_vehiculo+"'"+
		"data-precio_estacionamiento='"+ data.precio_estacionamiento+"'"+
		"data-user_id='"+ data.user_id+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Registro Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-cosecutivo='"+ data.cosecutivo+"'"+
		"data-fecha_ingreso='"+ data.fecha_ingreso+"'"+
		"data-fecha_salida='"+ data.fecha_salida+"'"+
		"data-fecha_pago='"+ data.fecha_pago+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-valor_pagado='"+ data.valor_pagado+"'"+
		"data-parqueadero_vehiculo_id='"+ data.parqueadero_vehiculo_id+"'"+
		"data-placa_vehiculo='"+ data.placa_vehiculo+"'"+
		"data-precio_estacionamiento='"+ data.precio_estacionamiento+"'"+
		"data-user_id='"+ data.user_id+"'"+
		 
		"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button>  "+
	@endcan
	" </td></tr>";

	if('edit'==operacion){		
		$('#item_'+data.id).replaceWith(tabla);
	}
	if('add'==operacion){
		$('#postTable').append(tabla);
	}
} 
</script>
@stop
</body>
</html>

				
