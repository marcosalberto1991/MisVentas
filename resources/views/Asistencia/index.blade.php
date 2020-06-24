@extends('layouts.app')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">
<meta name="_token" content="{{ csrf_token() }}"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
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
			  <h3 class="box-descripcion">Lista de Asistencia</h3>
			</div>          
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> Acciones</li>
					@can('Asistencias Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Asistencia</li></a>
					@endcan
				</ul>
			</div>
			<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover compact nowrap" id="postTable">
						<thead>
							<tr>
		<th>Codigo de arbol</th>
		<th>Consecutivo</th>
		<th>Estado</th>
		<th>Usuario</th>
		<th>Vereda</th>
		<th>Telefono</th>
		<th>Concepto</th>
		<th>Agricola</th>
		<th>Pecuaria</th>
		<th>Forestal</th>
		<th>Ambiental</th>
		<th>Asistencia</th>
		<th>Dianosticos</th>
		<th>Recomendaciones</th>
		<th>usuario Datman</th>
		<th>Foto de arbol</th>
		<th>Creado en</th>
		<th>Modificado en</th>
		<th>Ultima Modificacion</th><th>Accion</th>

		</tr>
		{{ csrf_field() }}
		</thead>
		<tbody>


		@foreach($listmysql as $lists)
						  
		<tr class="item{{$lists->id}} @if($lists->is_published) warning @endif">
	
		<td class="col1">{{ $lists->arbol_id }}</td>
		<td class="col1">{{ $lists->consecutivo }}</td>
		<td class="col1">
		<script type="text/javascript">
			resulmunicipios_id=Foraasistencias_estado_id.find( cas => cas.id == {{ $lists->asistencias_estado_id }} );
			document.write(resulmunicipios_id.nombre); 
		</script>
		</td>
		
		<td class="col1">{{ $lists->usuario_pk->name }}</td>
		<td class="col1">{{ $lists->vereda }}</td>
		<td class="col1">{{ $lists->arboles_pk->codigo }}</td>
		<td class="col1">{{ $lists->telefono }}</td>
		<td class="col1">{{ $lists->concepto }}</td>
		<td class="col1">{{ $lists->agricola }}</td>
		<td class="col1">{{ $lists->pecuaria }}</td>
		<td class="col1">{{ $lists->forestal }}</td>
		<td class="col1">{{ $lists->ambiental }}</td>
		<td class="col1">{{ $lists->dianosticos }}</td>
		<td class="col1">{{ $lists->recomendaciones }}</td>
		<td class="col1">{{ $lists->usuario_pk->name }}</td>
		<td class="col1">
			<a target="_blank" href="{{ asset('../storage/app/intervenir/'.$lists->archivo) }}">
				<img src="{{ asset('../storage/app/intervenir/'.$lists->archivo) }}" width="40px" height="40px" >
		</td>
		<td class="col1">{{ $lists->created_at }}</td>
		<td class="col1">{{ $lists->updated_at }}</td>
		
									
									

<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
<td>
		<a class=" btn btn-info" href="{{ action('AsistenciaController@Pdf',['id' => $lists->id]) }}" target="_blank"> 
		<span class="glyphicon glyphicon-trash"></span>Ver PDF</a>

	@if($lists->asistencias_estado_id==1)
		<button class=" btn btn-info" 
		 onclick="aprobar({{$lists->id}})"  
		><span class="glyphicon glyphicon-trash"></span>Aprobar la asistencia</button>
	@endif

	@can('Asistencia Show')
			<button class="massshow-modal btn btn-success" 
			data-id="{{ $lists->id}}"
			data-consecutivo="{{ $lists->consecutivo}}"
			data-arbol_id="{{ $lists->arbol_id}}"
			data-asistencias_estado_id="{{ $lists->asistencias_estado_id}}"
			data-usuario_id="{{ $lists->usuario_id}}"
			data-vereda="{{ $lists->vereda}}"
			data-telefono="{{ $lists->telefono}}"
			data-concepto="{{ $lists->concepto}}"
			data-agricola="{{ $lists->agricola}}"
			data-pecuaria="{{ $lists->pecuaria}}"
			data-forestal="{{ $lists->forestal}}"
			data-ambiental="{{ $lists->ambiental}}"
			data-dianosticos="{{ $lists->dianosticos}}"
			data-recomendaciones="{{ $lists->recomendaciones}}"
			data-usuario_umata="{{ $lists->usuario_umata}}"
			data-created_at="{{ $lists->created_at}}"
			data-updated_at="{{ $lists->updated_at}}"

			
			>
			<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
	@endcan		
	@can('Asistencia Editar')
			<button class="edit-modal btn btn-info" 
			data-id="{{ $lists->id}}"
			data-consecutivo="{{ $lists->consecutivo}}"
			data-arbol_id="{{ $lists->arbol_id}}"
			data-asistencias_estado_id="{{ $lists->asistencias_estado_id}}"
			data-usuario_id="{{ $lists->usuario_id}}"
			data-vereda="{{ $lists->vereda}}"
			data-telefono="{{ $lists->telefono}}"
			data-concepto="{{ $lists->concepto}}"
			data-agricola="{{ $lists->agricola}}"
			data-pecuaria="{{ $lists->pecuaria}}"
			data-forestal="{{ $lists->forestal}}"
			data-ambiental="{{ $lists->ambiental}}"
			data-dianosticos="{{ $lists->dianosticos}}"
			data-recomendaciones="{{ $lists->recomendaciones}}"
			data-usuario_umata="{{ $lists->usuario_umata}}"
			data-created_at="{{ $lists->created_at}}"
			data-updated_at="{{ $lists->updated_at}}"

			
			><span class="glyphicon glyphicon-edit"></span> Editar</button>
	@endcan
	@can('Asistencia Eliminar') 
			
			<button class="massdelete-modal btn btn-danger"
			data-id="{{ $lists->id}}"
			data-consecutivo="{{ $lists->consecutivo}}"
			data-arbol_id="{{ $lists->arbol_id}}"
			data-asistencias_estado_id="{{ $lists->asistencias_estado_id}}"
			data-usuario_id="{{ $lists->usuario_id}}"
			data-vereda="{{ $lists->vereda}}"
			data-telefono="{{ $lists->telefono}}"
			data-concepto="{{ $lists->concepto}}"
			data-agricola="{{ $lists->agricola}}"
			data-pecuaria="{{ $lists->pecuaria}}"
			data-forestal="{{ $lists->forestal}}"
			data-ambiental="{{ $lists->ambiental}}"
			data-dianosticos="{{ $lists->dianosticos}}"
			data-recomendaciones="{{ $lists->recomendaciones}}"
			data-usuario_umata="{{ $lists->usuario_umata}}"
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

<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-codigo">Lista de Arboles con asistencias</h3>
        </div>
        <div class="box-body">
            <div class="">
               <div id="floating-panel">
    			</div>
      
                <div id="map"></div>
            </div><!-- /.panel-body -->
        </div><!-- /.panel panel-default -->
    </div>
</section>

<style>
	#map {
        height: 100%;
    }
    html, body {
    	height: 100%;
        margin: 0;
        padding: 0;
    }
