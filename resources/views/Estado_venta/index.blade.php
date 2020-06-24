@extends('layouts.adminTE')

<script type='text/javascript'>
			</script>

@section('content')
<section class="col-lg-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Estado_venta</h3>
		</div>          
		<div class="box-body">
	   		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<ul>
						<li><i class="fa fa-file-text-o"></i> Acciones</li>
						@can('Estado_venta Add')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un Estado_venta</button>
						@endcan
					</ul>
				</div>

				<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
					<thead>
					   

					<tr>
						<th>id</th>
						<th>nombre</th>
						<th>created_at</th>
						<th>updated_at</th>
						<th>Ultima Modificacion</th><th>Accion</th>
								
					</tr>
					
					</thead>
					<tbody>


					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
						<td class="col1">{{ $lists->nombre }}</td>
						<td class="col1">{{ $lists->created_at }}</td>
						<td class="col1">{{ $lists->updated_at }}</td>
						
						<td>
						<?php if(!$lists->updated_at<"0000-00-00"){ ?> 
							{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
						<?php } ?>
						</td>
						<td>
						@can('Estado_venta Show')
						<button class="massshow-modal btn btn-success" 
						data-id="{{ $lists->id}}"
						data-nombre="{{ $lists->nombre}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('Estado_venta Editar')
						<button class="edit-modal btn btn-info" 
						data-id="{{ $lists->id}}"
						data-nombre="{{ $lists->nombre}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('Estado_venta Eliminar') 
						
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
				<h4 class="modal-descripcion"></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
				<form class="form-horizontal" id="formmass" role="form">
					{{ csrf_field() }}
					<div class="row">
						<div class="col-md-6">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label " for="id">ID:</label>
							<input type="text" class="form-control" id="id_mass"  disabled>
						
					</div>

							<!-- 
					<div class='form-group'>
						<label class='control-label' for='descripcion'>id:</label>
						<div class='col-sm-10'>
						-->
							<input type='hidden' name='id'  class='form-control'    id='id_mass' required='required' autofocus>
						<!--
							<p class='errorid text-center alert alert-danger d-none'></p>
						</div>
					</div>
						-->
						
					<div class='form-group' id='nombre' >
						<label class='control-label' for='descripcion'>nombre:</label>
							<input type='text' name='nombre' class='form-control' id='nombre_mass' maxlength='45'   required='required' autofocus>
							<p class='errornombre text-center alert alert-danger d-none'></p>
					</div>
					
					<div class='form-group' id='created_at' >
						<label class='control-label' for='descripcion'>created_at:</label>
							<input type='text' name='created_at' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
							<p class='errorcreated_at text-center alert alert-danger d-none'></p>
					</div>
					
					<div class='form-group' id='updated_at' >
						<label class='control-label' for='descripcion'>updated_at:</label>
							<input type='text' name='updated_at' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
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


<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title" id="exampleModalLabel">Eliminar el registro</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      		</div>
      		<div class="modal-body">Se eliminar el registro de forma permanete 
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        		<button type="button" class="btn btn-danger delete"  data-dismiss="modal">Eliminar</button>
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
	$('#nombre_mass').val(data.data('nombre'));
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
		url: 'Estado_venta/'+id,
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
		url: 'Estado_venta',
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
		url: 'Estado_venta/' + id,
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
               	toastr.success('Modificación Exitosa Estado_venta!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
function verificar(data) {

	$('.errorid').addClass('d-none');
	$('.errornombre').addClass('d-none');
	$('.errorcreated_at').addClass('d-none');
	$('.errorupdated_at').addClass('d-none');

	if (data.errors.id) {
    	$(".errorid").removeClass("d-none");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.nombre) {
    	$(".errornombre").removeClass("d-none");
    	$(".errornombre").text(data.errors.nombre);
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
	
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.nombre+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Estado_venta Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Estado_venta Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Estado_venta Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
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

				
