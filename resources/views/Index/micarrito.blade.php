@extends('layouts.app_admin_ui')

<script type='text/javascript'>
	<?php echo "const  Foraproductos_id= $productos_id;"; ?>
			<?php echo "const  Foraventa_id= $venta_id;"; ?>
			<?php echo "const  Foraestado_venta_id= $estado_venta_id;"; ?>
</script>

@section('content')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Mi carrito</h3>
		</div>
		<div class="box-body">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-heading">
						<ul>
							<li><i class="fa fa-file-text-o"></i> Acciones</li>
							@can('Productos_has_venta Add')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un
								Productos_has_venta</button>
							@endcan
						</ul>
					</div>

					<div class="panel-body" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
							<thead>


								<tr>
									<th>ID</th>
									<th>Producto</th>
									<th>venta</th>
									<th>cantidad</th>
									<th>Precio Unidad</th>
									<th>Total</th>
									<th>Estado</th>
									<th>Modificado en</th>
									<th>Creador en</th>
									<th>Ultima Modificacion</th>
									<th>Acciones</th>

								</tr>

							</thead>
							<tbody>

								<?php 
								$total=0;
								?>
								@foreach($listmysql as $lists)

								<tr id="item_{{$lists->id}}"
									class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraproductos_id.find( cas => cas.id == {{ $lists->productos_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">{{ $lists->venta_id_pk->id }}</td>

									<td class="col1">{{ $lists->cantidad }}</td>
									<td class="col1">{{ $lists->producto_id_pk->precio_venta }}</td>
									<td class="col1">{{ $lists->cantidad*$lists->producto_id_pk->precio_venta }}</td>
									<?php $total=$total+$lists->cantidad*$lists->producto_id_pk->precio_venta ?>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraestado_venta_id.find( cas => cas.id == {{ $lists->estado_venta_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">{{ $lists->updated_at }}</td>
									<td class="col1">{{ $lists->created_at }}</td>

									<td>
										<?php if(!$lists->updated_at<"0000-00-00"){ ?>
										{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
										<?php } ?>
									</td>
									<td>
										@can('Productos_has_venta Show')
										<button class="massshow-modal btn btn-success" data-id="{{ $lists->id}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-venta_id="{{ $lists->venta_id}}" data-cantidad="{{ $lists->cantidad}}"
											data-precio_producto="{{ $lists->precio_producto}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-created_at="{{ $lists->created_at}}">
											<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan
										@can('Productos_has_venta Editar')
										<button class="edit-modal btn btn-info" data-id="{{ $lists->id}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-venta_id="{{ $lists->venta_id}}" data-cantidad="{{ $lists->cantidad}}"
											data-precio_producto="{{ $lists->precio_producto}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-created_at="{{ $lists->created_at}}"><span
												class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan


										<button class="massdelete-modal btn btn-danger" data-id="{{ $lists->id}}"
											data-productos_id="{{ $lists->productos_id}}"
											data-venta_id="{{ $lists->venta_id}}" data-cantidad="{{ $lists->cantidad}}"
											data-precio_producto="{{ $lists->precio_producto}}"
											data-estado_venta_id="{{ $lists->estado_venta_id}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-created_at="{{ $lists->created_at}}"><span
												class="glyphicon glyphicon-trash"></span>Eliminar</button>
										@can('Productos_has_venta Eliminar')
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

		<div class="alert alert-success" role="alert">
			<h4 class="alert-heading">Total de la compra: {{ $total }}</h4>
			@if( count($listmysql)>0 ) <a href="{{ action('IndexController@procesar_compra') }}"
				class="btn btn-success">
				Procesar la compra
			</a>
			@endif


		</div>

	</div>


</section>

<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Mi comras realizadas</h3>

		</div>
		<div class="box-body">
			@foreach($venta_procesadas as $lists)
			<div class="alert alert-info" role="alert">
				<p><b>Venta numero:</b> {{ $lists->id }}</p>
				<a class="btn btn-warning"
					href="javascript:window.open('{{ action('VentaController@PDF',['id' => $lists->id] ) }}');void 0">Genera
					factura</a>

				<table class="table table-striped table-bordered table-hover compact nowrap">
					<thead>
						<tr>

							<th>Producto</th>


							<th>Precio Unidad</th>
							<th>cantidad</th>
							<th>Total</th>



						</tr>

					</thead>
					<tbody>


						@foreach($lists->productos_has_venta_all as $pro)
						<tr>
							<td class="col1">{{ $pro->producto_id_pk->nombre }}</td>
							<td class="col1">{{ $pro->precio_producto }}</td>
							<td class="col1">{{ $pro->cantidad }}</td>
							<td class="col1">{{ $pro->cantidad*$pro->precio_producto }}</td>

						</tr>
						@endforeach

				</table>
			</div>
			@endforeach

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
						<label class="control-label" for="descripcion">venta_id:</label>

						<select name="venta_id" class="form-control" id="venta_id_mass" required="required" autofocus>
							<option value=""></option>

							@foreach($venta_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="venta_id_mass" required="required" autofocus>
							-->
						<p class="errorventa_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class='form-group' id='cantidad'>
						<label class='control-label' for='descripcion'>cantidad:</label>
						<input type='text' name='cantidad' class='form-control' id='cantidad_mass' maxlength='11'
							required='required' autofocus>
						<p class='errorcantidad text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='precio_producto'>
						<label class='control-label' for='descripcion'>precio_producto:</label>
						<input type='text' name='precio_producto' class='form-control' id='precio_producto_mass'
							maxlength='45' required='required' autofocus>
						<p class='errorprecio_producto text-center alert alert-danger d-none'></p>
					</div>

					<div class="form-group">
						<label class="control-label" for="descripcion">estado_venta_id:</label>

						<select name="estado_venta_id" class="form-control" id="estado_venta_id_mass"
							required="required" autofocus>
							<option value=""></option>

							@foreach($estado_venta_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="estado_venta_id_mass" required="required" autofocus>
							-->
						<p class="errorestado_venta_id text-center alert alert-danger d-none"> llenar los datos
						</p>
					</div>

					<div class='form-group' id='updated_at'>
						<label class='control-label' for='descripcion'>updated_at:</label>
						<input type='text' name='updated_at' class='form-control' id='updated_at_mass' readonly
							required='required' autofocus>
						<p class='errorupdated_at text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='created_at'>
						<label class='control-label' for='descripcion'>created_at:</label>
						<input type='text' name='created_at' class='form-control' id='created_at_mass' readonly
							required='required' autofocus>
						<p class='errorcreated_at text-center alert alert-danger d-none'></p>
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
				<h5 class="modal-title" id="exampleModalLabel">Eliminar el producto del carrito</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
						aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">Se eliminar el producto del carrito
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
	$('#productos_id_mass').val(data.data('productos_id'));
	$('#venta_id_mass').val(data.data('venta_id'));
	$('#cantidad_mass').val(data.data('cantidad'));
	$('#precio_producto_mass').val(data.data('precio_producto'));
	$('#estado_venta_id_mass').val(data.data('estado_venta_id'));
	$('#updated_at_mass').val(data.data('updated_at'));
	$('#created_at_mass').val(data.data('created_at'));
	
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
		url: '../Productos_has_venta/'+id,
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
		url: 'Productos_has_venta',
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
		url: 'Productos_has_venta/' + id,
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
               	toastr.success('Modificación Exitosa Productos_has_venta!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
	function verificar(data) {

	$('.errorid').addClass('d-none');
	$('.errorproductos_id').addClass('d-none');
	$('.errorventa_id').addClass('d-none');
	$('.errorcantidad').addClass('d-none');
	$('.errorprecio_producto').addClass('d-none');
	$('.errorestado_venta_id').addClass('d-none');
	$('.errorupdated_at').addClass('d-none');
	$('.errorcreated_at').addClass('d-none');

	if (data.errors.id) {
    	$(".errorid").removeClass("d-none");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.productos_id) {
    	$(".errorproductos_id").removeClass("d-none");
    	$(".errorproductos_id").text(data.errors.productos_id);
    }
    
	if (data.errors.venta_id) {
    	$(".errorventa_id").removeClass("d-none");
    	$(".errorventa_id").text(data.errors.venta_id);
    }
    
	if (data.errors.cantidad) {
    	$(".errorcantidad").removeClass("d-none");
    	$(".errorcantidad").text(data.errors.cantidad);
    }
    
	if (data.errors.precio_producto) {
    	$(".errorprecio_producto").removeClass("d-none");
    	$(".errorprecio_producto").text(data.errors.precio_producto);
    }
    
	if (data.errors.estado_venta_id) {
    	$(".errorestado_venta_id").removeClass("d-none");
    	$(".errorestado_venta_id").text(data.errors.estado_venta_id);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("d-none");
    	$(".errorupdated_at").text(data.errors.updated_at);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("d-none");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resulproductos_id=Foraproductos_id.find( cas => cas.id == data.productos_id ); 
		const resulventa_id=Foraventa_id.find( cas => cas.id == data.venta_id ); 
		const resulestado_venta_id=Foraestado_venta_id.find( cas => cas.id == data.estado_venta_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ resulproductos_id["nombre"]  +"</td>"+
		"<td>"+ resulventa_id["nombre"]  +"</td>"+
		"<td>"+ data.cantidad+"</td>"+
		"<td>"+ data.precio_producto+"</td>"+
		"<td>"+ resulestado_venta_id["nombre"]  +"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Productos_has_venta Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-venta_id='"+ data.venta_id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-precio_producto='"+ data.precio_producto+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Productos_has_venta Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-venta_id='"+ data.venta_id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-precio_producto='"+ data.precio_producto+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Productos_has_venta Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-productos_id='"+ data.productos_id+"'"+
		"data-venta_id='"+ data.venta_id+"'"+
		"data-cantidad='"+ data.cantidad+"'"+
		"data-precio_producto='"+ data.precio_producto+"'"+
		"data-estado_venta_id='"+ data.estado_venta_id+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-created_at='"+ data.created_at+"'"+
		 
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