</style>

 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWVmumfMZzD3VNw8RBjpoBt9RKfv7w8Wk&callback=initMap">
    </script>


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
					<form class="form-horizontal" id="formmass"  method="POST" role="form" accept-charset="UTF-8" enctype="multipart/form-data">
						<input type="hidden" class="form-control" id="id_mass"  disabled>
								<input type='hidden' class='form-control' id='arbol_id_mass' required='required' autofocus>
						<div class='form-group' id='consecutivo' >
							<label class='control-label col-sm-2' for='descripcion'>Consecutivo:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='consecutivo_mass'  readonly maxlength='11'   required='required' autofocus>
								<p class='errorconsecutivo text-center alert alert-danger hidden'></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">Estado de asistencia:</label>
							<div class="col-sm-10">	
								<select class="form-control" id="asistencias_estado_id_mass" required="required" autofocus >
 									<option value=""></option>
 								@foreach($asistencias_estado_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								</select>
								<p class="errorasistencias_estado_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
							<input type='hidden' value="<?=auth()->user()->id;?>" class='form-control' id='usuario_id_mass' maxlength='11'   required='required' autofocus>
								<p class='errorusuario_id text-center alert alert-danger hidden'></p>
								
						<div class='form-group' id='vereda' >
							<label class='control-label col-sm-2' for='descripcion'>Vereda:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='vereda_mass' maxlength='100'   required='required' autofocus>
								<p class='errorvereda text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='telefono' >
							<label class='control-label col-sm-2' for='descripcion'>Telefono:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control input-number' id='telefono_mass' maxlength='14'   required='required' autofocus>
								<p class='errortelefono text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='concepto' >
							<label class='control-label col-sm-2' for='descripcion'>Concepto:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='concepto_mass' maxlength='300'   required='required' autofocus>
								<p class='errorconcepto text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='agricola' >
							<label class='control-label col-sm-2' for='descripcion'>Agricola:</label>
							<div class='col-sm-10'>
								<select class="form-control" id="agricola_mass" required="required" autofocus >
 									<option value="No">No</option>
 									<option value="Si">Si</option>
 								</select>
								<p class='erroragricola text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='pecuaria' >
							<label class='control-label col-sm-2' for='descripcion'>Pecuaria:</label>
							<div class='col-sm-10'>
								<select class="form-control" id="pecuaria_mass" required="required" autofocus >
 									<option value="No">No</option>
 									<option value="Si">Si</option>
 								</select>
								<p class='errorpecuaria text-center alert alert-danger hidden'></p>
							</div>
						</div>
						<div class='form-group' id='forestal' >
							<label class='control-label col-sm-2' for='descripcion'>Forestal:</label>
							<div class='col-sm-10'>
								<select class="form-control" id="forestal_mass" required="required" autofocus >
 									<option value="No">No</option>
 									<option value="Si">Si</option>
 								</select>
								<p class='errorforestal text-center alert alert-danger hidden'></p>
							</div>
						</div>
						<div class='form-group' id='ambiental' >
							<label class='control-label col-sm-2' for='descripcion'>Ambiental:</label>
							<div class='col-sm-10'>
							<select class="form-control" id="ambiental_mass" required="required" autofocus >
 									<option value="No">No</option>
 									<option value="Si">Si</option>
 								</select>
								<p class='errorambiental text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='dianosticos' >
							<label class='control-label col-sm-2' for='descripcion'>Dianosticos:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='dianosticos_mass' maxlength='300'   required='required' autofocus>
								<p class='errordianosticos text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='recomendaciones' >
							<label class='control-label col-sm-2' for='descripcion'>Recomendaciones:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='recomendaciones_mass' maxlength='300'   required='required' autofocus>
								<p class='errorrecomendaciones text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
							<input type='hidden' class='form-control' id='usuario_umata_mass' maxlength='11'   required='required' autofocus>

						<div class='form-group' id='fotodetalle' >
							<label class='control-label col-sm-2' for='descripcion'>Foto de arbol:</label>
							<div class='col-sm-10'>
								<!--
								<input type='text' class='form-control' id='archivo_mass' maxlength='45'   required='required' autofocus>
								-->
								<input type='file' class='form-control' id='archivo_mass' maxlength='45'  name="archivo_mass"  required='required' autofocus>
								<p class='errorarchivo_mass text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='created_at' >
							<label class='control-label col-sm-2' for='descripcion'>Creado en:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='updated_at' >
							<label class='control-label col-sm-2' for='descripcion'>Modificado en:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
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

	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	{{-- <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script> --}}
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
	<script>
		

	

function aprobar(id) {
	$.ajax({
		type: 'post',
		url: '../aprobar',
		data: {
			'id':id,
			'_token': $('input[name=_token]').val(),
		},
		error: function(jqXHR, text, error){
    	toastr.error('Validation error!', 'No se pudo Aproba la asistencia<br>'+error, {timeOut: 5000});
		},
		success: function(data) {
			toastr.success('Asistencias Aprobada!', 'Operacion exitosa', {timeOut: 5000});
			//$('.item' + data['id']).remove();
			//$('.col1').each(function (index) {
			//	$(this).html(index+1);
			//});
		}
	});
	
}
	</script>

			
<script type='text/javascript'>
	<?php echo "const  Foraasistencias_estado_id= $asistencias_estado_id;"; ?>
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
	$('#consecutivo_mass').val($(this).data('consecutivo'));
	$('#asistencias_estado_id_mass').val($(this).data('asistencias_estado_id'));
	$('#usuario_id_mass').val($(this).data('usuario_id'));
	$('#vereda_mass').val($(this).data('vereda'));
	$('#telefono_mass').val($(this).data('telefono'));
	$('#concepto_mass').val($(this).data('concepto'));
	$('#agricola_mass').val($(this).data('agricola'));
	$('#pecuaria_mass').val($(this).data('pecuaria'));
	$('#forestal_mass').val($(this).data('forestal'));
	$('#ambiental_mass').val($(this).data('ambiental'));
	$('#dianosticos_mass').val($(this).data('dianosticos'));
	$('#recomendaciones_mass').val($(this).data('recomendaciones'));
	$('#usuario_umata_mass').val($(this).data('usuario_umata'));
	$('#created_at_mass').val($(this).data('created_at'));
	$('#updated_at_mass').val($(this).data('updated_at'));
			
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
	$('#consecutivo_mass').val($(this).data('consecutivo'));
	$('#asistencias_estado_id_mass').val($(this).data('asistencias_estado_id'));
	$('#usuario_id_mass').val($(this).data('usuario_id'));
	$('#vereda_mass').val($(this).data('vereda'));
	$('#telefono_mass').val($(this).data('telefono'));
	$('#concepto_mass').val($(this).data('concepto'));
	$('#agricola_mass').val($(this).data('agricola'));
	$('#pecuaria_mass').val($(this).data('pecuaria'));
	$('#forestal_mass').val($(this).data('forestal'));
	$('#ambiental_mass').val($(this).data('ambiental'));
	$('#dianosticos_mass').val($(this).data('dianosticos'));
	$('#recomendaciones_mass').val($(this).data('recomendaciones'));
	$('#usuario_umata_mass').val($(this).data('usuario_umata'));
	$('#created_at_mass').val($(this).data('created_at'));
	$('#updated_at_mass').val($(this).data('updated_at'));
	
	$('#massModal').modal('show');
	id = $('#id_mass').val();           
	$('#acciones').attr('class', 'btn btn-danger delete');
	$('#acciones').text('Delete');
});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Asistencia/'+id,
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

		
var formData = new FormData($("#formmass")[0]);
formData.append('id',$('#id_mass').val());
formData.append('arbol_id',$('#arbol_id').val());
formData.append('asistencias_estado_id',$('#asistencias_estado_id_mass').val());
formData.append('usuario_id',$('#usuario_id_mass').val());
formData.append('vereda',$('#vereda_mass').val());
formData.append('consecutivo',$('#consecutivo_mass').val());
formData.append('telefono',$('#telefono_mass').val());
formData.append('concepto',$('#concepto_mass').val());
formData.append('agricola',$('#agricola_mass').val());
formData.append('pecuaria',$('#pecuaria_mass').val());
formData.append('forestal',$('#forestal_mass').val());
formData.append('ambiental',$('#ambiental_mass').val());
formData.append('dianosticos',$('#dianosticos_mass').val());
formData.append('recomendaciones',$('#recomendaciones_mass').val());
formData.append('usuario_umata',$('#usuario_umata_mass').val());
formData.append('_token',$('input[name=_token]').val());





