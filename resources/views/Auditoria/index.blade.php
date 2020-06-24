@extends('layouts.app_mosnter')
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
			<?php echo "const  Forauser_id= $user_id;"; ?>
			<?php echo "const  Foraauditable_id= $auditable_id;"; ?>
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
			<h3 class="box-descripcion">Filtrar datos de auditoria</h3>
		<br>
		<form class="form-horizontal" id="formmass"  method="post" action="Auditoria" role="form">
			<div class="col-md-6">
				<div class='form-group' id='nombre' >
					
					<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

					<label class='control-label col-sm-2' for='descripcion'>Fecha inicial:</label>
					<div class='col-sm-10'>
						<input type='text' autocomplete="off" class='form-control input-number-line datepicker' name="fecha_inicial" value="{{$fecha_inicial_f}}" />
						<p class='errornombre text-center alert alert-danger hidden'></p>
					</div>
				</div>
				<br>
				<div class='form-group' id='nombre' >
					<label class='control-label col-sm-2' for='descripcion'>Fecha Final:</label>
					<div class='col-sm-10'>
						<input type='text' autocomplete="off"  class='form-control input-number-line datepicker' name="fecha_final" value="{{$fecha_final_f}}" />
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
						<select class="form-control multiple-select" id="multiples_wsa" name="usuario[]" multiple="multiple">
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
						<select class="form-control multiple-select" id="multiples_select" name="modelo[]" multiple="multiple">
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
						<select class="form-control multiple-select" id="multiples" name="eventos[]" multiple="multiple">
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


