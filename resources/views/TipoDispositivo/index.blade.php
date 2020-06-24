@extends('layouts.app_mosnter')
<meta name="_token" content="{{ csrf_token() }}"/>


@section("content")
<section class="content">
	<div class="row">
        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
				<h3 class="box-title">TipoDispositivo</h3>
					<button type="button" class="btn btn-success mass-add-modal" data-toggle="modal" data-target=".bd-example-modal-lg">Añadir TipoDispositivo</button>
				@can('TipoDispositivo Add')	
        		@endcan
            </div>

            <div class="box-body">


        		<table id="myTable" class="table display table-striped table-bordered table-hover compact nowrap">
					<thead>						   
						<tr>
							<th>id</th>
							<th>nombre</th>
							<th>created_at</th>
							<th>updated_at</th>
							<th>Ultima Modificacion</th>	<th>Accion</th>		
						</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>

					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
							<td class="col1">{{ $lists->nombre }}</td>
							<td class="col1">{{ $lists->created_at }}</td>
							<td class="col1">{{ $lists->updated_at }}</td>
							
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
						<td>
						@can('TipoDispositivo Show')
						<button class="massshow-modal btn btn-success btn_mass" 
							data-id="{{ $lists->id}}"
								data-nombre="{{ $lists->nombre}}"
								data-created_at="{{ $lists->created_at}}"
								data-updated_at="{{ $lists->updated_at}}"
							
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('TipoDispositivo Editar')
						<button class="edit-modal btn btn-info btn_mass" 
							data-id="{{ $lists->id}}"
								data-nombre="{{ $lists->nombre}}"
								data-created_at="{{ $lists->created_at}}"
								data-updated_at="{{ $lists->updated_at}}"
							
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('TipoDispositivo Eliminar') 
						
						<button class="massdelete-modal btn btn-danger btn_mass"
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
        	</div>
    	</div>
    </div>
</div>
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
							
						<div class='form-group col-sm-12' id='nombre' >
							<label>nombre:</label>
							<input type='text' class='form-control' id='nombre_mass' maxlength='45'   required='required' autofocus>
							<p class='errornombre text-center alert alert-danger hidden'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='created_at' >
							<label>created_at:</label>
							<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
							<p class='errorcreated_at text-center alert alert-danger hidden'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='updated_at' >
							<label>updated_at:</label>
							<input type='text' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
							<p class='errorupdated_at text-center alert alert-danger hidden'></p>
						</div>
							
						                        

					
						</form>
					 </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary button_radio" data-dismiss="modal">Cerra</button>
			        <button type="button" class="btn btn-primary button_radio" id="acciones">Save changes</button>
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

@stop	
@section("page-js-script")		


	<script type='text/javascript'>
		//añadir datos
		$(document).on('click','.mass-add-modal', function() {
			$('.modal-descripcion').text('Añadir un nuevo Dato');
			$('#massModal').modal('show');
			$('#acciones').attr('class', 'btn btn-success add button_radio');
			$('#acciones').text('Añadir Nuevos ');
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
		// delete a registro
		$(document).on('click', '.massdelete-modal', function() {
			$('#DeleteModal').modal('show');
			$('#id_mass').val($(this).data('id'));
			id = $('#id_mass').val();
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'TipoDispositivo/'+id,
				data: {
					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
					toastr.success('Dato Eliminado!', 'Operacion Exitosa', {timeOut: 5000});
					$('#item_' + data['id']).remove();
				
				}
			});
		});
		// add a new post
		$(document).on('click', '.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo registro');
			$('#msdelete').text(' ');

			$('#massmodal').modal('show');
			$('#acciones').attr('class', 'btn btn-success add button_radio');
			//$('#formmass').attr('id', 'form_add');
			$('#acciones').text('Añadir Nuevos ');
		});
		$('.modal-footer').on('click', '.add', function() {
			// add a new post ajax
			$.ajax({
				type: 'POST',
				url: 'TipoDispositivo',
				data: {

				'id': $('#id_mass').val(),
				'nombre': $('#nombre_mass').val(),
				'created_at': $('#created_at_mass').val(),
				'updated_at': $('#updated_at_mass').val(),
				
				'_token': $('input[name=_token]').val(),
				},
				error: function(jqXHR, text, error){
            	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
        		},
				success: function(data) { 
					if ((data.errors)) {
						verificar(data);
            			toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {timeOut: 5000});	
					} else {
						toastr.success('Operación Exitosa!', 'Datos Guardados', {timeOut: 5000});
						operaciones(data,'add');
					}
				},
			});
		});
						
//add

	// edit a post 1
	$(document).on('click', '.edit-modal', function() {
		$("#id_mass").val($(this).data("id"));
		$("#nombre_mass").val($(this).data("nombre"));
		$("#created_at_mass").val($(this).data("created_at"));
		$("#updated_at_mass").val($(this).data("updated_at"));
		
		id = $('#id_mass').val();
		$('#acciones').attr('class', 'btn btn-warning edit button_radio');
		$('#acciones').text('Editar');
		$('.modal-descripcion').text('Editar un Dato');
		$('#massModal').modal('show');
		$('#msdelete').text(' ');
	});
	//edit a post ajax
	$('.modal-footer').on('click', '.edit', function() {
		$.ajax({
			type: 'PUT',
			url: 'TipoDispositivo/' + id,
			data: {
			'id': $('#id_mass').val(),
			'nombre': $('#nombre_mass').val(),
			'created_at': $('#created_at_mass').val(),
			'updated_at': $('#updated_at_mass').val(),
			'_token': $('input[name=_token]').val()
			}, 
			error: function(jqXHR, text, error){
            	toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {

				if(data.errors){
					verificar(data);
            		toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});	
					} else {
                	toastr.success('Modificación Exitosa TipoDispositivo!', 'Datos Modificados', {timeOut: 5000});
                	operaciones(data,'edit');
			

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
	@can('TipoDispositivo Show') 
		" <button class='massshow-modal btn btn-success btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg'  " + 
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('TipoDispositivo Editar')
		" <button class='edit-modal btn btn-info btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg' "+
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('TipoDispositivo Eliminar') 
		"<button class='btn btn-danger delete-Modal btn_mass' data-toggle='modal' data-target='#exampleModal'  " +
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

				
