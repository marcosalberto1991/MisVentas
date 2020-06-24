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
			  <h3 class="box-descripcion">Lista de Concepto_tecnico</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
					<a href="#" class="add-modal"><li>Add a Post</li></a>
					@can('Concepto_tecnico Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Concepto_tecnico</li></a>

					@endcan

					@hasrole('funciona')
										yo soy funciona!
										@else
										I m not a writer...
										@endhasrole
				</ul>
			</div>
		
			<div class="panel-body">
					<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
						<thead>
					   

							<tr>
								<th>id</th>
		<th>nombre</th>
		<th>created_at</th>
		<th>updated_at</th>
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
		<td class="col1">{{ $lists->created_at }}</td>
		<td class="col1">{{ $lists->updated_at }}</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										@can('Concepto_tecnico Show')
												<button class="massshow-modal btn btn-success" 
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		
												
												>
												<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan		
										@can('Concepto_tecnico Editar')
												<button class="edit-modal btn btn-info" 
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
		data-created_at="{{ $lists->created_at}}"
		data-updated_at="{{ $lists->updated_at}}"
		
												
												><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Concepto_tecnico Eliminar') 
												
												<button class="massdelete-modal btn btn-danger"
												data-id="{{ $lists->id}}"
		data-nombre="{{ $lists->nombre}}"
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
							
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>nombre:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='nombre_mass' maxlength='45'  required='required' autofocus>
								<p class='errornombre text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>created_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass'    required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>updated_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='updated_at_mass'    required='required' autofocus>
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
@section('page-js-files')	
@stop	
@section('page-js-script')

	<script>
		$(document).ready(function(){
	    	$("#postTable").DataTable();
		});

		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>

			
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
$('#nombre_mass').val($(this).data('nombre'));
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
$('#nombre_mass').val($(this).data('nombre'));
$('#created_at_mass').val($(this).data('created_at'));
$('#updated_at_mass').val($(this).data('updated_at'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Concepto_tecnico/'+id,
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
				url: 'Concepto_tecnico',
				data: {

				'id': $('#id_mass').val(),'nombre': $('#nombre_mass').val(),'created_at': $('#created_at_mass').val(),'updated_at': $('#updated_at_mass').val(),

					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
				   
					$('.errorid').addClass('hidden');$('.errornombre').addClass('hidden');$('.errorcreated_at').addClass('hidden');$('.errorupdated_at').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);

						$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);$('.errornombre').removeClass('hidden');$('.errornombre').text(data.errors.nombre);$('.errorcreated_at').removeClass('hidden');$('.errorcreated_at').text(data.errors.created_at);$('.errorupdated_at').removeClass('hidden');$('.errorupdated_at').text(data.errors.updated_at);;
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
			$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			"<td class='col1'>" + data.id + "</td>"+
			"<td>"+ data.nombre+"</td>"+
			"<td>"+ data.created_at+"</td>"+
			"<td>"+ data.updated_at+"</td>"+
			
						'  <td>Ahorra</td><td> '+
				@can('Concepto_tecnico Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Concepto_tecnico Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Concepto_tecnico Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
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
			$("#created_at_mass").val($(this).data("created_at"));
			$("#updated_at_mass").val($(this).data("updated_at"));
			

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
					url: 'Concepto_tecnico/' + id,
					data: {
			'id': $('#id_mass').val(),
			'nombre': $('#nombre_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
			'_token': $('input[name=_token]').val()
				}, 
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errornombre').addClass('hidden');
			$('.errorcreated_at').addClass('hidden');
			$('.errorupdated_at').addClass('hidden');
				 
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
				if (data.errors.created_at) {
                	$(".error.created_at").removeClass("hidden");
                	$(".error.created_at").text(data.errorscreated_at);
                }
				if (data.errors.updated_at) {
                	$(".error.updated_at").removeClass("hidden");
                	$(".error.updated_at").text(data.errorsupdated_at);
                }
 				} else {
                	toastr.success('Successfully updated Concepto_tecnico!', 'Success Alert', {timeOut: 5000});
                //update

			

				$('.item' + data.id).replaceWith(
"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ data.nombre+"</td>"+
				"<td>"+ data.created_at+"</td>"+
				"<td>"+ data.updated_at+"</td>"+
				
			'  <td>Ahorra</td><td> '+			
			
			@can('Concepto_tecnico Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Concepto_tecnico Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Concepto_tecnico Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-nombre='"+ data.nombre+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
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

@stop

</body>
</html>