<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Auditoria</h3>
		</div>          
		<div class="box-body">
	   		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<ul>
						<li><i class="fa fa-file-text-o"></i> Acciones</li>
						@can('Auditoria Add')
							<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Auditoria</li></a>
						@endcan
							<a href="{{ action('AuditoriaController@pdf') }}" id="no_tiene" class=""><li>Imprimir reportes </li></a>
					</ul>
				</div>

				<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
					<thead>
					   

					<tr>
						<th>id</th>
						<th>Tipo de usuario</th>
						<th>Usuario</th>
						<th>Evento</th>
						<th>auditable_id</th>
						<th>auditable_type</th>
						<th>Valores viejos</th>
						<th>valores nuevos</th>
						<th>URL</th>
						<th>IP</th>
						<th>Navegador</th>
						<th>tags</th>
						<th>created_at</th>
						<th>updated_at</th>
						<th>Ultima Modificacion</th><th>Accion</th>
								
					</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>


					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}"" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
						<td class="col1">{{ $lists->user_type }}</td>
						<td class="col1">
						
                        <script type="text/javascript">
						//	resulmunicipios_id=Forauser_id.find( cas => cas.id == {{ $lists->user_id }} );
						//	document.write(resulmunicipios_id.nombre); 
                            
                        </script>
                            {{ $lists->user_id_pk->name }}
						</td>
							<td class="col1">{{ $lists->event }}</td>
						<td class="col1">
						<script type="text/javascript">
							resulmunicipios_id=Foraauditable_id.find( cas => cas.id == {{ $lists->auditable_id }} );
							document.write(resulmunicipios_id.nombre); 
						</script>
						</td>
							<td class="col1">{{ $lists->auditable_type }}</td>
						<td class="col1">{{ $lists->old_values }}</td>
						<td class="col1">{{ $lists->new_values }}</td>
						<td class="col1">{{ $lists->url }}</td>
						<td class="col1">{{ $lists->ip_address }}</td>
						<td class="col1">{{ $lists->user_agent }}</td>
						<td class="col1">{{ $lists->tags }}</td>
						<td class="col1">{{ $lists->created_at }}</td>
						<td class="col1">{{ $lists->updated_at }}</td>
						
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
						<td>
						@can('Auditoria Show')
						<button class="massshow-modal btn btn-success" 
						data-id="{{ $lists->id}}"
						data-user_type="{{ $lists->user_type}}"
						data-user_id="{{ $lists->user_id}}"
						data-event="{{ $lists->event}}"
						data-auditable_id="{{ $lists->auditable_id}}"
						data-auditable_type="{{ $lists->auditable_type}}"
						data-old_values="{{ $lists->old_values}}"
						data-new_values="{{ $lists->new_values}}"
						data-url="{{ $lists->url}}"
						data-ip_address="{{ $lists->ip_address}}"
						data-user_agent="{{ $lists->user_agent}}"
						data-tags="{{ $lists->tags}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('Auditoria Editar')
						<button class="edit-modal btn btn-info" 
						data-id="{{ $lists->id}}"
						data-user_type="{{ $lists->user_type}}"
						data-user_id="{{ $lists->user_id}}"
						data-event="{{ $lists->event}}"
						data-auditable_id="{{ $lists->auditable_id}}"
						data-auditable_type="{{ $lists->auditable_type}}"
						data-old_values="{{ $lists->old_values}}"
						data-new_values="{{ $lists->new_values}}"
						data-url="{{ $lists->url}}"
						data-ip_address="{{ $lists->ip_address}}"
						data-user_agent="{{ $lists->user_agent}}"
						data-tags="{{ $lists->tags}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('Auditoria Eliminar') 
						
						<button class="massdelete-modal btn btn-danger"
						data-id="{{ $lists->id}}"
						data-user_type="{{ $lists->user_type}}"
						data-user_id="{{ $lists->user_id}}"
						data-event="{{ $lists->event}}"
						data-auditable_id="{{ $lists->auditable_id}}"
						data-auditable_type="{{ $lists->auditable_type}}"
						data-old_values="{{ $lists->old_values}}"
						data-new_values="{{ $lists->new_values}}"
						data-url="{{ $lists->url}}"
						data-ip_address="{{ $lists->ip_address}}"
						data-user_agent="{{ $lists->user_agent}}"
						data-tags="{{ $lists->tags}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
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
							
						<div class='form-group' id='user_type' >
							<label class='control-label col-sm-2' for='descripcion'>user_type:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='user_type_mass' maxlength='191'   required='required' autofocus>
								<p class='erroruser_type text-center alert alert-danger hidden'></p>
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
						
						<div class='form-group' id='event' >
							<label class='control-label col-sm-2' for='descripcion'>event:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='event_mass' maxlength='191'   required='required' autofocus>
								<p class='errorevent text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">auditable_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="auditable_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($auditable_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=auditable_id_mass" required="required" autofocus>
								-->
								<p class="errorauditable_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class='form-group' id='auditable_type' >
							<label class='control-label col-sm-2' for='descripcion'>auditable_type:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='auditable_type_mass' maxlength='191'   required='required' autofocus>
								<p class='errorauditable_type text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='old_values' >
							<label class='control-label col-sm-2' for='descripcion'>old_values:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='old_values_mass'     required='required' autofocus>
								<p class='errorold_values text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='new_values' >
							<label class='control-label col-sm-2' for='descripcion'>new_values:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='new_values_mass'     required='required' autofocus>
								<p class='errornew_values text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='url' >
							<label class='control-label col-sm-2' for='descripcion'>url:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='url_mass'     required='required' autofocus>
								<p class='errorurl text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='ip_address' >
							<label class='control-label col-sm-2' for='descripcion'>ip_address:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='ip_address_mass' maxlength='45'   required='required' autofocus>
								<p class='errorip_address text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='user_agent' >
							<label class='control-label col-sm-2' for='descripcion'>user_agent:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='user_agent_mass' maxlength='191'   required='required' autofocus>
								<p class='erroruser_agent text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='tags' >
							<label class='control-label col-sm-2' for='descripcion'>tags:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='tags_mass' maxlength='191'   required='required' autofocus>
								<p class='errortags text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='created_at' >
							<label class='control-label col-sm-2' for='descripcion'>created_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='updated_at' >
							<label class='control-label col-sm-2' for='descripcion'>updated_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
								<p class='errorupdated_at text-center alert alert-danger hidden'></p>
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
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

	-->

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
			$('#user_type_mass').val($(this).data('user_type'));
			$('#user_id_mass').val($(this).data('user_id'));
			$('#event_mass').val($(this).data('event'));
			$('#auditable_id_mass').val($(this).data('auditable_id'));
			$('#auditable_type_mass').val($(this).data('auditable_type'));
			$('#old_values_mass').val($(this).data('old_values'));
			$('#new_values_mass').val($(this).data('new_values'));
			$('#url_mass').val($(this).data('url'));
			$('#ip_address_mass').val($(this).data('ip_address'));
			$('#user_agent_mass').val($(this).data('user_agent'));
			$('#tags_mass').val($(this).data('tags'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#updated_at_mass').val($(this).data('updated_at'));
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
			$('#user_type_mass').val($(this).data('user_type'));
			$('#user_id_mass').val($(this).data('user_id'));
			$('#event_mass').val($(this).data('event'));
			$('#auditable_id_mass').val($(this).data('auditable_id'));
			$('#auditable_type_mass').val($(this).data('auditable_type'));
			$('#old_values_mass').val($(this).data('old_values'));
			$('#new_values_mass').val($(this).data('new_values'));
			$('#url_mass').val($(this).data('url'));
			$('#ip_address_mass').val($(this).data('ip_address'));
			$('#user_agent_mass').val($(this).data('user_agent'));
			$('#tags_mass').val($(this).data('tags'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#updated_at_mass').val($(this).data('updated_at'));
			;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Eliminar');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Auditoria/'+id,
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
				url: 'Auditoria',
				data: {

				'id': $('#id_mass').val(),
				'user_type': $('#user_type_mass').val(),
				'user_id': $('#user_id_mass').val(),
				'event': $('#event_mass').val(),
				'auditable_id': $('#auditable_id_mass').val(),
				'auditable_type': $('#auditable_type_mass').val(),
				'old_values': $('#old_values_mass').val(),
				'new_values': $('#new_values_mass').val(),
				'url': $('#url_mass').val(),
				'ip_address': $('#ip_address_mass').val(),
				'user_agent': $('#user_agent_mass').val(),
				'tags': $('#tags_mass').val(),
				'created_at': $('#created_at_mass').val(),
				'updated_at': $('#updated_at_mass').val(),
				
				'_token': $('input[name=_token]').val(),
				},
				error: function(jqXHR, text, error){
            	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
        		},
				success: function(data) { 
					if ((data.errors)) {
						verificar(data);
						$('#massModal').modal('show');
            			toastr.error('Formato Inválido!', 'En el envio de la verificacion de datso <br>', {timeOut: 5000});	

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
		$("#user_type_mass").val($(this).data("user_type"));
		$("#user_id_mass").val($(this).data("user_id"));
		$("#event_mass").val($(this).data("event"));
		$("#auditable_id_mass").val($(this).data("auditable_id"));
		$("#auditable_type_mass").val($(this).data("auditable_type"));
		$("#old_values_mass").val($(this).data("old_values"));
		$("#new_values_mass").val($(this).data("new_values"));
		$("#url_mass").val($(this).data("url"));
		$("#ip_address_mass").val($(this).data("ip_address"));
		$("#user_agent_mass").val($(this).data("user_agent"));
		$("#tags_mass").val($(this).data("tags"));
		$("#created_at_mass").val($(this).data("created_at"));
		$("#updated_at_mass").val($(this).data("updated_at"));
		
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
			url: 'Auditoria/' + id,
			data: {
			'id': $('#id_mass').val(),
			'user_type': $('#user_type_mass').val(),
			'user_id': $('#user_id_mass').val(),
			'event': $('#event_mass').val(),
			'auditable_id': $('#auditable_id_mass').val(),
			'auditable_type': $('#auditable_type_mass').val(),
			'old_values': $('#old_values_mass').val(),
			'new_values': $('#new_values_mass').val(),
			'url': $('#url_mass').val(),
			'ip_address': $('#ip_address_mass').val(),
			'user_agent': $('#user_agent_mass').val(),
			'tags': $('#tags_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
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
                	toastr.success('Modificación Exitosa Auditoria!', 'Datos Modificados', {timeOut: 5000});
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
	$('.erroruser_type').addClass('hidden');
	$('.erroruser_id').addClass('hidden');
	$('.errorevent').addClass('hidden');
	$('.errorauditable_id').addClass('hidden');
	$('.errorauditable_type').addClass('hidden');
	$('.errorold_values').addClass('hidden');
	$('.errornew_values').addClass('hidden');
	$('.errorurl').addClass('hidden');
	$('.errorip_address').addClass('hidden');
	$('.erroruser_agent').addClass('hidden');
	$('.errortags').addClass('hidden');
	$('.errorcreated_at').addClass('hidden');
	$('.errorupdated_at').addClass('hidden');

	if (data.errors.id) {
    	$(".errorid").removeClass("hidden");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.user_type) {
    	$(".erroruser_type").removeClass("hidden");
    	$(".erroruser_type").text(data.errors.user_type);
    }
    
	if (data.errors.user_id) {
    	$(".erroruser_id").removeClass("hidden");
    	$(".erroruser_id").text(data.errors.user_id);
    }
    
	if (data.errors.event) {
    	$(".errorevent").removeClass("hidden");
    	$(".errorevent").text(data.errors.event);
    }
    
	if (data.errors.auditable_id) {
    	$(".errorauditable_id").removeClass("hidden");
    	$(".errorauditable_id").text(data.errors.auditable_id);
    }
    
	if (data.errors.auditable_type) {
    	$(".errorauditable_type").removeClass("hidden");
    	$(".errorauditable_type").text(data.errors.auditable_type);
    }
    
	if (data.errors.old_values) {
    	$(".errorold_values").removeClass("hidden");
    	$(".errorold_values").text(data.errors.old_values);
    }
    
	if (data.errors.new_values) {
    	$(".errornew_values").removeClass("hidden");
    	$(".errornew_values").text(data.errors.new_values);
    }
    
	if (data.errors.url) {
    	$(".errorurl").removeClass("hidden");
    	$(".errorurl").text(data.errors.url);
    }
    
	if (data.errors.ip_address) {
    	$(".errorip_address").removeClass("hidden");
    	$(".errorip_address").text(data.errors.ip_address);
    }
    
	if (data.errors.user_agent) {
    	$(".erroruser_agent").removeClass("hidden");
    	$(".erroruser_agent").text(data.errors.user_agent);
    }
    
	if (data.errors.tags) {
    	$(".errortags").removeClass("hidden");
    	$(".errortags").text(data.errors.tags);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("hidden");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("hidden");
    	$(".errorupdated_at").text(data.errors.updated_at);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resuluser_id=Forauser_id.find( cas => cas.id == data.user_id ); 
		const resulauditable_id=Foraauditable_id.find( cas => cas.id == data.auditable_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.user_type+"</td>"+
		"<td>"+ resuluser_id["nombre"]  +"</td>"+
		"<td>"+ data.event+"</td>"+
		"<td>"+ resulauditable_id["nombre"]  +"</td>"+
		"<td>"+ data.auditable_type+"</td>"+
		"<td>"+ data.old_values+"</td>"+
		"<td>"+ data.new_values+"</td>"+
		"<td>"+ data.url+"</td>"+
		"<td>"+ data.ip_address+"</td>"+
		"<td>"+ data.user_agent+"</td>"+
		"<td>"+ data.tags+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Auditoria Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-user_type='"+ data.user_type+"'"+
		"data-user_id='"+ data.user_id+"'"+
		"data-event='"+ data.event+"'"+
		"data-auditable_id='"+ data.auditable_id+"'"+
		"data-auditable_type='"+ data.auditable_type+"'"+
		"data-old_values='"+ data.old_values+"'"+
		"data-new_values='"+ data.new_values+"'"+
		"data-url='"+ data.url+"'"+
		"data-ip_address='"+ data.ip_address+"'"+
		"data-user_agent='"+ data.user_agent+"'"+
		"data-tags='"+ data.tags+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Auditoria Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-user_type='"+ data.user_type+"'"+
		"data-user_id='"+ data.user_id+"'"+
		"data-event='"+ data.event+"'"+
		"data-auditable_id='"+ data.auditable_id+"'"+
		"data-auditable_type='"+ data.auditable_type+"'"+
		"data-old_values='"+ data.old_values+"'"+
		"data-new_values='"+ data.new_values+"'"+
		"data-url='"+ data.url+"'"+
		"data-ip_address='"+ data.ip_address+"'"+
		"data-user_agent='"+ data.user_agent+"'"+
		"data-tags='"+ data.tags+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Auditoria Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-user_type='"+ data.user_type+"'"+
		"data-user_id='"+ data.user_id+"'"+
		"data-event='"+ data.event+"'"+
		"data-auditable_id='"+ data.auditable_id+"'"+
		"data-auditable_type='"+ data.auditable_type+"'"+
		"data-old_values='"+ data.old_values+"'"+
		"data-new_values='"+ data.new_values+"'"+
		"data-url='"+ data.url+"'"+
		"data-ip_address='"+ data.ip_address+"'"+
		"data-user_agent='"+ data.user_agent+"'"+
		"data-tags='"+ data.tags+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
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

				
