@extends('layouts.app_admin_ui')

<script type='text/javascript'>
	<?php echo "const  Foraproductos_id= $productos_id;"; ?>
			<?php echo "const  Forausers_id= $users_id;"; ?>
			<?php echo "const  Forafactura_id= $factura_id;"; ?>
			<?php echo "const  Foraestado_id= $estado_id;"; ?>
</script>

@section('content')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Entrada</h3>
		</div>
		<div class="box-body">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-heading">
						<ul>
							<li><i class="fa fa-file-text-o"></i> Acciones</li>
							@can('Entrada Add')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un
								Entrada</button>
							@endcan
						</ul>
					</div>

					<div class="panel-body" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
							<thead>


								<tr>
									<th>id</th>
									<th>cantidad</th>
									<!--
									<th>existencia</th>
									-->
									<th>precio_unidad</th>
									<th>productos_id</th>
									<th>users_id</th>
									<th>lote</th>
									<th>numero_lote</th>
									<th>factura_id</th>
									<th>estado_id</th>
									<th>Ultima Modificacion</th>
									<th>Accion</th>

								</tr>

							</thead>
							<tbody>


								@foreach($listmysql as $lists)

								<tr id="item_{{$lists->id}}"
									class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
									<td class="col1">{{ $lists->cantidad }}</td>
									<!--
									<td class="col1">{{ $lists->existencia }}</td>
									-->
									<td class="col1">{{ $lists->precio_unidad }}</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraproductos_id.find( cas => cas.id == {{ $lists->productos_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Forausers_id.find( cas => cas.id == {{ $lists->users_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">{{ $lists->lote }}</td>
									<td class="col1">{{ $lists->numero_lote }}</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Forafactura_id.find( cas => cas.id == {{ $lists->factura_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraestado_id.find( cas => cas.id == {{ $lists->estado_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>

									<td>
										<?php if(!$lists->updated_at<"0000-00-00"){ ?>
										{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
										<?php } ?>
									</td>
									<td>
										@can('Entrada Show')
										<button class="massshow-modal btn btn-success" data-id="{{ $lists->id}}"
											data-cantidad="{{ $lists->cantidad}}"
											data-existencia="{{ $lists->existencia}}"
											data-precio_unidad="{{ $lists->precio_unidad}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-users_id="{{ $lists->users_id}}" data-lote="{{ $lists->lote}}"
											data-numero_lote="{{ $lists->numero_lote}}"
											data-factura_id="{{ $lists->factura_id}}"
											data-estado_id="{{ $lists->estado_id}}">
											<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan
										@can('Entrada Editar')
										<button class="edit-modal btn btn-info" data-id="{{ $lists->id}}"
											data-cantidad="{{ $lists->cantidad}}"
											data-existencia="{{ $lists->existencia}}"
											data-precio_unidad="{{ $lists->precio_unidad}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-users_id="{{ $lists->users_id}}" data-lote="{{ $lists->lote}}"
											data-numero_lote="{{ $lists->numero_lote}}"
											data-factura_id="{{ $lists->factura_id}}"
											data-estado_id="{{ $lists->estado_id}}"><span
												class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Entrada Eliminar')

										<button class="massdelete-modal btn btn-danger" data-id="{{ $lists->id}}"
											data-cantidad="{{ $lists->cantidad}}"
											data-existencia="{{ $lists->existencia}}"
											data-precio_unidad="{{ $lists->precio_unidad}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-users_id="{{ $lists->users_id}}" data-lote="{{ $lists->lote}}"
											data-numero_lote="{{ $lists->numero_lote}}"
											data-factura_id="{{ $lists->factura_id}}"
											data-estado_id="{{ $lists->estado_id}}"><span
												class="glyphicon glyphicon-trash"></span>Eliminar</button>

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
						<label class='control-label' for='descripcion'>id:</label>
						<div class='col-sm-10'>
						-->
					<input type='hidden' name='id' class='form-control' id='id_mass' required='required' autofocus>
					<!--
							<p class='errorid text-center alert alert-danger d-none'></p>
						</div>
					</div>
						-->

					<div class='form-group' id='cantidad'>
						<label class='control-label' for='descripcion'>cantidad:</label>
						<input type='text' name='cantidad' class='form-control' id='cantidad_mass' maxlength='11'
							required='required' autofocus>
						<p class='errorcantidad text-center alert alert-danger d-none'></p>
					</div>
					<!--
					<div class='form-group' id='existencia'>
						<label class='control-label' for='descripcion'>existencia:</label>
						<input type='text' name='existencia' class='form-control' id='existencia_mass' maxlength='11'
							required='required' autofocus>
						<p class='errorexistencia text-center alert alert-danger d-none'></p>
					</div>
					-->
					<div class='form-group' id='precio_unidad'>
						<label class='control-label' for='descripcion'>precio_unidad:</label>
						<input type='text' name='precio_unidad' class='form-control' id='precio_unidad_mass'
							maxlength='45' required='required' autofocus>
						<p class='errorprecio_unidad text-center alert alert-danger d-none'></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">productos_id:</label>

						<select name="productos_id" class="form-control" id="productos_id_mass" required="required"
							autofocus>
							<option value=""></option>

							@foreach($productos_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="productos_id_mass" required="required" autofocus>
							-->
						<p class="errorproductos_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">users_id:</label>

						<select name="users_id" class="form-control" id="users_id_mass" required="required" autofocus>
							<option value=""></option>

							@foreach($users_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="users_id_mass" required="required" autofocus>
							-->
						<p class="errorusers_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class='form-group' id='lote'>
						<label class='control-label' for='descripcion'>lote:</label>
						<input type='text' name='lote' class='form-control' id='lote_mass' maxlength='45'
							required='required' autofocus>
						<p class='errorlote text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='numero_lote'>
						<label class='control-label' for='descripcion'>numero_lote:</label>
						<input type='text' name='numero_lote' class='form-control' id='numero_lote_mass' maxlength='45'
							required='required' autofocus>
						<p class='errornumero_lote text-center alert alert-danger d-none'></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">factura_id:</label>

						<select name="factura_id" class="form-control" id="factura_id_mass" required="required"
							autofocus>
							<option value=""></option>

							@foreach($factura_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="factura_id_mass" required="required" autofocus>
							-->
						<p class="errorfactura_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">estado_id:</label>

						<select name="estado_id" class="form-control" id="estado_id_mass" required="required" autofocus>
							<option value=""></option>

							@foreach($estado_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="estado_id_mass" required="required" autofocus>
							-->
						<p class="errorestado_id text-center alert alert-danger d-none"> llenar los datos</p>
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
				<h5 class="modal-title" id="exampleModalLabel">Eliminar el registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">Se eliminar el registro de forma permanete
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
	$('#cantidad_mass').val(data.data('cantidad'));
	$('#existencia_mass').val(data.data('existencia'));
	$('#precio_unidad_mass').val(data.data('precio_unidad'));
	$('#productos_id_mass').val(data.data('productos_id'));
	$('#users_id_mass').val(data.data('users_id'));
	$('#lote_mass').val(data.data('lote'));
	$('#numero_lote_mass').val(data.data('numero_lote'));
	$('#factura_id_mass').val(data.data('factura_id'));
	$('#estado_id_mass').val(data.data('estado_id'));
	
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
		url: 'Entrada/'+id,
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
		url: 'Entrada',
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
		url: 'Entrada/' + id,
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
               	toastr.success('Modificación Exitosa Entrada!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
	function verificar(data) {

	$('.errorid').addClass('hidden');
	$('.errorcantidad').addClass('hidden');
	$('.errorexistencia').addClass('hidden');
	$('.errorprecio_unidad').addClass('hidden');
	$('.errorproductos_id').addClass('hidden');
	$('.errorusers_id').addClass('hidden');
	$('.errorlote').addClass('hidden');
	$('.errornumero_lote').addClass('hidden');
	$('.errorfactura_id').addClass('hidden');
	$('.errorestado_id').addClass('hidden');

	if (data.errors.id) {
    	$(".errorid").removeClass("hidden");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.cantidad) {
    	$(".errorcantidad").removeClass("hidden");
    	$(".errorcantidad").text(data.errors.cantidad);
    }
    
	if (data.errors.existencia) {
    	$(".errorexistencia").removeClass("hidden");
    	$(".errorexistencia").text(data.errors.existencia);
    }
    
	if (data.errors.precio_unidad) {
    	$(".errorprecio_unidad").removeClass("hidden");
    	$(".errorprecio_unidad").text(data.errors.precio_unidad);
    }
    
	if (data.errors.productos_id) {
    	$(".errorproductos_id").removeClass("hidden");
    	$(".errorproductos_id").text(data.errors.productos_id);
    }
    
	if (data.errors.users_id) {
    	$(".errorusers_id").removeClass("hidden");
    	$(".errorusers_id").text(data.errors.users_id);
    }
    
	if (data.errors.lote) {
    	$(".errorlote").removeClass("hidden");
    	$(".errorlote").text(data.errors.lote);
    }
    
	if (data.errors.numero_lote) {
    	$(".errornumero_lote").removeClass("hidden");
    	$(".errornumero_lote").text(data.errors.numero_lote);
    }
    
	if (data.errors.factura_id) {
    	$(".errorfactura_id").removeClass("hidden");
    	$(".errorfactura_id").text(data.errors.factura_id);
    }
    
	if (data.errors.estado_id) {
    	$(".errorestado_id").removeClass("hidden");
    	$(".errorestado_id").text(data.errors.estado_id);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resulproductos_id=Foraproductos_id.find( cas => cas.id == data.productos_id ); 
		const resulusers_id=Forausers_id.find( cas => cas.id == data.users_id ); 
		const resulfactura_id=Forafactura_id.find( cas => cas.id == data.factura_id ); 
		const resulestado_id=Foraestado_id.find( cas => cas.id == data.estado_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.cantidad+"</td>"+
		"<td>"+ data.existencia+"</td>"+
		"<td>"+ data.precio_unidad+"</td>"+
		"<td>"+ resulproductos_id["nombre"]  +"</td>"+
		"<td>"+ resulusers_id["nombre"]  +"</td>"+
		"<td>"+ data.lote+"</td>"+
		"<td>"+ data.numero_lote+"</td>"+
		"<td>"+ resulfactura_id["nombre"]  +"</td>"+
		"<td>"+ resulestado_id["nombre"]  +"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Entrada Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-existencia='"+ data.existencia+"'"+
		"data-precio_unidad='"+ data.precio_unidad+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-lote='"+ data.lote+"'"+
		"data-numero_lote='"+ data.numero_lote+"'"+
		"data-factura_id='"+ data.factura_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Entrada Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-existencia='"+ data.existencia+"'"+
		"data-precio_unidad='"+ data.precio_unidad+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-lote='"+ data.lote+"'"+
		"data-numero_lote='"+ data.numero_lote+"'"+
		"data-factura_id='"+ data.factura_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Entrada Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-existencia='"+ data.existencia+"'"+
		"data-precio_unidad='"+ data.precio_unidad+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-lote='"+ data.lote+"'"+
		"data-numero_lote='"+ data.numero_lote+"'"+
		"data-factura_id='"+ data.factura_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
		 
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