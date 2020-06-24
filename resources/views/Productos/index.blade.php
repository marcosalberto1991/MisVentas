@extends('layouts.App_admin_ui')

<script type='text/javascript'>
	<?php echo "const  Foraestados_id= $estados_id;"; ?>
</script>

@section('content')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Productos</h3>
		</div>
		<div class="box-body">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-heading">
						@can('Productos Add')
						<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un
							Productos</button>
						@endcan

					</div>

					<div class="panel-body" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
							<thead>


								<tr>
									<th>ID</th>
									<th>Código de producto</th>
									<th>Nombre</th>
									<th>Descricion</th>
									<th>Imagen</th>
									<th>Creado en</th>
									<th>Modificador en</th>
									<th>Estados</th>
									<th>Precio de venta</th>
									<th>Ultima Modificación</th>
									<th>Acciones</th>

								</tr>

							</thead>
							<tbody>


								@foreach($listmysql as $lists)

								<tr id="item_{{$lists->id}}"
									class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
									<td class="col1">{{ $lists->codigo_producto }}</td>
									<td class="col1">{{ $lists->nombre }}</td>
									<td class="col1">{{ $lists->descricion }}</td>
									<td>
										<a href="{{ asset('perfil_usuario/'.$lists->imagen) }}" target="_blank">
											<img height="40px" src="{{ asset('perfil_usuario/'.$lists->imagen) }}"
												width="40px" />

										</a>
									</td>
									<td class="col1">{{ $lists->created_at }}</td>
									<td class="col1">{{ $lists->updated_at }}</td>
									<td class="col1">
										<script type="text/javascript">
											resulmunicipios_id=Foraestados_id.find( cas => cas.id == {{ $lists->estados_id }} );
							document.write(resulmunicipios_id.nombre); 
										</script>
									</td>
									<td class="col1">{{ $lists->precio_venta }}</td>

									<td>
										<?php if(!$lists->updated_at<"0000-00-00"){ ?>
										{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
										<?php } ?>
									</td>
									<td>
										@can('Productos Show')
										<button class="massshow-modal btn btn-success" data-id="{{ $lists->id}}"
											data-codigo_producto="{{ $lists->codigo_producto}}"
											data-nombre="{{ $lists->nombre}}" data-descricion="{{ $lists->descricion}}"
											data-imagen="{{ $lists->imagen}}" data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-estados_id="{{ $lists->estados_id}}"
											data-precio_venta="{{ $lists->precio_venta}}">
											<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan
										@can('Productos Editar')
										<button class="edit-modal btn btn-info" data-id="{{ $lists->id}}"
											data-codigo_producto="{{ $lists->codigo_producto}}"
											data-nombre="{{ $lists->nombre}}" data-descricion="{{ $lists->descricion}}"
											data-imagen="{{ $lists->imagen}}" data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-estados_id="{{ $lists->estados_id}}"
											data-precio_venta="{{ $lists->precio_venta}}"><span
												class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Productos Eliminar')

										<button class="massdelete-modal btn btn-danger" data-id="{{ $lists->id}}"
											data-codigo_producto="{{ $lists->codigo_producto}}"
											data-nombre="{{ $lists->nombre}}" data-descricion="{{ $lists->descricion}}"
											data-imagen="{{ $lists->imagen}}" data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"
											data-estados_id="{{ $lists->estados_id}}"
											data-precio_venta="{{ $lists->precio_venta}}"><span
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
						<label class='control-label' for='descripcion'>ID:</label>
						<div class='col-sm-10'>
						-->
					<input type='hidden' name='id' class='form-control' id='id_mass' required='required' autofocus>
					<!--
							<p class='errorid text-center alert alert-danger d-none'></p>
						</div>
					</div>
						-->

					<div class='form-group' id='codigo_producto'>
						<label class='control-label' for='descripcion'>Codigo de producto:</label>
						<input type='text' name='codigo_producto' class='form-control input-number-line'
							id='codigo_producto_mass' maxlength='45' required='required' autofocus>
						<p class='errorcodigo_producto text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='nombre'>
						<label class='control-label' for='descripcion'>Nombre:</label>
						<input type='text' name='nombre' class='form-control' id='nombre_mass' maxlength='45'
							required='required' autofocus>
						<p class='errornombre text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='descricion'>
						<label class='control-label' for='descripcion'>Descricion:</label>
						<input type='text' name='descricion' class='form-control' id='descricion_mass'
							required='required' autofocus>
						<p class='errordescricion text-center alert alert-danger d-none'></p>
					</div>
					<div class='form-group' id='archivo'>
						<label class='control-label col-sm-2' for='descripcion'>Vista previa:</label>
						<img height="150px" width="150px" id="Imagene_modal" src="" style="margin-left: 15px;" />
					</div>
					<div class='form-group' id='imagen'>
						<label class='control-label ' for='descripcion'>imagen:</label>
						<input type='file' name='imagen' class='form-control' id='imagen_mass' maxlength='45'
							required='required' autofocus>
						<p class='errorimagen text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='created_at'>
						<label class='control-label' for='descripcion'>Creador en:</label>
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

					<div class="form-group">
						<label class="control-label" for="descripcion">Estado:</label>

						<select name="estados_id" class="form-control" id="estados_id_mass" required="required"
							autofocus>
							<option value=""></option>

							@foreach($estados_id as $lists)
							<option value="{{$lists->id}}">{{$lists->nombre}}</option>
							@endforeach

						</select>
						<!--
							<input type="select" class="form-control" id="estados_id_mass" required="required" autofocus>
							-->
						<p class="errorestados_id text-center alert alert-danger d-none"> llenar los datos</p>
					</div>

					<div class='form-group' id='precio_venta'>
						<label class='control-label' for='descripcion'>Precio de venta:</label>
						<input type='text' name='precio_venta' class='form-control input-number' id='precio_venta_mass'
							maxlength='45' required='required' autofocus>
						<p class='errorprecio_venta text-center alert alert-danger d-none'></p>
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
	$('#codigo_producto_mass').val(data.data('codigo_producto'));
	$('#nombre_mass').val(data.data('nombre'));
	$('#descricion_mass').val(data.data('descricion'));
	$('#created_at_mass').val(data.data('created_at'));
	$('#updated_at_mass').val(data.data('updated_at'));
	$('#estados_id_mass').val(data.data('estados_id'));
	$('#precio_venta_mass').val(data.data('precio_venta'));

	var url='{{ asset("perfil_usuario/") }}';
	$("#Imagene_modal").attr("src", url+'/'+data.data('imagen'));
	
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
	var formData = new FormData($('#formmass')[0]);
	$.ajax({
		type: 'DELETE',
		url: 'Productos/'+id,
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
	var formData = new FormData($('#formmass')[0]);
	$.ajax({
		type: 'POST',
		url: 'Productos',
		//data: $('#formmass').serialize(),
		data: formData,
    	cache: false,
    	contentType: false,
    	processData: false,
		//type: 'POST',
		//url: 'Productos',
		//data: $('#formmass').serialize(),
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
	var formData = new FormData($('#formmass')[0]);
	$.ajax({
		type: 'POST',
		//type: 'PUT',
		url: 'Productos/update/' + id,
		//data: $('#formmass').serialize(), 
		data: formData,
    	cache: false,
    	contentType: false,
    	processData: false,
		//type: 'PUT',
		//url: 'Productos/' + id,
		//data: $('#formmass').serialize(), 
		error: function(jqXHR, text, error){
            toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        },
		success: function(data) {
			if(data.errors){
				verificar(data);
            	toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});	
				//$('#massModal').modal('show');
			} else {
               	toastr.success('Modificación Exitosa Productos!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
	function verificar(data) {

	$('.errorid').addClass('d-none');
	$('.errorcodigo_producto').addClass('d-none');
	$('.errornombre').addClass('d-none');
	$('.errordescricion').addClass('d-none');
	$('.errorcreated_at').addClass('d-none');
	$('.errorimagen').addClass('d-none');
	$('.errorupdated_at').addClass('d-none');
	$('.errorestados_id').addClass('d-none');
	$('.errorprecio_venta').addClass('d-none');

	if (data.errors.id) {
    	$(".errorid").removeClass("d-none");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.codigo_producto) {
    	$(".errorcodigo_producto").removeClass("d-none");
    	$(".errorcodigo_producto").text(data.errors.codigo_producto);
    }
    
	if (data.errors.nombre) {
    	$(".errornombre").removeClass("d-none");
    	$(".errornombre").text(data.errors.nombre);
	}
	if (data.errors.imagen) {
    	$(".errorimagen").removeClass("d-none");
    	$(".errorimagen").text(data.errors.imagen);
    }
    
	if (data.errors.descricion) {
    	$(".errordescricion").removeClass("d-none");
    	$(".errordescricion").text(data.errors.descricion);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("d-none");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("d-none");
    	$(".errorupdated_at").text(data.errors.updated_at);
    }
    
	if (data.errors.estados_id) {
    	$(".errorestados_id").removeClass("d-none");
    	$(".errorestados_id").text(data.errors.estados_id);
    }
    
	if (data.errors.precio_venta) {
    	$(".errorprecio_venta").removeClass("d-none");
    	$(".errorprecio_venta").text(data.errors.precio_venta);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	const resulestados_id=Foraestados_id.find( cas => cas.id == data.estados_id ); 
		
	
	var url='{{ asset("perfil_usuario/") }}';
	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.codigo_producto+"</td>"+
		"<td>"+ data.nombre+"</td>"+
		"<td>"+ data.descricion+"</td>"+
		"<td>"+
			'<a href="'+url+'/'+data.imagen+'" target="_blank">'+
        		'<img height="40px" src="'+url+'/'+data.imagen+'" width="40px">'+
            	'</img>'+
        	'</a>'+
		"</td>"+
		
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		"<td>"+ resulestados_id["nombre"]  +"</td>"+
		"<td>"+ data.precio_venta+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Productos Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-codigo_producto='"+ data.codigo_producto+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-imagen='"+ data.imagen+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-estados_id='"+ data.estados_id+"'"+
		"data-precio_venta='"+ data.precio_venta+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Productos Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-codigo_producto='"+ data.codigo_producto+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-imagen='"+ data.imagen+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-estados_id='"+ data.estados_id+"'"+
		"data-precio_venta='"+ data.precio_venta+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Productos Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-codigo_producto='"+ data.codigo_producto+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-imagen='"+ data.imagen+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		"data-estados_id='"+ data.estados_id+"'"+
		"data-precio_venta='"+ data.precio_venta+"'"+
		 
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