$.ajax({
	type: 'POST',
	url: 'Asistencia',
	data: formData,
	cache: false,
	contentType: false,
	processData: false,

	error: function(jqXHR, text, error){
	toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});
	},
	success: function(data) { 
		$('.errorid').addClass('hidden');
		$('.errorconsecutivo').addClass('hidden');
		$('.errorasistencias_estado_id').addClass('hidden');
		$('.errorusuario_id').addClass('hidden');
		$('.errorvereda').addClass('hidden');
		$('.errortelefono').addClass('hidden');
		$('.errorconcepto').addClass('hidden');
		$('.erroragricola').addClass('hidden');
		$('.errorpecuaria').addClass('hidden');
		$('.errorforestal').addClass('hidden');
		$('.errorambiental').addClass('hidden');
		$('.errordianosticos').addClass('hidden');
		$('.errorrecomendaciones').addClass('hidden');
		$('.errorusuario_umata').addClass('hidden');
		$('.errorcreated_at').addClass('hidden');
		$('.errorupdated_at').addClass('hidden');;
	if((data.errors)) {
			setTimeout(function () {
			$('#massModal').modal('show');
			toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
	}, 500);
	if(data.errors.id){
		$('.errorid').removeClass('hidden');
		$('.errorid').text(data.errors.id);
	}
	if(data.errors.consecutivo){
		$('.errorconsecutivo').removeClass('hidden');
		$('.errorconsecutivo').text(data.errors.consecutivo);
	}
	if(data.errors.asistencias_estado_id){$('.errorasistencias_estado_id').removeClass('hidden');$('.errorasistencias_estado_id').text(data.errors.asistencias_estado_id);
	//}if(data.errors.barrio_id){$('.errorbarrio_id').removeClass('hidden');$('.errorbarrio_id').text(data.errors.barrio_id);
	}
	if(data.errors.usuario_id){
		$('.errorusuario_id').removeClass('hidden');
		$('.errorusuario_id').text(data.errors.usuario_id);
	}
	if(data.errors.vereda){
		$('.errorvereda').removeClass('hidden');
		$('.errorvereda').text(data.errors.vereda);
	}if(data.errors.telefono){$('.errortelefono').removeClass('hidden');$('.errortelefono').text(data.errors.telefono);
	}if(data.errors.concepto){$('.errorconcepto').removeClass('hidden');$('.errorconcepto').text(data.errors.concepto);
	}if(data.errors.agricola){$('.erroragricola').removeClass('hidden');$('.erroragricola').text(data.errors.agricola);
	}if(data.errors.pecuaria){$('.errorpecuaria').removeClass('hidden');$('.errorpecuaria').text(data.errors.pecuaria);
	}if(data.errors.forestal){$('.errorforestal').removeClass('hidden');$('.errorforestal').text(data.errors.forestal);
	}if(data.errors.ambiental){$('.errorambiental').removeClass('hidden');$('.errorambiental').text(data.errors.ambiental);
	}if(data.errors.dianosticos){$('.errordianosticos').removeClass('hidden');$('.errordianosticos').text(data.errors.dianosticos);
	}if(data.errors.recomendaciones){$('.errorrecomendaciones').removeClass('hidden');$('.errorrecomendaciones').text(data.errors.recomendaciones);
	}if(data.errors.usuario_umata){$('.errorusuario_umata').removeClass('hidden');$('.errorusuario_umata').text(data.errors.usuario_umata);
	}if(data.errors.created_at){$('.errorcreated_at').removeClass('hidden');$('.errorcreated_at').text(data.errors.created_at);
	}if(data.errors.updated_at){$('.errorupdated_at').removeClass('hidden');$('.errorupdated_at').text(data.errors.updated_at);
	};
		} else {
	toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						
						
//add
const resulasistencias_estado_id=Foraasistencias_estado_id.find( cas => cas.id == data.asistencias_estado_id ); 
				//const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
				var url='{{ asset("../storage/app/intervenir/") }}';

							$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			
						"<td>"+ data.arbol_id+"</td>"+
						"<td>"+ data.consecutivo+"</td>"+
						"<td>"+ resulasistencias_estado_id["nombre"]  +"</td>"+
						//"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
						"<td>"+ data.usuario_id_pk.name+"</td>"+
						"<td>"+ data.vereda+"</td>"+
						"<td>"+ data.arbol_id_pk.codigo+"</td>"+
						
						"<td>"+ data.telefono+"</td>"+
						"<td>"+ data.concepto+"</td>"+
						"<td>"+ data.agricola+"</td>"+
						"<td>"+ data.pecuaria+"</td>"+
						"<td>"+ data.forestal+"</td>"+
						"<td>"+ data.ambiental+"</td>"+
						"<td>"+ data.dianosticos+"</td>"+
						"<td>"+ data.recomendaciones+"</td>"+
						"<td>"+ data.usuario_umata_pk.name+"</td>"+
						"<td class='col1'>"+
							'<a href="'+url+'/'+data.archivo+'" target="_blank">'+
			        			'<img src="'+url+'/'+data.archivo+'" width="40px" height="40px" >'+
			            		'</img>'+
			        		'</a>'+
						"</td>"+
						"<td>"+ data.created_at+"</td>"+
						"<td>"+ data.updated_at+"</td>"+
			
						'  <td>Ahorra</td><td> '+
			
						'<a class=" btn btn-info" href="Asistencia/'+data.id+'/Pdf" target="_blank">'+
			'<span class="glyphicon glyphicon-trash"></span>Ver PDF</a>'+

				@can('Asistencia Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
			//			"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Asistencia Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
			//			"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Asistencia Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
			//			"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+   
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
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
			$("#consecutivo_mass").val($(this).data("consecutivo"));
			$("#asistencias_estado_id_mass").val($(this).data("asistencias_estado_id"));
		//	$("#barrio_id_mass").val($(this).data("barrio_id"));
			$("#usuario_id_mass").val($(this).data("usuario_id"));
			$("#vereda_mass").val($(this).data("vereda"));
			$("#telefono_mass").val($(this).data("telefono"));
			$("#concepto_mass").val($(this).data("concepto"));
			$("#agricola_mass").val($(this).data("agricola"));
			$("#pecuaria_mass").val($(this).data("pecuaria"));
			$("#forestal_mass").val($(this).data("forestal"));
			$("#ambiental_mass").val($(this).data("ambiental"));
			$("#dianosticos_mass").val($(this).data("dianosticos"));
			$("#recomendaciones_mass").val($(this).data("recomendaciones"));
			$("#usuario_umata_mass").val($(this).data("usuario_umata"));
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

			var formData = new FormData($("#formmass")[0]);
			formData.append('id',$('#id_mass').val());
			//formData.append('arbol_id',$('#arbol_id_mass').val());
			formData.append('asistencias_estado_id',$('#asistencias_estado_id_mass').val());
			formData.append('usuario_id',$('#usuario_id_mass').val());
			formData.append('vereda',$('#vereda_mass').val());
			formData.append('consecutivo',$('#consecutivo_mass').val());
			formData.append('telefono',$('#telefono_mass').val());
			formData.append('concepto',$('#concepto_mass').val());
			formData.append('agricola',$('#agricola_mass').val());
			formData.append('pecuaria',$('#pecuaria_mass').val());
			formData.append('forestal',$('#forestal_mass').val());
			formData.append('ambiental',$('#ambiental_mass').val());
			formData.append('dianosticos',$('#dianosticos_mass').val());
			formData.append('recomendaciones',$('#recomendaciones_mass').val());
			formData.append('usuario_umata',$('#usuario_umata_mass').val());
			formData.append('_token',$('input[name=_token]').val());

				$.ajax({
					type: 'Post',
					url: 'Asistencia_edit_index/' + id,
					data: formData,
					cache: false,
            		contentType: false,
            		processData: false,
			 
			error: function(jqXHR, text, error){
            toastr.error('Validation error!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});	
        	},
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errorconsecutivo').addClass('hidden');
			$('.errorasistencias_estado_id').addClass('hidden');
		//	$('.errorbarrio_id').addClass('hidden');
			$('.errorusuario_id').addClass('hidden');
			$('.errorvereda').addClass('hidden');
			$('.errortelefono').addClass('hidden');
			$('.errorconcepto').addClass('hidden');
			$('.erroragricola').addClass('hidden');
			$('.errorpecuaria').addClass('hidden');
			$('.errorforestal').addClass('hidden');
			$('.errorambiental').addClass('hidden');
			$('.errordianosticos').addClass('hidden');
			$('.errorrecomendaciones').addClass('hidden');
			$('.errorusuario_umata').addClass('hidden');
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
				if (data.errors.consecutivo) {
                	$(".error.consecutivo").removeClass("hidden");
                	$(".error.consecutivo").text(data.errorsconsecutivo);
                }
				if (data.errors.asistencias_estado_id) {
                	$(".error.asistencias_estado_id").removeClass("hidden");
                	$(".error.asistencias_estado_id").text(data.errorsasistencias_estado_id);
                }
                /*
				if (data.errors.barrio_id) {
                	$(".error.barrio_id").removeClass("hidden");
                	$(".error.barrio_id").text(data.errorsbarrio_id);
                }
                */
				if (data.errors.usuario_id) {
                	$(".error.usuario_id").removeClass("hidden");
                	$(".error.usuario_id").text(data.errorsusuario_id);
                }
				if (data.errors.vereda) {
                	$(".error.vereda").removeClass("hidden");
                	$(".error.vereda").text(data.errorsvereda);
                }
				if (data.errors.telefono) {
                	$(".error.telefono").removeClass("hidden");
                	$(".error.telefono").text(data.errorstelefono);
                }
				if (data.errors.concepto) {
                	$(".error.concepto").removeClass("hidden");
                	$(".error.concepto").text(data.errorsconcepto);
                }
				if (data.errors.agricola) {
                	$(".error.agricola").removeClass("hidden");
                	$(".error.agricola").text(data.errorsagricola);
                }
				if (data.errors.pecuaria) {
                	$(".error.pecuaria").removeClass("hidden");
                	$(".error.pecuaria").text(data.errorspecuaria);
                }
				if (data.errors.forestal) {
                	$(".error.forestal").removeClass("hidden");
                	$(".error.forestal").text(data.errorsforestal);
                }
				if (data.errors.ambiental) {
                	$(".error.ambiental").removeClass("hidden");
                	$(".error.ambiental").text(data.errorsambiental);
                }
				if (data.errors.dianosticos) {
                	$(".error.dianosticos").removeClass("hidden");
                	$(".error.dianosticos").text(data.errorsdianosticos);
                }
				if (data.errors.recomendaciones) {
                	$(".error.recomendaciones").removeClass("hidden");
                	$(".error.recomendaciones").text(data.errorsrecomendaciones);
                }
				if (data.errors.usuario_umata) {
                	$(".error.usuario_umata").removeClass("hidden");
                	$(".error.usuario_umata").text(data.errorsusuario_umata);
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
                	toastr.success('Successfully updated Asistencia!', 'Success Alert', {timeOut: 5000});
                //update

			const resulasistencias_estado_id=Foraasistencias_estado_id.find( cas => cas.id == data.asistencias_estado_id ); 
				//const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
				var url='{{ asset("../storage/app/intervenir/") }}';

				$('.item' + data.id).replaceWith(
				"<tr class='item"+data.id+"'>"+
				
				"<td>"+ data.arbol_id+"</td>"+
				"<td>"+ data.consecutivo+"</td>"+
				"<td>"+ resulasistencias_estado_id["nombre"]  +"</td>"+
				//"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
				"<td>"+ data.usuario_id_pk.name+"</td>"+
				"<td>"+ data.vereda+"</td>"+
				"<td>"+ data.arbol_id_pk.codigo+"</td>"+
				
				"<td>"+ data.telefono+"</td>"+
				"<td>"+ data.concepto+"</td>"+
				"<td>"+ data.agricola+"</td>"+
				"<td>"+ data.pecuaria+"</td>"+
				"<td>"+ data.forestal+"</td>"+
				"<td>"+ data.ambiental+"</td>"+
				"<td>"+ data.dianosticos+"</td>"+
				"<td>"+ data.recomendaciones+"</td>"+
				"<td>"+ data.usuario_umata_pk.name+"</td>"+
				"<td class='col1'>"+
					'<a href="'+url+'/'+data.archivo+'" target="_blank">'+
	        			'<img src="'+url+'/'+data.archivo+'" width="40px" height="40px" >'+
	            		'</img>'+
	        		'</a>'+
				"</td>"+
				"<td>"+ data.created_at+"</td>"+
				"<td>"+ data.updated_at+"</td>"+
				
			'  <td>Ahorra</td><td> '+	

			'<a class=" btn btn-info" href="Asistencia/'+data.id+'/Pdf" target="_blank">'+
			'<span class="glyphicon glyphicon-trash"></span>Ver PDF</a>'+
			
			@can('Asistencia Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
				//		"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Asistencia Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
				//		"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
						"' data-created_at='"+ data.created_at+
						"' data-updated_at='"+ data.updated_at+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Asistencia Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-consecutivo='"+ data.consecutivo+
						"' data-asistencias_estado_id='"+ data.asistencias_estado_id+
				//		"' data-barrio_id='"+ data.barrio_id+
						"' data-usuario_id='"+ data.usuario_id+
						"' data-vereda='"+ data.vereda+
						"' data-telefono='"+ data.telefono+
						"' data-concepto='"+ data.concepto+
						"' data-agricola='"+ data.agricola+
						"' data-pecuaria='"+ data.pecuaria+
						"' data-forestal='"+ data.forestal+
						"' data-ambiental='"+ data.ambiental+
						"' data-dianosticos='"+ data.dianosticos+
						"' data-recomendaciones='"+ data.recomendaciones+
						"' data-usuario_umata='"+ data.usuario_umata+
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

 function initMap(){
      // Map options
      var options = {
        zoom:16,
        center:{lat:4.302314898662877,lng:-74.80926649120488}
      }
      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);
		  var geocoder = new google.maps.Geocoder;
      var infowindow = new google.maps.InfoWindow;
      $('#acciones').attr('class', 'btn btn-success add');
		  $('#acciones').text('Añadir Nuevos ');
      google.maps.Map.prototype.clearMarkers = function() {
        for(var i=0; i<this.markers.length; i++){
          this.markers[i].setMap(null);
        }
      this.markers = new Array();
      };
      google.maps.event.addListener(map, 'click', function(event){
      var coordenadas = event.latLng.toString();
      coordenadas=coordenadas.replace("(","");
      coordenadas=coordenadas.replace(")","");
      var lista=coordenadas.split(",");
      //var direccion =(lista[0],lista[1]);
      console.info(""+coordenadas);
      //var Longitud = 
      nuevosarboles.push(lista[0]);
      //var latitud = 
      nuevosarboles.push(lista[1]);
      // Add marker
      addMarker({coords:event.latLng});
        var latlng = {lat: parseFloat(lista[0]), lng: parseFloat(lista[1])};
        $('.modal-codigo').text('Añadir un nuevo arbol');
        $('#massModal').modal('show');
        //document.f1.f1t1.value = lista[0];
        //document.f1.f1t2.value = lista[1];
        document.addmarcos.latitud_mass.value = lista[0];
        document.addmarcos.longitud_mass.value = lista[1];
      });
      // Array of markers
      var markers = [
       /*
        {
          coords:{lat:4.30382943899662,lng: -74.80794668197632},
          iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
          content:'<h1>Lynn MA</h1>'
        },
        {
          coords:{lat:4.30382943399632,lng:-74.80734663197632},
          content: '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '</div>'+
            '</div>'
        },

        */
        
            @foreach($listmysql as $lists){
            //iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            
            //añadir los doatas de los arboles
            coords:{lat:{{$lists->arboles_pk->latitud}},lng:{{$lists->arboles_pk->longitud}}},
            
            
            //iconImage:'<div>XXXX</div>',
            //alert(conte);
            
            iconImage:'{{asset('imagenes/punto/punto.png')}}',

            //:'<img title="Con filtro verde" class="verde" src="https://download.jqueryui.com/themeroller/images/ui-icons_ff0000_256x240.png">',
            //iconImage:'imagenes/punto/punto.png',
            label: {
              text: '5',
              fontWeight: 'bold',
              fontSize: '12px',
              fontFamily: '"Courier New", Courier,Monospace',
              color: 'white'
            },
            content: '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            //'<h3 id="firstHeading" class="firstHeading">{{$lists->arboles_pk->sobrenombre}} {{$lists->codigo}} </h3>'+
            '<div id="bodyContent">'+
            '<table class="table">'+
            '<tr><td>ID</td><td>{{$lists->id}}</td></tr>'+
            '<tr><td>Codigo</td><td>{{$lists->arboles_pk->codigo}}</td></tr>'+
            '<tr><td>Especie</td><td>{{$lists->arboles_pk->especie_id_pk->nombre}}</td></tr>'+
            '<tr><td>Dirección</td><td>{{$lists->arboles_pk->direccion}}</td></tr>'+
            '<tr><td>Barrio</td><td>{{$lists->arboles_pk->barrio_id_pk->nombre}}</td></tr>'+
            '</table>'+
            '</div>'+
            '<a target="_blank" href="{{ asset('../storage/app/foto_perfil/'.$lists->archivo) }}">'+
			'<img src="{{ asset('../storage/app/foto_perfil/'.$lists->archivo) }}" width="100px" height="100px" ></a>'+
            '</div>'+
                    '<button class="edit-modal btn btn-info"'+ 
                    'data-id="{{$lists->id}}" '+
                    
                    'data-created_at="{{$lists->created_at}}"'+
                    'data-updated_at="{{$lists->updated_at}}">'+
                    
                    
                    '<span class="glyphicon glyphicon-edit"></span> Edit</button>'+
                    
                        
                    '<a class="btn btn-info" href="{{ action('Procesos_DetallesController@index',['id' => $lists->id]) }}" >'+
                    '<span class="glyphicon glyphicon-edit"></span> Ver procesos</a>'
                    
        
        },
            @endforeach
        {
          coords:{lat:42.7762,lng:-71.0773},
          content:'<h1><a href="lat:42.7762,lng:-71.0773"></h1>ubicacion</a>'
        }
      ];

      // Loop through markers
      for(var i = 0;i < markers.length;i++){
        // Add marker
        addMarker(markers[i]);
      }


/*
  */      
     
      
/*
        var flightPlanCoordinates = [
          {lat: 4.3031202, lng: -74.8087473},
          {lat: 4.3011202, lng: -74.8047673},
          {lat: 4.3021202, lng: -74.8027673},

        ];
*/
        
        

     
        //var bermudaTriangle = new google.maps.Polygon({
      



      // Add Marker Function
      function addMarker(props){
        var marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          //icon:props.iconImage
        });

        // Check for customicon
        if(props.iconImage){
          // Set icon image
          marker.setIcon(props.iconImage);
        }

        // Check content
        if(props.content){
          var infoWindow = new google.maps.InfoWindow({
            content:props.content
          });

          marker.addListener('click', function(){
            infoWindow.open(map, marker);
          });
         
        }
      }
    }




	</script>



</body>
</html>










