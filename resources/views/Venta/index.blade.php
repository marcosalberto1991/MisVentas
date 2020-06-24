@extends('layouts.app_admin_ui')

<script type='text/javascript'>
	<?php echo "const  Forausers_id= $users_id;"; ?>
			<?php echo "const  Foraestado_venta_id= $estado_venta_id;"; ?>
</script>

@section('content')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Venta</h3>
		</div>
		<div class="box-body">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-heading">
						<ul>
							<li><i class="fa fa-file-text-o"></i> Acciones</li>
							@can('Venta Add')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un
								Venta</button>
							@endcan
						</ul>
					</div>

					<div class="panel-body" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
							<thead>


								<tr>
									<th>ID</th>
									<th>Fecha de la venta</th>
									<th>Usuario</th>
									<th>Estado</th>
									<th>Creado en</th>
									<th>Modificado en</th>
									<th>Ultima Modificación</th>
									<th>Acciones</th>

								</tr>

							</thead>
							<tbody>


								@foreach($listmysql as $lists)

								<tr id="item_{{$lists->id}}"
									class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
									<td class="col1">{{ $lists->fecha_venta }}</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Forausers_id.find( cas => cas.id == {{ $lists->users_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraestado_venta_id.find( cas => cas.id == {{ $lists->estado_venta_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">{{ $lists->created_at }}</td>
									<td class="col1">{{ $lists->updated_at }}</td>

									<td>
										<?php if(!$lists->updated_at<"0000-00-00"){ ?>
										{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
										<?php } ?>
									</td>
									<td>
										@can('Venta Show')
										<button class="massshow-modal btn btn-success" data-id="{{ $lists->id}}"
											data-fecha_venta="{{ $lists->fecha_venta}}"
											data-users_id="{{ $lists->users_id}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}">
											<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan
										@can('Venta Editar')
										<button class="edit-modal btn btn-info" data-id="{{ $lists->id}}"
											data-fecha_venta="{{ $lists->fecha_venta}}"
											data-users_id="{{ $lists->users_id}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"><span
												class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Venta Eliminar')

										<button class="massdelete-modal btn btn-danger" data-id="{{ $lists->id}}"
											data-fecha_venta="{{ $lists->fecha_venta}}"
											data-users_id="{{ $lists->users_id}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"><span
												class="glyphicon glyphicon-trash"></span>Eliminar</button>

										@endcan
										<a class="btn btn-warning"
											href="javascript:window.open('{{ action('VentaController@PDF',['id' => $lists->id] ) }}');void 0">Genera
											factura</a>



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
				<h4 class="modal-descripcion"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los datos?</h3>
				<form class="form-horizontal" id="formmass" role="form">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label " for="id">ID:</label>
						<input type="text" class="form-control" id="id_mass" disabled>

					</div>

					<!-- 
					<div class='form-group'>
						<label class='control-label' for='descripcion'>ID:</label>
						<div class='col-sm-10'>
						-->
					<input type='hidden' name='id' class='form-control' id='id_mass' required='required' autofocus>
					<!--
							<p class='errorid text-center alert alert-danger d-none'></p>
						</div>
					</div>
						-->

					<div class='form-group' id='fecha_venta'>
						<label class='control-label' for='descripcion'>Fecha de la venta:</label>
						<input type='text' name='fecha_venta' class='form-control' id='fecha_venta_mass' maxlength='45'
							required='required' autofocus>
						<p class='errorfecha_venta text-center alert alert-danger d-none'></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">Usuario:</label>

						<select name="users_id" class="form-control" id="users_id_mass" required="required" autofocus>
							<option value=""></option>

							@foreach($users_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id=users_id_mass" required="required" autofocus>
							-->
						<p class="errorusers_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">Estado:</label>

						<select name="estado_venta_id" class="form-control" id="estado_venta_id_mass"
							required="required" autofocus>
							<option value=""></option>

							@foreach($estado_venta_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>

						<p class="errorestado_venta_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class='form-group' id='created_at'>
						<label class='control-label' for='descripcion'>Creado en :</label>
						<input type='text' name='created_at' class='form-control' id='created_at_mass' readonly
							required='required' autofocus>
						<p class='errorcreated_at text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='updated_at'>
						<label class='control-label' for='descripcion'>Modificado en:</label>
						<input type='text' name='updated_at' class='form-control' id='updated_at_mass' readonly
							required='required' autofocus>
						<p class='errorupdated_at text-center alert alert-danger d-none'></p>
					</div>



				</form>
				<div class="modal-footer">

					<button type="button" id="acciones" class="btn btn-primary mass">
						<span class="glyphicon glyphicon-check"></span> massar
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
						<span class="glyphicon glyphicon-remove"></span> Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Eliminar la venta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">Se eliminar el registro de forma permanente
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-danger delete" data-dismiss="modal">Eliminar</button>
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
	function obtener_data(data) {
	$('#id_mass').val(data.data('id'));
	$('#fecha_venta_mass').val(data.data('fecha_venta'));
	$('#users_id_mass').val(data.data('users_id'));
	$('#estado_venta_id_mass').val(data.data('estado_venta_id'));
	$('#created_at_mass').val(data.data('created_at'));
	$('#updated_at_mass').val(data.data('updated_at'));
	
}
//Añadir un registro
$(document).on('click', '.massadd', function() {
	$('.modal-descripcion').text('Añadir un nuevo registro');
	$('#msdelete').text(' ');
	$('#formmass')[0].reset();
	$('#massModal').modal('show');
	$('#acciones').attr('class', 'btn btn-success add');
	//$('#formmass').attr('id', 'form_add');
	$('#acciones').text('Añadir Nuevos ');
});
/*
$(document).on('click', '.masssssmodal', function() {
	$('.modal-descripcion').text('Añadir un nuevo registro');
	$('#msdelete').text(' ');

	$('#massmodal').modal('show');
	$('#acciones').attr('class', 'btn btn-success add');
	//$('#formmass').attr('id', 'form_add');
	$('#acciones').text('Añadir Nuevos ');
});
*/

// Vista de un registro
$(document).on('click', '.massshow-modal', function() {
	obtener_data($(this));					
	$('.modal-descripcion').text('Vista de los Datos');
	$('#msdelete').text(' ');
	$('#massModal').modal('show');
	$('#acciones').attr('class', 'btn btn-info hibe');
	$('#acciones').text('Visible');
	$('#acciones').attr('disabled');
});

// Editar un registro
$(document).on('click', '.edit-modal', function() {	
	obtener_data($(this));
	id = $('#id_mass').val();
	$('#acciones').attr('class', 'btn btn-warning edit');
	$('#acciones').text('Editar');
	$('.modal-descripcion').text('Editar un Dato');
	$('#massModal').modal('show');
	$('#msdelete').text(' ');
});

// Eliminar un registro
$(document).on('click', '.massdelete-modal', function() {
	$('#id_mass').val($(this).data('id'));
	id = $('#id_mass').val();           
	$('#DeleteModal').modal('show');
});



//enviar registro para eiminar
$('.modal-footer').on('click', '.delete', function() {
	$.ajax({
		type: 'DELETE',
		url: 'Venta/'+id,
		data: {
		'_token': $('input[name=_token]').val(),
		},
		success: function(data) {
			toastr.success('Dato Eliminado!', 'Operacion Exitosa', {timeOut: 5000});
			$('#item_' + data['id']).remove();
				
		}
	});
});
		

//enviar registro para añadir
$('.modal-footer').on('click', '.add', function() {
	$.ajax({
		type: 'POST',
		url: 'Venta',
		data: $('#formmass').serialize(),
		//data: {

		error: function(jqXHR, text, error){
        	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
        },
		success: function(data) { 
			if ((data.errors)) {
				verificar(data);
				//$('#massModal').modal('show');
            	toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {timeOut: 5000});	
			} else {
				toastr.success('Operación Exitosa!', 'Datos Guardados', {timeOut: 5000});
				operaciones(data,'add');
			}
		},
	});
});
						
//add

//enviar registro para editar
$('.modal-footer').on('click', '.edit', function() {
	$.ajax({
		type: 'PUT',
		url: 'Venta/' + id,
		data: $('#formmass').serialize(), 
		error: function(jqXHR, text, error){
            toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        },
		success: function(data) {
			if(data.errors){
				verificar(data);
            	toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});	
				//$('#massModal').modal('show');
			} else {
               	toastr.success('Modificación Exitosa Venta!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
	function verificar(data) {

	$('.errorid').addClass('d-none');
	$('.errorfecha_venta').addClass('d-none');
	$('.errorusers_id').addClass('d-none');
	$('.errorestado_venta_id').addClass('d-none');
	$('.errorcreated_at').addClass('d-none');
	$('.errorupdated_at').addClass('d-none');

	if (data.errors.id) {
    	$(".errorid").removeClass("d-none");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.fecha_venta) {
    	$(".errorfecha_venta").removeClass("d-none");
    	$(".errorfecha_venta").text(data.errors.fecha_venta);
    }
    
	if (data.errors.users_id) {
    	$(".errorusers_id").removeClass("d-none");
    	$(".errorusers_id").text(data.errors.users_id);
    }
    
	if (data.errors.estado_venta_id) {
    	$(".errorestado_venta_id").removeClass("d-none");
    	$(".errorestado_venta_id").text(data.errors.estado_venta_id);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("d-none");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("d-none");
    	$(".errorupdated_at").text(data.errors.updated_at);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resulusers_id=Forausers_id.find( cas => cas.id == data.users_id ); 
		const resulestado_venta_id=Foraestado_venta_id.find( cas => cas.id == data.estado_venta_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.fecha_venta+"</td>"+
		"<td>"+ resulusers_id["nombre"]  +"</td>"+
		"<td>"+ resulestado_venta_id["nombre"]  +"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Venta Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-fecha_venta='"+ data.fecha_venta+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Venta Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-fecha_venta='"+ data.fecha_venta+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Venta Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-fecha_venta='"+ data.fecha_venta+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button>  "+
	@endcan
	" </td></tr>";

	if('edit'==operacion){		
		$('#item_'+data.id).replaceWith(tabla);
	}
	if('add'==operacion){
		$('#myTable').append(tabla);
	}
} 
</script>
@stop
</body>

</html>