@extends('layouts.app_mosnter')
<meta name="_token" content="{{ csrf_token() }}"/>


@section("content")
<section class="content">
	<div class="row">
        <div class="col-md-12">

        <div class="box">
            <div class="box-header">
				<h3 class="box-title">Datos de los Dispositivos</h3>
				@can('DatosDispositivo Add')	
					<button type="button" class="btn btn-success mass-add-modal" data-toggle="modal" data-target=".bd-example-modal-lg">Añadir DatosDispositivo</button>
        		@endcan
            </div>

            <div class="box-body">


        		<table id="myTable" class="table display table-striped table-bordered table-hover compact nowrap">
					<thead>						   
						<tr>
							<th>ID</th>
							<th>Nivel de rio</th>
							<th>Velocidad de la corriente</th>
							<th>Temperatura</th>
							<th>Dispositivo</th>
							<th>Ultima Modificacion</th>	<th>Accion</th>		
						</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>

					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
							<td class="col1">{{ $lists->nivel_rio }}</td>
							<td class="col1">{{ $lists->velocidad_corriente }}</td>
							<td class="col1">{{ $lists->temperatura }}</td>
							<td class="col1">{{ $lists->dispositivo_id_pk->nombre }}</td>
							
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
						<td>
						@can('DatosDispositivo Show')
						<button class="massshow-modal btn btn-success btn_mass" 
							data-id="{{ $lists->id}}"
								data-nivel_rio="{{ $lists->nivel_rio}}"
								data-velocidad_corriente="{{ $lists->velocidad_corriente}}"
								data-temperatura="{{ $lists->temperatura}}"
								data-dispositivo_id="{{ $lists->dispositivo_id}}"
							
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('DatosDispositivo Editar')
						<button class="edit-modal btn btn-info btn_mass" 
							data-id="{{ $lists->id}}"
								data-nivel_rio="{{ $lists->nivel_rio}}"
								data-velocidad_corriente="{{ $lists->velocidad_corriente}}"
								data-temperatura="{{ $lists->temperatura}}"
								data-dispositivo_id="{{ $lists->dispositivo_id}}"
							
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('DatosDispositivo Eliminar') 
						
						<button class="massdelete-modal btn btn-danger btn_mass"
							data-id="{{ $lists->id}}"
								data-nivel_rio="{{ $lists->nivel_rio}}"
								data-velocidad_corriente="{{ $lists->velocidad_corriente}}"
								data-temperatura="{{ $lists->temperatura}}"
								data-dispositivo_id="{{ $lists->dispositivo_id}}"
							
						
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
    <div class="col-md-12">
     	<div class="box">
            <div class="box-header">
				<h3 class="box-title">DatosDispositivo</h3>
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
						
						<input type='hidden' class='form-control' id='id_mass' required='required' autofocus>
						
							
						<div class='form-group col-sm-12' id='nivel_rio' >
							<label>nivel_rio:</label>
							<input type='text' class='form-control' id='nivel_rio_mass' maxlength='45'   required='required' autofocus>
							<p class='errornivel_rio text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='velocidad_corriente' >
							<label>velocidad_corriente:</label>
							<input type='text' class='form-control' id='velocidad_corriente_mass' maxlength='45'   required='required' autofocus>
							<p class='errorvelocidad_corriente text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='temperatura' >
							<label>temperatura:</label>
							<input type='text' class='form-control' id='temperatura_mass' maxlength='45'   required='required' autofocus>
							<p class='errortemperatura text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class="form-group col-sm-12">
							<label>dispositivo_id:</label>
								<select class="form-control select2" id="dispositivo_id_mass" required="required" autofocus style="width: 100%;" >
 									<option value=""></option>
 								@foreach($dispositivo_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								</select>
								<!--
								<input type="select" class="form-control" id=dispositivo_id_mass" required="required" autofocus>
								-->
								<p class="errordispositivo_id text-center alert alert-danger d-none"> llenar los datos</p>
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
			$('#nivel_rio_mass').val($(this).data('nivel_rio'));
			$('#velocidad_corriente_mass').val($(this).data('velocidad_corriente'));
			$('#temperatura_mass').val($(this).data('temperatura'));
			$('#dispositivo_id_mass').val($(this).data('dispositivo_id'));
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
				url: 'DatosDispositivo/'+id,
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
				url: 'DatosDispositivo',
				data: {

				'id': $('#id_mass').val(),
				'nivel_rio': $('#nivel_rio_mass').val(),
				'velocidad_corriente': $('#velocidad_corriente_mass').val(),
				'temperatura': $('#temperatura_mass').val(),
				'dispositivo_id': $('#dispositivo_id_mass').val(),
				
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
		$("#nivel_rio_mass").val($(this).data("nivel_rio"));
		$("#velocidad_corriente_mass").val($(this).data("velocidad_corriente"));
		$("#temperatura_mass").val($(this).data("temperatura"));
		$("#dispositivo_id_mass").val($(this).data("dispositivo_id"));
		
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
			url: 'DatosDispositivo/' + id,
			data: {
			'id': $('#id_mass').val(),
			'nivel_rio': $('#nivel_rio_mass').val(),
			'velocidad_corriente': $('#velocidad_corriente_mass').val(),
			'temperatura': $('#temperatura_mass').val(),
			'dispositivo_id': $('#dispositivo_id_mass').val(),
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
                	toastr.success('Modificación Exitosa DatosDispositivo!', 'Datos Modificados', {timeOut: 5000});
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
	$('.errornivel_rio').addClass('d-none');
	$('.errorvelocidad_corriente').addClass('d-none');
	$('.errortemperatura').addClass('d-none');
	$('.errordispositivo_id').addClass('d-none');

	if (data.errors.id) {
    	$(".errorid").removeClass("d-none");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.nivel_rio) {
    	$(".errornivel_rio").removeClass("d-none");
    	$(".errornivel_rio").text(data.errors.nivel_rio);
    }
    
	if (data.errors.velocidad_corriente) {
    	$(".errorvelocidad_corriente").removeClass("d-none");
    	$(".errorvelocidad_corriente").text(data.errors.velocidad_corriente);
    }
    
	if (data.errors.temperatura) {
    	$(".errortemperatura").removeClass("d-none");
    	$(".errortemperatura").text(data.errors.temperatura);
    }
    
	if (data.errors.dispositivo_id) {
    	$(".errordispositivo_id").removeClass("d-none");
    	$(".errordispositivo_id").text(data.errors.dispositivo_id);
    }
    

}
</script>



<script type='text/javascript'>
	function operaciones(data,operacion) {
	
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ data.nivel_rio+"</td>"+
		"<td>"+ data.velocidad_corriente+"</td>"+
		"<td>"+ data.temperatura+"</td>"+
		"<td>"+ data.dispositivo_id+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('DatosDispositivo Show') 
		" <button class='massshow-modal btn btn-success btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg'  " + 
		"data-id='"+ data.id+"'"+
		"data-nivel_rio='"+ data.nivel_rio+"'"+
		"data-velocidad_corriente='"+ data.velocidad_corriente+"'"+
		"data-temperatura='"+ data.temperatura+"'"+
		"data-dispositivo_id='"+ data.dispositivo_id+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('DatosDispositivo Editar')
		" <button class='edit-modal btn btn-info btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg' "+
		"data-id='"+ data.id+"'"+
		"data-nivel_rio='"+ data.nivel_rio+"'"+
		"data-velocidad_corriente='"+ data.velocidad_corriente+"'"+
		"data-temperatura='"+ data.temperatura+"'"+
		"data-dispositivo_id='"+ data.dispositivo_id+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('DatosDispositivo Eliminar') 
		"<button class='btn btn-danger delete-Modal btn_mass' data-toggle='modal' data-target='#exampleModal'  " +
		"data-id='"+ data.id+"'"+
		"data-nivel_rio='"+ data.nivel_rio+"'"+
		"data-velocidad_corriente='"+ data.velocidad_corriente+"'"+
		"data-temperatura='"+ data.temperatura+"'"+
		"data-dispositivo_id='"+ data.dispositivo_id+"'"+
		 
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

				
