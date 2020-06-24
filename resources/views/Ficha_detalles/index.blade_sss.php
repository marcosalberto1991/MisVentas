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
@section('content')




<section class="col-lg-12 connectedSortable">
	 <div class="box box-warning">
			<div class="box-header with-border">
			  <h3 class="box-descripcion">Lista de Ficha detalles</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i>Acciones</li>
					@can('Ficha_detalles Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Ficha_detalles</li></a>

					@endcan

					@hasrole('funciona')
										yo soy funciona!
										@else
										I m not a writer...
										@endhasrole
				</ul>
			</div>
		
			<div class="panel-body" style="overflow-x:auto;">
			<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
			<thead>
					   

			<tr>
		
		<th>Código Árbol</th>
		<th>DAP</th>
		<th>Altura total</th>
		<th>Diámetro mayor de copa</th>
		<th>Diámetro menor de copa</th>
		<th>fecha</th>
		<th>Numero de Árbol</th>
		<th>Estado físico</th>
		<th>Estado sanitario</th>
		<th>Observaciones</th>
		<th>Responsable</th>
		<th>Foto genera</th>
		<th>Foto Detalle</th>
		<th>Tipo de Proceso</th>
		<th>Diámetro Ecuatorial</th>
		<th>updated_at</th>
		<th>created_at</th>
		<th>Ultima Modificación</th><th>Accione</th>
							
							</tr>
							{{ csrf_field() }}
						</thead>
						<tbody>


							@foreach($listmysql as $lists)
						  
								<tr class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Foraarboles_id.find( cas => cas.id == {{ $lists->arboles_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		<td class="col1">{{ $lists->dap }}</td>
		<td class="col1">{{ $lists->altura_total }}</td>
		<td class="col1">{{ $lists->diametro_mayor_copa_m }}</td>
		<td class="col1">{{ $lists->diametro_menor_copa_m }}</td>
		<td class="col1">{{ $lists->fecha }}</td>
		<td class="col1">{{ $lists->arbol_num }}</td>
		<td class="col1">{{ $lists->estadofisico }}</td>
		<td class="col1">{{ $lists->estadosanitario }}</td>
		<td class="col1">{{ $lists->observaciones }}</td>
		<td class="col1">{{ $lists->responsable }}</td>
		<!--
		<td class="col1">{{ $lists->fotogeneral }}</td>
		<td class="col1">{{ $lists->fotodetalle }}</td>
		-->
		<td class="col1">
			<a target="_blank" href="{{ asset('ficha_detalle_foto/'.$lists->fotogeneral) }}">
				<img src="{{ asset('ficha_detalle_foto/'.$lists->fotogeneral) }}" width="40px" height="40px" >
			</a>
		</td>
		<td class="col1">
			<a target="_blank" href="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}">
				<img src="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}" width="40px" height="40px" >
			</a>
		</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Foratipo_proceso_id.find( cas => cas.id == {{ $lists->tipo_proceso_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		<td class="col1">{{ $lists->diametro_ecuatorial }}</td>
		<td class="col1">{{ $lists->updated_at }}</td>
		<td class="col1">{{ $lists->created_at }}</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										@can('Ficha_detalles Show')
												<button class="massshow-modal btn btn-success" 
												data-id="{{ $lists->id}}"
		data-arboles_id="{{ $lists->arboles_id}}"
		data-dap="{{ $lists->dap}}"
		data-altura_total="{{ $lists->altura_total}}"
		data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}"
		data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}"
		data-fecha="{{ $lists->fecha}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-estadofisico="{{ $lists->estadofisico}}"
		data-estadosanitario="{{ $lists->estadosanitario}}"
		data-observaciones="{{ $lists->observaciones}}"
		data-responsable="{{ $lists->responsable}}"
		data-fotogeneral="{{ $lists->fotogeneral}}"
		data-fotodetalle="{{ $lists->fotodetalle}}"
		data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}"
		data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-created_at="{{ $lists->created_at}}"
		
												
												>
												<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan		
										@can('Ficha_detalles Editar')
												<button class="edit-modal btn btn-info" 
												data-id="{{ $lists->id}}"
		data-arboles_id="{{ $lists->arboles_id}}"
		data-dap="{{ $lists->dap}}"
		data-altura_total="{{ $lists->altura_total}}"
		data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}"
		data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}"
		data-fecha="{{ $lists->fecha}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-estadofisico="{{ $lists->estadofisico}}"
		data-estadosanitario="{{ $lists->estadosanitario}}"
		data-observaciones="{{ $lists->observaciones}}"
		data-responsable="{{ $lists->responsable}}"
		data-fotogeneral="{{ $lists->fotogeneral}}"
		data-fotodetalle="{{ $lists->fotodetalle}}"
		data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}"
		data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-created_at="{{ $lists->created_at}}"
		
												
												><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Ficha_detalles Eliminar') 
												
												<button class="massdelete-modal btn btn-danger"
												data-id="{{ $lists->id}}"
		data-arboles_id="{{ $lists->arboles_id}}"
		data-dap="{{ $lists->dap}}"
		data-altura_total="{{ $lists->altura_total}}"
		data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}"
		data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}"
		data-fecha="{{ $lists->fecha}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-estadofisico="{{ $lists->estadofisico}}"
		data-estadosanitario="{{ $lists->estadosanitario}}"
		data-observaciones="{{ $lists->observaciones}}"
		data-responsable="{{ $lists->responsable}}"
		data-fotogeneral="{{ $lists->fotogeneral}}"
		data-fotodetalle="{{ $lists->fotodetalle}}"
		data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}"
		data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-created_at="{{ $lists->created_at}}"
		
												
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
						
								<input type="hidden" class="form-control" id="id_mass"  disabled>
							<!-- 
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
							</div>
						</div>

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
							
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">arboles_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="arboles_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($arboles_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=arboles_id_mass" required="required" autofocus>
								-->
								<p class="errorarboles_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class='form-group' id='dap' >
							<label class='control-label col-sm-2' for='descripcion'>dap:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-punto' id='dap_mass' maxlength='11'   required='required' autofocus>
								<p class='errordap text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='altura_total' >
							<label class='control-label col-sm-2' for='descripcion'>altura_total:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-punto' id='altura_total_mass' maxlength='11'   required='required' autofocus>
								<p class='erroraltura_total text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='diametro_mayor_copa_m' >
							<label class='control-label col-sm-2' for='descripcion'>diametro_mayor_copa_m:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-punto' id='diametro_mayor_copa_m_mass' maxlength='11'   required='required' autofocus>
								<p class='errordiametro_mayor_copa_m text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='diametro_menor_copa_m' >
							<label class='control-label col-sm-2 input-number-punto' for='descripcion'>diametro_menor_copa_m:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-punto' id='diametro_menor_copa_m_mass' maxlength='11'   required='required' autofocus>
								<p class='errordiametro_menor_copa_m text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fecha' >
							<label class='control-label col-sm-2' for='descripcion'>fecha:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-line' id='fecha_mass' maxlength='45'   required='required' autofocus>
								<p class='errorfecha text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='arbol_num' >
							<label class='control-label col-sm-2 ' for='descripcion'>arbol_num:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-line' id='arbol_num_mass' maxlength='45'   required='required' autofocus>
								<p class='errorarbol_num text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='estadofisico' >
							<label class='control-label col-sm-2' for='descripcion'>estadofisico:</label>
							<div class='col-sm-10'>
								<select class="form-control" id="estadofisico_mass" required="required" autofocus >
									<option value="1">Bueno</option>
									<option value="2">Medio</option>
									<option value="3">Malo</option>
								</select>
								<!--
								<input type='text' class='form-control' id='estadofisico_mass' maxlength='11'   required='required' autofocus>
								-->
								<p class='errorestadofisico text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='estadosanitario' >
							<label class='control-label col-sm-2' for='descripcion'>estadosanitario:</label>
							<div class='col-sm-10'>
								<select class="form-control" id="estadosanitario_mass" required="required" autofocus >
									<option value="1">Bueno</option>
									<option value="2">Medio</option>
									<option value="3">Malo</option>
								</select>
								<!--
								<input type='text' class='form-control' id='estadosanitario_mass' maxlength='11'   required='required' autofocus>
								-->
								<p class='errorestadosanitario text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='observaciones' >
							<label class='control-label col-sm-2' for='descripcion'>observaciones:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='observaciones_mass' maxlength='200'   required='required' autofocus>
								<p class='errorobservaciones text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='responsable' >
							<label class='control-label col-sm-2' for='descripcion'>responsable:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='responsable_mass' maxlength='45'   required='required' autofocus>
								<p class='errorresponsable text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fotogeneral' >
							<label class='control-label col-sm-2' for='descripcion'>fotogeneral:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fotogeneral_mass' maxlength='45'   required='required' autofocus>
								<input type='file' class='form-control' id='fotogeneral_mass_file' name="fotogeneral_mass_file" maxlength='45'   required='required' autofocus>
								<p class='errorfotogeneral text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fotodetalle' >
							<label class='control-label col-sm-2' for='descripcion'>fotodetalle:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fotodetalle_mass' maxlength='45'   required='required' autofocus>
								<input type='file' class='form-control' id='fotodetalle_mass_file' name='fotodetalle_mass_file' maxlength='45'   required='required' autofocus>
								<p class='errorfotodetalle text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">tipo_proceso_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="tipo_proceso_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($tipo_proceso_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=tipo_proceso_id_mass" required="required" autofocus>
								-->
								<p class="errortipo_proceso_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class='form-group' id='diametro_ecuatorial' >
							<label class='control-label col-sm-2' for='descripcion'>diametro_ecuatorial:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number-punto' id='diametro_ecuatorial_mass' maxlength='112'   required='required' autofocus>
								<p class='errordiametro_ecuatorial text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='updated_at' >
							<label class='control-label col-sm-2' for='descripcion'>updated_at:</label>
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

	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	{{-- <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script> --}}
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
	<script>
		

		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>

			
<script type='text/javascript'>
			<?php echo "const  Foraarboles_id= $arboles_id;"; ?>
			<?php echo "const  Foratipo_proceso_id= $tipo_proceso_id;"; ?>
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
$('#arboles_id_mass').val($(this).data('arboles_id'));
$('#dap_mass').val($(this).data('dap'));
$('#altura_total_mass').val($(this).data('altura_total'));
$('#diametro_mayor_copa_m_mass').val($(this).data('diametro_mayor_copa_m'));
$('#diametro_menor_copa_m_mass').val($(this).data('diametro_menor_copa_m'));
$('#fecha_mass').val($(this).data('fecha'));
$('#arbol_num_mass').val($(this).data('arbol_num'));
$('#estadofisico_mass').val($(this).data('estadofisico'));
$('#estadosanitario_mass').val($(this).data('estadosanitario'));
$('#observaciones_mass').val($(this).data('observaciones'));
$('#responsable_mass').val($(this).data('responsable'));
$('#fotogeneral_mass').val($(this).data('fotogeneral'));
$('#fotodetalle_mass').val($(this).data('fotodetalle'));
$('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
$('#diametro_ecuatorial_mass').val($(this).data('diametro_ecuatorial'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#created_at_mass').val($(this).data('created_at'));
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
$('#arboles_id_mass').val($(this).data('arboles_id'));
$('#dap_mass').val($(this).data('dap'));
$('#altura_total_mass').val($(this).data('altura_total'));
$('#diametro_mayor_copa_m_mass').val($(this).data('diametro_mayor_copa_m'));
$('#diametro_menor_copa_m_mass').val($(this).data('diametro_menor_copa_m'));
$('#fecha_mass').val($(this).data('fecha'));
$('#arbol_num_mass').val($(this).data('arbol_num'));
$('#estadofisico_mass').val($(this).data('estadofisico'));
$('#estadosanitario_mass').val($(this).data('estadosanitario'));
$('#observaciones_mass').val($(this).data('observaciones'));
$('#responsable_mass').val($(this).data('responsable'));
$('#fotogeneral_mass').val($(this).data('fotogeneral'));
$('#fotodetalle_mass').val($(this).data('fotodetalle'));
$('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
$('#diametro_ecuatorial_mass').val($(this).data('diametro_ecuatorial'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#created_at_mass').val($(this).data('created_at'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Ficha_detalles/'+id,
				data: {
					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
					toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
					$('.item' + data['id']).remove();
					$('.col1').each(function (index) {
						$(this).html(index+1);
					});
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

			var formData = new FormData($("#formmass")[0]);
			formData.append('id',$('#id_mass').val());
			formData.append('arboles_id',$('#arboles_id_mass').val());
			formData.append('altura_total',$('#altura_total_mass').val());
			formData.append('diametro_mayor_copa_m',$('#diametro_mayor_copa_m_mass').val());
			formData.append('diametro_menor_copa_m',$('#diametro_menor_copa_m_mass').val());
			formData.append('fecha',$('#fecha_mass').val());
			formData.append('arbol_num',$('#arbol_num_mass').val());
			formData.append('estadofisico',$('#estadofisico_mass').val());
			formData.append('estadosanitario',$('#estadosanitario_mass').val());

			formData.append('observaciones',$('#observaciones_mass').val());
			formData.append('responsable',$('#responsable_mass').val());

			formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
			formData.append('diametro_ecuatorial',$('#diametro_ecuatorial_mass').val());
			formData.append('updated_at',$('#updated_at_mass').val());
			formData.append('created_at',$('#created_at_mass').val());
			formData.append('_token',$('input[name=_token]').val()); 

			
				

			$.ajax({
				type: 'post',
				url: '../store',
        		data: formData,
				cache: false,
        		contentType: false,
        		processData: false,
				error: function(jqXHR, text, error){
            	toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});
        		},
				success: function(data) { 
					$('.errorid').addClass('hidden');$('.errorarboles_id').addClass('hidden');$('.errordap').addClass('hidden');$('.erroraltura_total').addClass('hidden');$('.errordiametro_mayor_copa_m').addClass('hidden');$('.errordiametro_menor_copa_m').addClass('hidden');$('.errorfecha').addClass('hidden');$('.errorarbol_num').addClass('hidden');$('.errorestadofisico').addClass('hidden');$('.errorestadosanitario').addClass('hidden');$('.errorobservaciones').addClass('hidden');$('.errorresponsable').addClass('hidden');$('.errorfotogeneral').addClass('hidden');$('.errorfotodetalle').addClass('hidden');$('.errortipo_proceso_id').addClass('hidden');$('.errordiametro_ecuatorial').addClass('hidden');$('.errorupdated_at').addClass('hidden');$('.errorcreated_at').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);
						if(data.errors.id){$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);
				}if(data.errors.arboles_id){$('.errorarboles_id').removeClass('hidden');$('.errorarboles_id').text(data.errors.arboles_id);
				}if(data.errors.dap){$('.errordap').removeClass('hidden');$('.errordap').text(data.errors.dap);
				}if(data.errors.altura_total){$('.erroraltura_total').removeClass('hidden');$('.erroraltura_total').text(data.errors.altura_total);
				}if(data.errors.diametro_mayor_copa_m){$('.errordiametro_mayor_copa_m').removeClass('hidden');$('.errordiametro_mayor_copa_m').text(data.errors.diametro_mayor_copa_m);
				}if(data.errors.diametro_menor_copa_m){$('.errordiametro_menor_copa_m').removeClass('hidden');$('.errordiametro_menor_copa_m').text(data.errors.diametro_menor_copa_m);
				}if(data.errors.fecha){$('.errorfecha').removeClass('hidden');$('.errorfecha').text(data.errors.fecha);
				}if(data.errors.arbol_num){$('.errorarbol_num').removeClass('hidden');$('.errorarbol_num').text(data.errors.arbol_num);
				}if(data.errors.estadofisico){$('.errorestadofisico').removeClass('hidden');$('.errorestadofisico').text(data.errors.estadofisico);
				}if(data.errors.estadosanitario){$('.errorestadosanitario').removeClass('hidden');$('.errorestadosanitario').text(data.errors.estadosanitario);
				}if(data.errors.observaciones){$('.errorobservaciones').removeClass('hidden');$('.errorobservaciones').text(data.errors.observaciones);
				}if(data.errors.responsable){$('.errorresponsable').removeClass('hidden');$('.errorresponsable').text(data.errors.responsable);
				}if(data.errors.fotogeneral){$('.errorfotogeneral').removeClass('hidden');$('.errorfotogeneral').text(data.errors.fotogeneral);
				}if(data.errors.fotodetalle){$('.errorfotodetalle').removeClass('hidden');$('.errorfotodetalle').text(data.errors.fotodetalle);
				}if(data.errors.tipo_proceso_id){$('.errortipo_proceso_id').removeClass('hidden');$('.errortipo_proceso_id').text(data.errors.tipo_proceso_id);
				}if(data.errors.diametro_ecuatorial){$('.errordiametro_ecuatorial').removeClass('hidden');$('.errordiametro_ecuatorial').text(data.errors.diametro_ecuatorial);
				}if(data.errors.updated_at){$('.errorupdated_at').removeClass('hidden');$('.errorupdated_at').text(data.errors.updated_at);
				}if(data.errors.created_at){$('.errorcreated_at').removeClass('hidden');$('.errorcreated_at').text(data.errors.created_at);
				};
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
const resularboles_id=Foraarboles_id.find( cas => cas.id == data.arboles_id ); 
				const resultipo_proceso_id=Foratipo_proceso_id.find( cas => cas.id == data.tipo_proceso_id ); 
							$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			//"<td class='col1'>" + data.id + "</td>"+
			"<td>"+ resularboles_id["nombre"]  +"</td>"+
			"<td>"+ data.dap+"</td>"+
			"<td>"+ data.altura_total+"</td>"+
			"<td>"+ data.diametro_mayor_copa_m+"</td>"+
			"<td>"+ data.diametro_menor_copa_m+"</td>"+
			"<td>"+ data.fecha+"</td>"+
			"<td>"+ data.arbol_num+"</td>"+
			"<td>"+ data.estadofisico+"</td>"+
			"<td>"+ data.estadosanitario+"</td>"+
			"<td>"+ data.observaciones+"</td>"+
			"<td>"+ data.responsable+"</td>"+
			"<td>"+ data.fotogeneral+"</td>"+
			"<td>"+ data.fotodetalle+"</td>"+
			"<td>"+ resultipo_proceso_id["nombre"]  +"</td>"+
			"<td>"+ data.diametro_ecuatorial+"</td>"+
			"<td>"+ data.updated_at+"</td>"+
			"<td>"+ data.created_at+"</td>"+
			
						'  <td>Ahorra</td><td> '+
				@can('Ficha_detalles Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Ficha_detalles Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Ficha_detalles Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
						"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button>' "+
				@endcan
						" '</td></tr> ");

							



							
					
					}
				},
			});
		});

		// Edit a post
		$(document).on('click', '.edit-modal', function() {
			$("#id_mass").val($(this).data("id"));
			$("#arboles_id_mass").val($(this).data("arboles_id"));
			$("#dap_mass").val($(this).data("dap"));
			$("#altura_total_mass").val($(this).data("altura_total"));
			$("#diametro_mayor_copa_m_mass").val($(this).data("diametro_mayor_copa_m"));
			$("#diametro_menor_copa_m_mass").val($(this).data("diametro_menor_copa_m"));
			$("#fecha_mass").val($(this).data("fecha"));
			$("#arbol_num_mass").val($(this).data("arbol_num"));
			$("#estadofisico_mass").val($(this).data("estadofisico"));
			$("#estadosanitario_mass").val($(this).data("estadosanitario"));
			$("#observaciones_mass").val($(this).data("observaciones"));
			$("#responsable_mass").val($(this).data("responsable"));
			$("#fotogeneral_mass").val($(this).data("fotogeneral"));
			$("#fotodetalle_mass").val($(this).data("fotodetalle"));
			$("#tipo_proceso_id_mass").val($(this).data("tipo_proceso_id"));
			$("#diametro_ecuatorial_mass").val($(this).data("diametro_ecuatorial"));
			$("#updated_at_mass").val($(this).data("updated_at"));
			$("#created_at_mass").val($(this).data("created_at"));
			

			id = $('#id_mass').val();
			$('#acciones').attr('class', 'btn btn-warning edit');
			$('#acciones').text('Editar');
			$('.modal-descripcion').text('Editar un Dato');
			$('#massModal').modal('show');
			$('#msdelete').text(' ');
		});

			


			$('.modal-footer').on('click', '.edit', function() {

			var formData = new FormData($("#formmass")[0]);
			formData.append('id',$('#id_mass').val());
			formData.append('arboles_id',$('#arboles_id_mass').val());
			formData.append('altura_total',$('#altura_total_mass').val());
			formData.append('diametro_mayor_copa_m',$('#diametro_mayor_copa_m_mass').val());
			formData.append('diametro_menor_copa_m',$('#diametro_menor_copa_m_mass').val());
			formData.append('fecha',$('#fecha_mass').val());
			formData.append('arbol_num',$('#arbol_num_mass').val());
			formData.append('estadofisico',$('#estadofisico_mass').val());
			formData.append('estadosanitario',$('#estadosanitario_mass').val());

			formData.append('observaciones',$('#observaciones_mass').val());
			formData.append('responsable',$('#responsable_mass').val());

			formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
			formData.append('diametro_ecuatorial',$('#diametro_ecuatorial_mass').val());
			formData.append('updated_at',$('#updated_at_mass').val());
			formData.append('created_at',$('#created_at_mass').val());
			formData.append('_token',$('input[name=_token]').val());
				

			$.ajax({
				type: 'Post',
				url: '../update/'+id,
	    		data: formData,
				cache: false,
	    		contentType: false,
	    		processData: false,

			error: function(jqXHR, text, error){
            toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errorarboles_id').addClass('hidden');
			$('.errordap').addClass('hidden');
			$('.erroraltura_total').addClass('hidden');
			$('.errordiametro_mayor_copa_m').addClass('hidden');
			$('.errordiametro_menor_copa_m').addClass('hidden');
			$('.errorfecha').addClass('hidden');
			$('.errorarbol_num').addClass('hidden');
			$('.errorestadofisico').addClass('hidden');
			$('.errorestadosanitario').addClass('hidden');
			$('.errorobservaciones').addClass('hidden');
			$('.errorresponsable').addClass('hidden');
			$('.errorfotogeneral').addClass('hidden');
			$('.errorfotodetalle').addClass('hidden');
			$('.errortipo_proceso_id').addClass('hidden');
			$('.errordiametro_ecuatorial').addClass('hidden');
			$('.errorupdated_at').addClass('hidden');
			$('.errorcreated_at').addClass('hidden');
				 
			if ((data.errors)) {
				setTimeout(function () {
					$('#editModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			
				if (data.errors.id) {
                	$(".error.id").removeClass("hidden");
                	$(".error.id").text(data.errorsid);
                }
				if (data.errors.arboles_id) {
                	$(".error.arboles_id").removeClass("hidden");
                	$(".error.arboles_id").text(data.errorsarboles_id);
                }
				if (data.errors.dap) {
                	$(".error.dap").removeClass("hidden");
                	$(".error.dap").text(data.errorsdap);
                }
				if (data.errors.altura_total) {
                	$(".error.altura_total").removeClass("hidden");
                	$(".error.altura_total").text(data.errorsaltura_total);
                }
				if (data.errors.diametro_mayor_copa_m) {
                	$(".error.diametro_mayor_copa_m").removeClass("hidden");
                	$(".error.diametro_mayor_copa_m").text(data.errorsdiametro_mayor_copa_m);
                }
				if (data.errors.diametro_menor_copa_m) {
                	$(".error.diametro_menor_copa_m").removeClass("hidden");
                	$(".error.diametro_menor_copa_m").text(data.errorsdiametro_menor_copa_m);
                }
				if (data.errors.fecha) {
                	$(".error.fecha").removeClass("hidden");
                	$(".error.fecha").text(data.errorsfecha);
                }
				if (data.errors.arbol_num) {
                	$(".error.arbol_num").removeClass("hidden");
                	$(".error.arbol_num").text(data.errorsarbol_num);
                }
				if (data.errors.estadofisico) {
                	$(".error.estadofisico").removeClass("hidden");
                	$(".error.estadofisico").text(data.errorsestadofisico);
                }
				if (data.errors.estadosanitario) {
                	$(".error.estadosanitario").removeClass("hidden");
                	$(".error.estadosanitario").text(data.errorsestadosanitario);
                }
				if (data.errors.observaciones) {
                	$(".error.observaciones").removeClass("hidden");
                	$(".error.observaciones").text(data.errorsobservaciones);
                }
				if (data.errors.responsable) {
                	$(".error.responsable").removeClass("hidden");
                	$(".error.responsable").text(data.errorsresponsable);
                }
				if (data.errors.fotogeneral) {
                	$(".error.fotogeneral").removeClass("hidden");
                	$(".error.fotogeneral").text(data.errorsfotogeneral);
                }
				if (data.errors.fotodetalle) {
                	$(".error.fotodetalle").removeClass("hidden");
                	$(".error.fotodetalle").text(data.errorsfotodetalle);
                }
				if (data.errors.tipo_proceso_id) {
                	$(".error.tipo_proceso_id").removeClass("hidden");
                	$(".error.tipo_proceso_id").text(data.errorstipo_proceso_id);
                }
				if (data.errors.diametro_ecuatorial) {
                	$(".error.diametro_ecuatorial").removeClass("hidden");
                	$(".error.diametro_ecuatorial").text(data.errorsdiametro_ecuatorial);
                }
				if (data.errors.updated_at) {
                	$(".error.updated_at").removeClass("hidden");
                	$(".error.updated_at").text(data.errorsupdated_at);
                }
				if (data.errors.created_at) {
                	$(".error.created_at").removeClass("hidden");
                	$(".error.created_at").text(data.errorscreated_at);
                }
 				} else {
                	toastr.success('Successfully updated Ficha_detalles!', 'Success Alert', {timeOut: 5000});
                //update

			const resularboles_id=Foraarboles_id.find( cas => cas.id == data.arboles_id ); 
				const resultipo_proceso_id=Foratipo_proceso_id.find( cas => cas.id == data.tipo_proceso_id ); 
				

				$('.item' + data.id).replaceWith(
"<tr class='item"+data.id+"'>"+
//"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ resularboles_id["nombre"]  +"</td>"+
				"<td>"+ data.dap+"</td>"+
				"<td>"+ data.altura_total+"</td>"+
				"<td>"+ data.diametro_mayor_copa_m+"</td>"+
				"<td>"+ data.diametro_menor_copa_m+"</td>"+
				"<td>"+ data.fecha+"</td>"+
				"<td>"+ data.arbol_num+"</td>"+
				"<td>"+ data.estadofisico+"</td>"+
				"<td>"+ data.estadosanitario+"</td>"+
				"<td>"+ data.observaciones+"</td>"+
				"<td>"+ data.responsable+"</td>"+
				"<td>"+ data.fotogeneral+"</td>"+
				"<td>"+ data.fotodetalle+"</td>"+
				"<td>"+ resultipo_proceso_id["nombre"]  +"</td>"+
				"<td>"+ data.diametro_ecuatorial+"</td>"+
				"<td>"+ data.updated_at+"</td>"+
				"<td>"+ data.created_at+"</td>"+
				
			'  <td>Ahorra</td><td> '+			
			
			@can('Ficha_detalles Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Ficha_detalles Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Ficha_detalles Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-arboles_id='"+ data.arboles_id+
						"' data-dap='"+ data.dap+
						"' data-altura_total='"+ data.altura_total+
						"' data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+
						"' data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+
						"' data-fecha='"+ data.fecha+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-estadofisico='"+ data.estadofisico+
						"' data-estadosanitario='"+ data.estadosanitario+
						"' data-observaciones='"+ data.observaciones+
						"' data-responsable='"+ data.responsable+
						"' data-fotogeneral='"+ data.fotogeneral+
						"' data-fotodetalle='"+ data.fotodetalle+
						"' data-tipo_proceso_id='"+ data.tipo_proceso_id+
						"' data-diametro_ecuatorial='"+ data.diametro_ecuatorial+
						"' data-updated_at='"+ data.updated_at+
						"' data-created_at='"+ data.created_at+
						 
				"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button> ' "+
			@endcan
			" </td></tr> ");
					
				





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



</body>
</html>










