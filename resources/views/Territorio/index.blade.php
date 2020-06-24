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
			  <h3 class="box-descripcion">Lista de Territorio</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
					<a href="#" class="add-modal"><li>Add a Post</li></a>
					@can('Territorio Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Territorio</li></a>

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
		<th>logitud</th>
		<th>lantitud</th>
		<th>barrio_id</th>
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
		<td class="col1">{{ $lists->logitud }}</td>
		<td class="col1">{{ $lists->lantitud }}</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Forabarrio_id.find( cas => cas.id == {{ $lists->barrio_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										@can('Territorio Show')
												<button class="massshow-modal btn btn-success" 
												data-id="{{ $lists->id}}"
		data-logitud="{{ $lists->logitud}}"
		data-lantitud="{{ $lists->lantitud}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		
												
												>
												<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan		
										@can('Territorio Editar')
												<button class="edit-modal btn btn-info" 
												data-id="{{ $lists->id}}"
		data-logitud="{{ $lists->logitud}}"
		data-lantitud="{{ $lists->lantitud}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		
												
												><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Territorio Eliminar') 
												
												<button class="massdelete-modal btn btn-danger"
												data-id="{{ $lists->id}}"
		data-logitud="{{ $lists->logitud}}"
		data-lantitud="{{ $lists->lantitud}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		
												
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
							
						
						<div class='form-group' id='lantitud' >
							<label class='control-label col-sm-2' for='descripcion'>lantitud:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='lantitud_mass' maxlength='45'   required='required' autofocus>
								<p class='errorlantitud text-center alert alert-danger hidden'></p>
							</div>
						</div>
						<div class='form-group' id='logitud' >
							<label class='control-label col-sm-2' for='descripcion'>logitud:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='logitud_mass' maxlength='45'   required='required' autofocus>
								<p class='errorlogitud text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">barrio_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="barrio_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($barrio_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=barrio_id_mass" required="required" autofocus>
								-->
								<p class="errorbarrio_id text-center alert alert-danger hidden"> llenar los datos</p>
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
			<?php echo "const  Forabarrio_id= $barrio_id;"; ?>
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
$('#logitud_mass').val($(this).data('logitud'));
$('#lantitud_mass').val($(this).data('lantitud'));
$('#barrio_id_mass').val($(this).data('barrio_id'));
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
$('#logitud_mass').val($(this).data('logitud'));
$('#lantitud_mass').val($(this).data('lantitud'));
$('#barrio_id_mass').val($(this).data('barrio_id'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Territorio/'+id,
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
				url: 'Territorio',
				data: {

				'id': $('#id_mass').val(),'logitud': $('#logitud_mass').val(),'lantitud': $('#lantitud_mass').val(),'barrio_id': $('#barrio_id_mass').val(),
					'_token': $('input[name=_token]').val(),
				},
				error: function(jqXHR, text, error){
            	toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});
        		},
				success: function(data) { 
					$('.errorid').addClass('hidden');$('.errorlogitud').addClass('hidden');$('.errorlantitud').addClass('hidden');$('.errorbarrio_id').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);
						if(data.errors.id){$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);
				}if(data.errors.logitud){$('.errorlogitud').removeClass('hidden');$('.errorlogitud').text(data.errors.logitud);
				}if(data.errors.lantitud){$('.errorlantitud').removeClass('hidden');$('.errorlantitud').text(data.errors.lantitud);
				}if(data.errors.barrio_id){$('.errorbarrio_id').removeClass('hidden');$('.errorbarrio_id').text(data.errors.barrio_id);
				};
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
							$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			"<td class='col1'>" + data.id + "</td>"+
			"<td>"+ data.logitud+"</td>"+
			"<td>"+ data.lantitud+"</td>"+
			"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
			
						'  <td>Ahorra</td><td> '+
				@can('Territorio Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Territorio Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Territorio Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
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
			$("#logitud_mass").val($(this).data("logitud"));
			$("#lantitud_mass").val($(this).data("lantitud"));
			$("#barrio_id_mass").val($(this).data("barrio_id"));
			

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
					url: 'Territorio/' + id,
					data: {
			'id': $('#id_mass').val(),
			'logitud': $('#logitud_mass').val(),
			'lantitud': $('#lantitud_mass').val(),
			'barrio_id': $('#barrio_id_mass').val(),
			'_token': $('input[name=_token]').val()
				}, 
			error: function(jqXHR, text, error){
            toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errorlogitud').addClass('hidden');
			$('.errorlantitud').addClass('hidden');
			$('.errorbarrio_id').addClass('hidden');
				 
			if ((data.errors)) {
				setTimeout(function () {
					$('#editModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			
				if (data.errors.id) {
                	$(".error.id").removeClass("hidden");
                	$(".error.id").text(data.errorsid);
                }
				if (data.errors.logitud) {
                	$(".error.logitud").removeClass("hidden");
                	$(".error.logitud").text(data.errorslogitud);
                }
				if (data.errors.lantitud) {
                	$(".error.lantitud").removeClass("hidden");
                	$(".error.lantitud").text(data.errorslantitud);
                }
				if (data.errors.barrio_id) {
                	$(".error.barrio_id").removeClass("hidden");
                	$(".error.barrio_id").text(data.errorsbarrio_id);
                }
 				} else {
                	toastr.success('Successfully updated Territorio!', 'Success Alert', {timeOut: 5000});
                //update

			const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
				

				$('.item' + data.id).replaceWith(
"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ data.logitud+"</td>"+
				"<td>"+ data.lantitud+"</td>"+
				"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
				
			'  <td>Ahorra</td><td> '+			
			
			@can('Territorio Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Territorio Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Territorio Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-logitud='"+ data.logitud+
						"' data-lantitud='"+ data.lantitud+
						"' data-barrio_id='"+ data.barrio_id+
						 
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










