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
			  <h3 class="box-descripcion">Lista de $nombrecoNtrol</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
					<a href="#" class="add-modal"><li>Add a Post</li></a>
					<a href="#" class="massmodal"><li>mostrar a Post</li></a>
				</ul>
			</div>
		
			<div class="panel-body">
					<table class="table table-striped table-bordered table-hover compact nowrap" id="postTable">
						<thead>
					   

							<tr>
								<th>id</th>
		<th>descripcion</th>
		<th>id_tipo</th>
		<th>id_estado</th>
		<th>created_at</th>
		<th>updated_at</th>
		<th>usuarios_id</th>
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
		<td class="col1">{{ $lists->descripcion }}</td>
		<td class="col1">{{ $lists->id_tipo }}</td>
		<td class="col1">{{ $lists->id_estado }}</td>
		<td class="col1">{{ $lists->created_at }}</td>
		<td class="col1">{{ $lists->updated_at }}</td>
		<td class="col1">{{ $lists->usuarios_id }}</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										
										<button class="massshow-modal btn btn-success" 
										data-id="{{ $lists->id}}"
		data-descripcion="{{ $lists->descripcion}}"
		data-id_tipo="{{ $lists->id_tipo}}"
		data-id_estado="{{ $lists->id_estado}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-usuarios_id="{{ $lists->usuarios_id}}"
		
										
										>
										<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										
										@can('edit articles') 
										<button class="edit-modal btn btn-info" 
										data-id="{{ $lists->id}}"
		data-descripcion="{{ $lists->descripcion}}"
		data-id_tipo="{{ $lists->id_tipo}}"
		data-id_estado="{{ $lists->id_estado}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-usuarios_id="{{ $lists->usuarios_id}}"
		
										
										><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan

										@can('Solicitude_eliminar')
										<button class="massdelete-modal btn btn-danger"
										data-id="{{ $lists->id}}"
		data-descripcion="{{ $lists->descripcion}}"
		data-id_tipo="{{ $lists->id_tipo}}"
		data-id_estado="{{ $lists->id_estado}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		data-usuarios_id="{{ $lists->usuarios_id}}"
		
										
										><span class="glyphicon glyphicon-trash"></span>Eliminar</button>
										@else
											no puede eliminar
										@endcan

										@hasrole('writer')
	I m a writer!
@else
	I m not a writer...
