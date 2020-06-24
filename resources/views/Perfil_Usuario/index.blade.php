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
			  <h3 class="box-descripcion">Lista de Perfil_Usuario</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
					<a href="#" class="add-modal"><li>Add a Post</li></a>
					@can('Perfil_Usuario Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Perfil_Usuario</li></a>

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
								<th>id</th>
		<th>nombre</th>
		<th>apellido</th>
		<th>telefono_1</th>
		<th>telefono_2</th>
		<th>direccion</th>
		<th>cedula</th>
		<th>municipios_id</th>
		<th>entidad_municipal_id</th>
		<th>foto</th>
		<th>created_at</th>
		<th>updated_at</th>
		<th>users_id</th>
		<th>Ultima Modificacion</th><th>Accion</th>
								<!--
								<th valign="middle">#</th>
								<th>Descripcion</th>
								<th>Tipo de solicitud?</th>
								<th>Estado de Solicitud?</th>
								<th>Nombre Ususario</th>
								<th>Ultima modificacion</th>
								<th>Accion</th>
								<th>Accion</th>
								-->
							</tr>
							{{ csrf_field() }}
						</thead>
						<tbody>


							@foreach($listmysql as $lists)
						  
								<tr class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
		<td class="col1">{{ $lists->nombre }}</td>
		<td class="col1">{{ $lists->apellido }}</td>
		<td class="col1">{{ $lists->telefono_1 }}</td>
		<td class="col1">{{ $lists->telefono_2 }}</td>
		<td class="col1">{{ $lists->direccion }}</td>
		<td class="col1">{{ $lists->cedula }}</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Foramunicipios_id.find( cas => cas.id == {{ $lists->municipios_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Foraentidad_municipal_id.find( cas => cas.id == {{ $lists->entidad_municipal_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		<td class="col1">{{ $lists->foto }}</td>
		<td class="col1">{{ $lists->created_at }}</td>
		<td class="col1">{{ $lists->updated_at }}</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Forausers_id.find( cas => cas.id == {{ $lists->users_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										@can('Perfil_Usuario Show')
												<button class="massshow-modal btn btn-success" 
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
		data-apellido="{{ $lists->apellido}}"
		data-telefono_1="{{ $lists->telefono_1}}"
		data-telefono_2="{{ $lists->telefono_2}}"
		data-direccion="{{ $lists->direccion}}"
		data-cedula="{{ $lists->cedula}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-entidad_municipal_id="{{ $lists->entidad_municipal_id}}"
		data-foto="{{ $lists->foto}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-users_id="{{ $lists->users_id}}"
		
												
												>
												<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan		
										@can('Perfil_Usuario Editar')
												<button class="edit-modal btn btn-info" 
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
		data-apellido="{{ $lists->apellido}}"
		data-telefono_1="{{ $lists->telefono_1}}"
		data-telefono_2="{{ $lists->telefono_2}}"
		data-direccion="{{ $lists->direccion}}"
		data-cedula="{{ $lists->cedula}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-entidad_municipal_id="{{ $lists->entidad_municipal_id}}"
		data-foto="{{ $lists->foto}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-users_id="{{ $lists->users_id}}"
		
												
												><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Perfil_Usuario Eliminar') 
												
												<button class="massdelete-modal btn btn-danger"
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
		data-apellido="{{ $lists->apellido}}"
		data-telefono_1="{{ $lists->telefono_1}}"
		data-telefono_2="{{ $lists->telefono_2}}"
		data-direccion="{{ $lists->direccion}}"
		data-cedula="{{ $lists->cedula}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-entidad_municipal_id="{{ $lists->entidad_municipal_id}}"
		data-foto="{{ $lists->foto}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-users_id="{{ $lists->users_id}}"
		
												
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
					<!--
					<form class="form-horizontal" id="formmass" role="form" >
					-->
					{!! Form::open(array('url' => 'uploads/save', 'method' => 'post', 'files' => true)) !!}

						
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
								<input type='text' class='form-control' id='id_mass' required='required' autofocus>
							<!--
								<p class='errorid text-center alert alert-danger hidden'></p>
							</div>
						</div>
						-->
							
						<div class='form-group' id='nombre' >
							<label class='control-label col-sm-2' for='descripcion'>nombre:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='nombre_mass' maxlength='60'   required='required' autofocus>
								<p class='errornombre text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='apellido' >
							<label class='control-label col-sm-2' for='descripcion'>apellido:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='apellido_mass' maxlength='60'   required='required' autofocus>
								<p class='errorapellido text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='telefono_1' >
							<label class='control-label col-sm-2' for='descripcion'>telefono_1:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='telefono_1_mass' maxlength='15'   required='required' autofocus>
								<p class='errortelefono_1 text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='telefono_2' >
							<label class='control-label col-sm-2' for='descripcion'>telefono_2:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='telefono_2_mass' maxlength='15'   required='required' autofocus>
								<p class='errortelefono_2 text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='direccion' >
							<label class='control-label col-sm-2' for='descripcion'>direccion:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='direccion_mass' maxlength='45'   required='required' autofocus>
								<p class='errordireccion text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='cedula' >
							<label class='control-label col-sm-2' for='descripcion'>cedula:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='cedula_mass' maxlength='20'   required='required' autofocus>
								<p class='errorcedula text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">municipios_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="municipios_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($municipios_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=municipios_id_mass" required="required" autofocus>
								-->
								<p class="errormunicipios_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">entidad_municipal_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="entidad_municipal_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($entidad_municipal_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=entidad_municipal_id_mass" required="required" autofocus>
								-->
								<p class="errorentidad_municipal_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class='form-group' id='foto' >
							<label class='control-label col-sm-2' for='descripcion'>foto:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='foto_mass' maxlength='45'   required='required' autofocus>
								<p class='errorfoto text-center alert alert-danger hidden'></p>
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
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">users_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="users_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($users_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=users_id_mass" required="required" autofocus>
								-->
								<p class="errorusers_id text-center alert alert-danger hidden"> llenar los datos</p>
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
		$(document).ready(function(){
	    	$("#postTable").DataTable();
		});

		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>

			
<script type='text/javascript'>
			<?php echo "const  Foramunicipios_id= $municipios_id;"; ?>
			<?php echo "const  Foraentidad_municipal_id= $entidad_municipal_id;"; ?>
			<?php echo "const  Forausers_id= $users_id;"; ?>
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
$('#nombre_mass').val($(this).data('nombre'));
$('#apellido_mass').val($(this).data('apellido'));
$('#telefono_1_mass').val($(this).data('telefono_1'));
$('#telefono_2_mass').val($(this).data('telefono_2'));
$('#direccion_mass').val($(this).data('direccion'));
$('#cedula_mass').val($(this).data('cedula'));
$('#municipios_id_mass').val($(this).data('municipios_id'));
$('#entidad_municipal_id_mass').val($(this).data('entidad_municipal_id'));
$('#foto_mass').val($(this).data('foto'));
$('#created_at_mass').val($(this).data('created_at'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#users_id_mass').val($(this).data('users_id'));
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
$('#nombre_mass').val($(this).data('nombre'));
$('#apellido_mass').val($(this).data('apellido'));
$('#telefono_1_mass').val($(this).data('telefono_1'));
$('#telefono_2_mass').val($(this).data('telefono_2'));
$('#direccion_mass').val($(this).data('direccion'));
$('#cedula_mass').val($(this).data('cedula'));
$('#municipios_id_mass').val($(this).data('municipios_id'));
$('#entidad_municipal_id_mass').val($(this).data('entidad_municipal_id'));
$('#foto_mass').val($(this).data('foto'));
$('#created_at_mass').val($(this).data('created_at'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#users_id_mass').val($(this).data('users_id'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Perfil_Usuario/'+id,
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
			$.ajax({
				type: 'POST',
				url: 'Perfil_Usuario',
				data: {

				'id': $('#id_mass').val(),'nombre': $('#nombre_mass').val(),'apellido': $('#apellido_mass').val(),'telefono_1': $('#telefono_1_mass').val(),'telefono_2': $('#telefono_2_mass').val(),'direccion': $('#direccion_mass').val(),'cedula': $('#cedula_mass').val(),'municipios_id': $('#municipios_id_mass').val(),'entidad_municipal_id': $('#entidad_municipal_id_mass').val(),'foto': $('#foto_mass').val(),'created_at': $('#created_at_mass').val(),'updated_at': $('#updated_at_mass').val(),'users_id': $('#users_id_mass').val(),

					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
				   
					$('.errorid').addClass('hidden');$('.errornombre').addClass('hidden');$('.errorapellido').addClass('hidden');$('.errortelefono_1').addClass('hidden');$('.errortelefono_2').addClass('hidden');$('.errordireccion').addClass('hidden');$('.errorcedula').addClass('hidden');$('.errormunicipios_id').addClass('hidden');$('.errorentidad_municipal_id').addClass('hidden');$('.errorfoto').addClass('hidden');$('.errorcreated_at').addClass('hidden');$('.errorupdated_at').addClass('hidden');$('.errorusers_id').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);

						if(data.errors.id){$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);
				}if(data.errors.nombre){$('.errornombre').removeClass('hidden');$('.errornombre').text(data.errors.nombre);
				}if(data.errors.apellido){$('.errorapellido').removeClass('hidden');$('.errorapellido').text(data.errors.apellido);
				}if(data.errors.telefono_1){$('.errortelefono_1').removeClass('hidden');$('.errortelefono_1').text(data.errors.telefono_1);
				}if(data.errors.telefono_2){$('.errortelefono_2').removeClass('hidden');$('.errortelefono_2').text(data.errors.telefono_2);
				}if(data.errors.direccion){$('.errordireccion').removeClass('hidden');$('.errordireccion').text(data.errors.direccion);
				}if(data.errors.cedula){$('.errorcedula').removeClass('hidden');$('.errorcedula').text(data.errors.cedula);
				}if(data.errors.municipios_id){$('.errormunicipios_id').removeClass('hidden');$('.errormunicipios_id').text(data.errors.municipios_id);
				}if(data.errors.entidad_municipal_id){$('.errorentidad_municipal_id').removeClass('hidden');$('.errorentidad_municipal_id').text(data.errors.entidad_municipal_id);
				}if(data.errors.foto){$('.errorfoto').removeClass('hidden');$('.errorfoto').text(data.errors.foto);
				}if(data.errors.created_at){$('.errorcreated_at').removeClass('hidden');$('.errorcreated_at').text(data.errors.created_at);
				}if(data.errors.updated_at){$('.errorupdated_at').removeClass('hidden');$('.errorupdated_at').text(data.errors.updated_at);
				}if(data.errors.users_id){$('.errorusers_id').removeClass('hidden');$('.errorusers_id').text(data.errors.users_id);
				};
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
const resulmunicipios_id=Foramunicipios_id.find( cas => cas.id == data.municipios_id ); 
				const resulentidad_municipal_id=Foraentidad_municipal_id.find( cas => cas.id == data.entidad_municipal_id ); 
				const resulusers_id=Forausers_id.find( cas => cas.id == data.users_id ); 
							$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			"<td class='col1'>" + data.id + "</td>"+
			"<td>"+ data.nombre+"</td>"+
			"<td>"+ data.apellido+"</td>"+
			"<td>"+ data.telefono_1+"</td>"+
			"<td>"+ data.telefono_2+"</td>"+
			"<td>"+ data.direccion+"</td>"+
			"<td>"+ data.cedula+"</td>"+
			"<td>"+ resulmunicipios_id["nombre"]  +"</td>"+
			"<td>"+ resulentidad_municipal_id["nombre"]  +"</td>"+
			"<td>"+ data.foto+"</td>"+
			"<td>"+ data.created_at+"</td>"+
			"<td>"+ data.updated_at+"</td>"+
			"<td>"+ resulusers_id["nombre"]  +"</td>"+
			
						'  <td>Ahorra</td><td> '+
				@can('Perfil_Usuario Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Perfil_Usuario Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Perfil_Usuario Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
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
			$("#nombre_mass").val($(this).data("nombre"));
			$("#apellido_mass").val($(this).data("apellido"));
			$("#telefono_1_mass").val($(this).data("telefono_1"));
			$("#telefono_2_mass").val($(this).data("telefono_2"));
			$("#direccion_mass").val($(this).data("direccion"));
			$("#cedula_mass").val($(this).data("cedula"));
			$("#municipios_id_mass").val($(this).data("municipios_id"));
			$("#entidad_municipal_id_mass").val($(this).data("entidad_municipal_id"));
			$("#foto_mass").val($(this).data("foto"));
			$("#created_at_mass").val($(this).data("created_at"));
			$("#updated_at_mass").val($(this).data("updated_at"));
			$("#users_id_mass").val($(this).data("users_id"));
			

			id = $('#id_mass').val();
			$('#acciones').attr('class', 'btn btn-warning edit');
			$('#acciones').text('Editar');
			$('.modal-descripcion').text('Editar un Dato');
			$('#massModal').modal('show');
			$('#msdelete').text(' ');
		});

			
			


			$('.modal-footer').on('click', '.edit', function() {
				$.ajax({
					type: 'PUT',
					url: 'Perfil_Usuario/' + id,
					data: {
			'id': $('#id_mass').val(),
			'nombre': $('#nombre_mass').val(),
			'apellido': $('#apellido_mass').val(),
			'telefono_1': $('#telefono_1_mass').val(),
			'telefono_2': $('#telefono_2_mass').val(),
			'direccion': $('#direccion_mass').val(),
			'cedula': $('#cedula_mass').val(),
			'municipios_id': $('#municipios_id_mass').val(),
			'entidad_municipal_id': $('#entidad_municipal_id_mass').val(),
			'foto': $('#foto_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
			'users_id': $('#users_id_mass').val(),
			'_token': $('input[name=_token]').val()
				}, 
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errornombre').addClass('hidden');
			$('.errorapellido').addClass('hidden');
			$('.errortelefono_1').addClass('hidden');
			$('.errortelefono_2').addClass('hidden');
			$('.errordireccion').addClass('hidden');
			$('.errorcedula').addClass('hidden');
			$('.errormunicipios_id').addClass('hidden');
			$('.errorentidad_municipal_id').addClass('hidden');
			$('.errorfoto').addClass('hidden');
			$('.errorcreated_at').addClass('hidden');
			$('.errorupdated_at').addClass('hidden');
			$('.errorusers_id').addClass('hidden');
				 
			if ((data.errors)) {
				setTimeout(function () {
					$('#editModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			
				if (data.errors.id) {
                	$(".error.id").removeClass("hidden");
                	$(".error.id").text(data.errorsid);
                }
				if (data.errors.nombre) {
                	$(".error.nombre").removeClass("hidden");
                	$(".error.nombre").text(data.errorsnombre);
                }
				if (data.errors.apellido) {
                	$(".error.apellido").removeClass("hidden");
                	$(".error.apellido").text(data.errorsapellido);
                }
				if (data.errors.telefono_1) {
                	$(".error.telefono_1").removeClass("hidden");
                	$(".error.telefono_1").text(data.errorstelefono_1);
                }
				if (data.errors.telefono_2) {
                	$(".error.telefono_2").removeClass("hidden");
                	$(".error.telefono_2").text(data.errorstelefono_2);
                }
				if (data.errors.direccion) {
                	$(".error.direccion").removeClass("hidden");
                	$(".error.direccion").text(data.errorsdireccion);
                }
				if (data.errors.cedula) {
                	$(".error.cedula").removeClass("hidden");
                	$(".error.cedula").text(data.errorscedula);
                }
				if (data.errors.municipios_id) {
                	$(".error.municipios_id").removeClass("hidden");
                	$(".error.municipios_id").text(data.errorsmunicipios_id);
                }
				if (data.errors.entidad_municipal_id) {
                	$(".error.entidad_municipal_id").removeClass("hidden");
                	$(".error.entidad_municipal_id").text(data.errorsentidad_municipal_id);
                }
				if (data.errors.foto) {
                	$(".error.foto").removeClass("hidden");
                	$(".error.foto").text(data.errorsfoto);
                }
				if (data.errors.created_at) {
                	$(".error.created_at").removeClass("hidden");
                	$(".error.created_at").text(data.errorscreated_at);
                }
				if (data.errors.updated_at) {
                	$(".error.updated_at").removeClass("hidden");
                	$(".error.updated_at").text(data.errorsupdated_at);
                }
				if (data.errors.users_id) {
                	$(".error.users_id").removeClass("hidden");
                	$(".error.users_id").text(data.errorsusers_id);
                }
 				} else {
                	toastr.success('Successfully updated Perfil_Usuario!', 'Success Alert', {timeOut: 5000});
                //update

			const resulmunicipios_id=Foramunicipios_id.find( cas => cas.id == data.municipios_id ); 
				const resulentidad_municipal_id=Foraentidad_municipal_id.find( cas => cas.id == data.entidad_municipal_id ); 
				const resulusers_id=Forausers_id.find( cas => cas.id == data.users_id ); 
				

				$('.item' + data.id).replaceWith(
"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ data.nombre+"</td>"+
				"<td>"+ data.apellido+"</td>"+
				"<td>"+ data.telefono_1+"</td>"+
				"<td>"+ data.telefono_2+"</td>"+
				"<td>"+ data.direccion+"</td>"+
				"<td>"+ data.cedula+"</td>"+
				"<td>"+ resulmunicipios_id["nombre"]  +"</td>"+
				"<td>"+ resulentidad_municipal_id["nombre"]  +"</td>"+
				"<td>"+ data.foto+"</td>"+
				"<td>"+ data.created_at+"</td>"+
				"<td>"+ data.updated_at+"</td>"+
				"<td>"+ resulusers_id["nombre"]  +"</td>"+
				
			'  <td>Ahorra</td><td> '+			
			
			@can('Perfil_Usuario Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Perfil_Usuario Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Perfil_Usuario Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-apellido='"+ data.apellido+
						"' data-telefono_1='"+ data.telefono_1+
						"' data-telefono_2='"+ data.telefono_2+
						"' data-direccion='"+ data.direccion+
						"' data-cedula='"+ data.cedula+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-entidad_municipal_id='"+ data.entidad_municipal_id+
						"' data-foto='"+ data.foto+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						"' data-users_id='"+ data.users_id+
						 
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










