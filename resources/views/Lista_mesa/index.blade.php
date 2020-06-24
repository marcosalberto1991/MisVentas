@extends('layouts.app_admin_ui')
@section('content')
<title>Lista de mesa</title>
<style type="text/css">
	.mesa{
	padding-left: 0px;
    padding-right: 0px;
    border-left: 5px solid #009efb!important;
    border: 1px solid rgba(120, 130, 140, 0.13);
	}
	.card-body{
	padding-left: 0px;
    padding-right: 0px;	
	}
	.card-header{
	background-color: #55ce63;
	}
	.boton_add{
		margin-top: 7px;
	}
	.card-header{
		background-color: #16aaff !important;
	}
	.card-footer{
	background-color: #1783e0 !important;
	}
	.table-borderless{
	background-color: #1783e0 !important;
	}
</style>




		

<div class="app">
	<my-thoughts-component></my-thoughts-component>
</div>


<div class='col-lg-12'>
	<div class="row">
			
	</div>
</div>
<section class="col-lg-12 ">

</section>

@endsection
<style type="text/css">
	.card-header{
		background-color: #16aaff
	}
	.card-footer{
	background-color: #1783e0
	}
	.d-block.text-center.card-footer{
	background-color: #1783e0
		
	}
	.table-borderless{
	background-color: #1783e0
	}
</style>

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
					
					<div class='form-group' id='posicion_x' >
						<label class='control-label' for='descripcion'>posicion_x:</label>
							<input type='text' name='posicion_x' class='form-control' id='posicion_x_mass' maxlength='45'   required='required' autofocus>
							<p class='errorposicion_x text-center alert alert-danger d-none'></p>
					</div>
					
					<div class='form-group' id='posixion_y' >
						<label class='control-label' for='descripcion'>posixion_y:</label>
							<input type='text' name='posixion_y' class='form-control' id='posixion_y_mass' maxlength='45'   required='required' autofocus>
							<p class='errorposixion_y text-center alert alert-danger d-none'></p>
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
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerra</button>
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
    <link href="{{ asset('jQuery-autoComplete-master/jquery.auto-complete.css')}}" rel="stylesheet" />
	<script type="text/javascript" src="{{asset('jQuery-autoComplete-master/jquery.auto-complete.min.js')}}"></script>
@stop	
@section("page-js-script")
<script type='text/javascript'>

</script>

<script type='text/javascript'>
function obtener_data(data) {
	$('#id_mass').val(data.data('id'));
	$('#nombre_mass').val(data.data('nombre'));
	$('#posicion_x_mass').val(data.data('posicion_x'));
	$('#posixion_y_mass').val(data.data('posixion_y'));
	$('#created_at_mass').val(data.data('created_at'));
	$('#updated_at_mass').val(data.data('updated_at'));
	
}
//Añadir un registro
$(document).on('click', '.massadd', function() {
	$('.modal-descripcion').text('Añadir un nuevo registro');
	$('#msdelete').text(' ');

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
		url: 'Lista_mesa/'+id,
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
		url: 'Lista_mesa',
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
		url: 'Lista_mesa/' + id,
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
               	toastr.success('Modificación Exitosa Lista_mesa!', 'Datos Modificados', {timeOut: 5000});
                operaciones(data,'edit');
			
            }
        }
    });
});
</script>


<script type="text/javascript">
function verificar(data) {

	$('.errorid').addClass('hidden');
	$('.errornombre').addClass('hidden');
	$('.errorposicion_x').addClass('hidden');
	$('.errorposixion_y').addClass('hidden');
	$('.errorcreated_at').addClass('hidden');
	$('.errorupdated_at').addClass('hidden');

	if (data.errors.id) {
    	$(".errorid").removeClass("hidden");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.nombre) {
    	$(".errornombre").removeClass("hidden");
    	$(".errornombre").text(data.errors.nombre);
    }
    
	if (data.errors.posicion_x) {
    	$(".errorposicion_x").removeClass("hidden");
    	$(".errorposicion_x").text(data.errors.posicion_x);
    }
    
	if (data.errors.posixion_y) {
    	$(".errorposixion_y").removeClass("hidden");
    	$(".errorposixion_y").text(data.errors.posixion_y);
    }
    
	if (data.errors.created_at) {
    	$(".errorcreated_at").removeClass("hidden");
    	$(".errorcreated_at").text(data.errors.created_at);
    }
    
	if (data.errors.updated_at) {
    	$(".errorupdated_at").removeClass("hidden");
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
		"<td>"+ data.posicion_x+"</td>"+
		"<td>"+ data.posixion_y+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Lista_mesa Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-posicion_x='"+ data.posicion_x+"'"+
		"data-posixion_y='"+ data.posixion_y+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Lista_mesa Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-posicion_x='"+ data.posicion_x+"'"+
		"data-posixion_y='"+ data.posixion_y+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Lista_mesa Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-posicion_x='"+ data.posicion_x+"'"+
		"data-posixion_y='"+ data.posixion_y+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button>  "+
	@endcan
	" </td></tr>";

	if('edit'==operacion){		
		$('#item_'+data.id).replaceWith(tabla);
	}
	if('add'==operacion){
		$('#postTable').append(tabla);
	}
} 
</script>
@stop
</body>
</html>

				