@endhasrole


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
					<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los datos?</h3>
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
							
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>descripcion:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='descripcion_mass' required='required' autofocus>
								<p class='errordescripcion text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">id_tipo:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="id_tipo_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($id_tipo as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=id_tipo_mass" required="required" autofocus>
								-->
								<p class="errorid_tipo text-center alert alert-danger hidden"></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">id_estado:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="id_estado_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($id_estado as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=id_estado_mass" required="required" autofocus>
								-->
								<p class="errorid_estado text-center alert alert-danger hidden"></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>created_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass' required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>updated_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='updated_at_mass' required='required' autofocus>
								<p class='errorupdated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">usuarios_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="usuarios_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($usuarios_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=usuarios_id_mass" required="required" autofocus>
								-->
								<p class="errorusuarios_id text-center alert alert-danger hidden"></p>
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
@section('page-js-files')	
@stop	
@section('page-js-script')
	<script>
		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>


	<script type='text/javascript'>
		 $(document).on('click','.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo Dato');
			$('#massModal').modal('show');
		});
		  // Show a post
		$(document).on('click', '.massshow-modal', function() {
			$('.modal-descripcion').text('massShow');
			$('#msdelete').text(' ');

			$('#id_mass').val($(this).data('id'));
$('#descripcion_mass').val($(this).data('descripcion'));
$('#id_tipo_mass').val($(this).data('id_tipo'));
$('#id_estado_mass').val($(this).data('id_estado'));
$('#created_at_mass').val($(this).data('created_at'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#usuarios_id_mass').val($(this).data('usuarios_id'));
;
									
			
			$('#massModal').modal('show');
			$('#acciones').attr('class', 'btn btn-info hibe');
			$('#acciones').text('Visible');
			$('#acciones').attr('disabled');

		});
		// delete a post
		$(document).on('click', '.massdelete-modal', function() {
			$('.modal-descripcion').text('Delete');
			$('#msdelete').text('¿Seguro que quieres borrar los datos?');

			

			$('#id_mass').val($(this).data('id'));
$('#descripcion_mass').val($(this).data('descripcion'));
$('#id_tipo_mass').val($(this).data('id_tipo'));
$('#id_estado_mass').val($(this).data('id_estado'));
$('#created_at_mass').val($(this).data('created_at'));
$('#updated_at_mass').val($(this).data('updated_at'));
$('#usuarios_id_mass').val($(this).data('usuarios_id'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Solicitude/'+id,
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
			$('.modal-descripcion').text('Añadir');
			$('#msdelete').text(' ');

			$('#massmodal').modal('show');
			$('#acciones').attr('class', 'btn btn-success add');
			//$('#formmass').attr('id', 'form_add');
			$('#acciones').text('Añadir Nuevos ');
		});
		$('.modal-footer').on('click', '.add', function() {
			$.ajax({
				type: 'POST',
				url: 'Solicitude',
				data: {

				'id': $('#id_mass').val(),'descripcion': $('#descripcion_mass').val(),'id_tipo': $('#id_tipo_mass').val(),'id_estado': $('#id_estado_mass').val(),'created_at': $('#created_at_mass').val(),'updated_at': $('#updated_at_mass').val(),'usuarios_id': $('#usuarios_id_mass').val(),

					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
				   
					$('.errorid').addClass('hidden');$('.errordescripcion').addClass('hidden');$('.errorid_tipo').addClass('hidden');$('.errorid_estado').addClass('hidden');$('.errorcreated_at').addClass('hidden');$('.errorupdated_at').addClass('hidden');$('.errorusuarios_id').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);

						$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);$('.errordescripcion').removeClass('hidden');$('.errordescripcion').text(data.errors.descripcion);$('.errorid_tipo').removeClass('hidden');$('.errorid_tipo').text(data.errors.id_tipo);$('.errorid_estado').removeClass('hidden');$('.errorid_estado').text(data.errors.id_estado);$('.errorcreated_at').removeClass('hidden');$('.errorcreated_at').text(data.errors.created_at);$('.errorupdated_at').removeClass('hidden');$('.errorupdated_at').text(data.errors.updated_at);$('.errorusuarios_id').removeClass('hidden');$('.errorusuarios_id').text(data.errors.usuarios_id);;
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						
						var a = solicitudetipo.indexOf(data.id_tipo);
						a++;
						var e = solicitudestado.indexOf(data.id_estado);
						e++;
						$('#postTable').append(
//add


	"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+"<td>"+ data.descripcion+"</td>"+
					"<td>"+ data.id_tipo+"</td>"+
					"<td>"+ data.id_estado+"</td>"+
					"<td>"+ data.created_at+"</td>"+
					"<td>"+ data.updated_at+"</td>"+
					"<td>"+ data.usuarios_id+"</td>"+
					"<td>Ahorra</td><td><button class='massshow-modal btn btn-success'"+
		
							"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							 
							" ' ><span class='glyphicon glyphicon-eye-open'></span> Ver</button> ' "+ 
							" ' <button class='edit-modal btn btn-info' "+
							"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							 
							" ' ><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='massdelete-modal btn btn-danger' ' " +
							"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							 
	" ' ><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
					
					}
				},
			});
		});

		// Edit a post
		$(document).on('click', '.edit-modal', function() {
			$("#id_mass").val($(this).data("id"));
			$("#descripcion_mass").val($(this).data("descripcion"));
			$("#id_tipo_mass").val($(this).data("id_tipo"));
			$("#id_estado_mass").val($(this).data("id_estado"));
			$("#created_at_mass").val($(this).data("created_at"));
			$("#updated_at_mass").val($(this).data("updated_at"));
			$("#usuarios_id_mass").val($(this).data("usuarios_id"));
			

			id = $('#id_mass').val();
			$('#acciones').attr('class', 'btn btn-warning edit');
			$('#acciones').text('Editar');
			$('#massModal').modal('show');
			$('#msdelete').text(' ');
		});

			


			$('.modal-footer').on('click', '.edit', function() {
				$.ajax({
					type: 'PUT',
					url: 'Solicitude/' + id,
					data: {
			'id': $('#id_mass').val(),
			'descripcion': $('#descripcion_mass').val(),
			'id_tipo': $('#id_tipo_mass').val(),
			'id_estado': $('#id_estado_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
			'usuarios_id': $('#usuarios_id_mass').val(),
			'_token': $('input[name=_token]').val()
				}, 
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errordescripcion').addClass('hidden');
			$('.errorid_tipo').addClass('hidden');
			$('.errorid_estado').addClass('hidden');
			$('.errorcreated_at').addClass('hidden');
			$('.errorupdated_at').addClass('hidden');
			$('.errorusuarios_id').addClass('hidden');
				 
			if ((data.errors)) {
				setTimeout(function () {
					$('#editModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			
				if (data.errors.id) {
                	$(".error.id").removeClass("hidden");
                	$(".error.id").text(data.errorsid);
                }
				if (data.errors.descripcion) {
                	$(".error.descripcion").removeClass("hidden");
                	$(".error.descripcion").text(data.errorsdescripcion);
                }
				if (data.errors.id_tipo) {
                	$(".error.id_tipo").removeClass("hidden");
                	$(".error.id_tipo").text(data.errorsid_tipo);
                }
				if (data.errors.id_estado) {
                	$(".error.id_estado").removeClass("hidden");
                	$(".error.id_estado").text(data.errorsid_estado);
                }
				if (data.errors.created_at) {
                	$(".error.created_at").removeClass("hidden");
                	$(".error.created_at").text(data.errorscreated_at);
                }
				if (data.errors.updated_at) {
                	$(".error.updated_at").removeClass("hidden");
                	$(".error.updated_at").text(data.errorsupdated_at);
                }
				if (data.errors.usuarios_id) {
                	$(".error.usuarios_id").removeClass("hidden");
                	$(".error.usuarios_id").text(data.errorsusuarios_id);
                }
 				} else {
                	toastr.success('Successfully updated Solicitude!', 'Success Alert', {timeOut: 5000});
                //update
				$('.item' + data.id).replaceWith(

			"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ data.descripcion+"</td>"+
				"<td>"+ data.id_tipo+"</td>"+
				"<td>"+ data.id_estado+"</td>"+
				"<td>"+ data.created_at+"</td>"+
				"<td>"+ data.updated_at+"</td>"+
				"<td>"+ data.usuarios_id+"</td>"+
				
			
						
						"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							"<td>Ahorra</td><td><button>"+ 
			" ' ><span class='glyphicon glyphicon-eye-open'></span> Ver</button> ' "+ 
			" '<button class='edit-modal btn btn-info' "+

						"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							 
			" ' ><span class='glyphicon glyphicon-edit'></span> Editar</button> <button class='massdelete-modal btn btn-danger' ' " +
						
						"'data-id='"+ data.id+
							"'data-descripcion='"+ data.descripcion+
							"'data-id_tipo='"+ data.id_tipo+
							"'data-id_estado='"+ data.id_estado+
							"'data-created_at='"+ data.created_at+
							"'data-updated_at='"+ data.updated_at+
							"'data-usuarios_id='"+ data.usuarios_id+
							 
			" ' ><span class='glyphicon glyphicon-trash'></span> Eliminar</button></td></tr>");
					
				





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

@stop

</body>
</html>










