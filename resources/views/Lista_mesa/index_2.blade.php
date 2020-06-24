@extends('layouts.app_mosnter')

<script type='text/javascript'>
</script>

@section('content')

<style type="text/css">
	.mesa {
		padding-left: 0px;
		padding-right: 0px;
		border-left: 5px solid #009efb !important;
		border: 1px solid rgba(120, 130, 140, 0.13);
	}

	.card-body {
		padding-left: 0px;
		padding-right: 0px;
	}

	.card-header {
		background-color: #55ce63;
	}

	.boton_add {
		margin-top: 7px;
	}
</style>

@foreach($ventas as $lists)

<div class='col-lg-6 card mesa'>
	<!--
        -->

	<blockquote class='mesa blockquote mb-0'>
		<div class='card-header'>{{ $lists->mesa_id_pk->nombre }}</div>
		<div class='card-body'>
			<table class='table table-striped table-bordered table-hover compact nowrap'>
				<tr>
					<th>Productos</th>
					<th>precios</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Operaciones</th>
				</tr>
				<?php $total_mesa=0  ?>
				@foreach ($lists->ventas_has_producto_all as $list )


				<tr>
					<td>{{ $list->producto_id_pk->nombre }}</td>
					<td>{{ $list->producto_id_pk->precio_venta }}</td>
					<td>{{ $list->cantidad }}</td>
					<td>{{ $list->producto_id_pk->precio_venta*$list->cantidad }}</td>

					<td>
						<button type='button' class='btn btn-danger btn-sm'>Eliminar</button>
					</td>
				</tr>
				<?php $total_mesa+=$list->producto_id_pk->precio_venta*$list->cantidad ?>
				@endforeach
				<tr>
					<th>Total</th>
					<td></td>
					<td></td>
					<th>{{ $total_mesa }}</th>
				</tr>
			</table>

		</div>
		<form class="add_productos" id="add_productos">
			<div class='form-group row'>
				<div class='col-lg-6'>
					<label class='control-label' for='descripcion'>nombre:</label>
					<select class="select2 form-control" name='producto_id'>
						<option value=""></option>
						@foreach ($producto as $productos )
						<option value="{{ $productos->id }}">{{ $productos->nombre }}</option>
						@endforeach

					</select>
					<p class='errornombre text-center alert alert-danger d-none'></p>
				</div>
				<div class='col-lg-2'>
					<label class='control-label' for='descripcion'>cantidad:</label>
					<input type='number' name='cantida' class='form-control' value='1' required='required' autofocus />
					<p class='errornombre text-center alert alert-danger d-none'></p>
				</div>
				<div class='col-lg-3'>
					<label class='control-label' for='descripcion'> </label>
					<input type='submit' value='Añadir' class='add_productos form-control btn btn-info ' name='como' />
				</div>
			</div>
		</form>
		<!--
-->
	</blockquote>

</div>

@endforeach



<div class="container">

</div>

<div class='col-lg-12'>
	<div class="row">
	</div>
</div>
<section class="col-lg-12 ">

</section>
<section class="col-lg-12 ">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de Lista_mesa</h3>
		</div>
		<div class="box-body">
			<div class="">
				<div class="panel panel-default">
					<div class="panel-heading">
						<ul>
							<li><i class="fa fa-file-text-o"></i> Acciones</li>
							@can('Lista_mesa Add')
							<button href="#" id="massadd-modal" class="btn btn-success  massmodal massadd">Añadir un
								Lista_mesa</button>
							@endcan
						</ul>
					</div>

					<div class="panel-body" style="overflow-x:auto;">
						<table class="table table-striped table-bordered table-hover compact nowrap" id="myTable">
							<thead>
								<tr>
									<th>id</th>
									<th>nombre</th>
									<th>posicion_x</th>
									<th>posixion_y</th>
									<th>created_at</th>
									<th>updated_at</th>
									<th>Ultima Modificacion</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								@foreach($listmysql as $lists)
								<tr id="item_{{$lists->id}}"" class=" item{{$lists->id}} @if($lists->is_published)
									warning @endif">
									<td class="col1">{{ $lists->id }}</td>
									<td class="col1">{{ $lists->nombre }}</td>
									<td class="col1">{{ $lists->posicion_x }}</td>
									<td class="col1">{{ $lists->posixion_y }}</td>
									<td class="col1">{{ $lists->created_at }}</td>
									<td class="col1">{{ $lists->updated_at }}</td>

									<td>
										<?php if(!$lists->updated_at<0){ ?>
										{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
										<?php } ?>
									</td>
									<td>
										@can('Lista_mesa Show')
										<button class="massshow-modal btn btn-success" data-id="{{ $lists->id}}"
											data-nombre="{{ $lists->nombre}}" data-posicion_x="{{ $lists->posicion_x}}"
											data-posixion_y="{{ $lists->posixion_y}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}">
											<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan
										@can('Lista_mesa Editar')
										<button class="edit-modal btn btn-info" data-id="{{ $lists->id}}"
											data-nombre="{{ $lists->nombre}}" data-posicion_x="{{ $lists->posicion_x}}"
											data-posixion_y="{{ $lists->posixion_y}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"><span
												class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Lista_mesa Eliminar')

										<button class="massdelete-modal btn btn-danger" data-id="{{ $lists->id}}"
											data-nombre="{{ $lists->nombre}}" data-posicion_x="{{ $lists->posicion_x}}"
											data-posixion_y="{{ $lists->posixion_y}}"
											data-created_at="{{ $lists->created_at}}"
											data-updated_at="{{ $lists->updated_at}}"><span
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
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-descripcion"></h4>
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

					<div class='form-group' id='nombre'>
						<label class='control-label' for='descripcion'>nombre:</label>
						<input type='text' name='nombre' class='form-control' id='nombre_mass' maxlength='45' required='required' autofocus>
						<p class='errornombre text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='posicion_x'>
						<label class='control-label' for='descripcion'>posicion_x:</label>
						<input type='text' name='posicion_x' class='form-control' id='posicion_x_mass' maxlength='45'
							required='required' autofocus>
						<p class='errorposicion_x text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='posixion_y'>
						<label class='control-label' for='descripcion'>posixion_y:</label>
						<input type='text' name='posixion_y' class='form-control' id='posixion_y_mass' maxlength='45'
							required='required' autofocus>
						<p class='errorposixion_y text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='created_at'>
						<label class='control-label' for='descripcion'>created_at:</label>
						<input type='text' name='created_at' class='form-control' id='created_at_mass' readonly
							required='required' autofocus>
						<p class='errorcreated_at text-center alert alert-danger d-none'></p>
					</div>

					<div class='form-group' id='updated_at'>
						<label class='control-label' for='descripcion'>updated_at:</label>
						<input type='text' name='updated_at' class='form-control' id='updated_at_mass' readonly
							required='required' autofocus>
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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerra</button>
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


<link href="{{ asset('jQuery-autoComplete-master/jquery.auto-complete.css')}}" rel="stylesheet" />
<script type="text/javascript" src="{{asset('jQuery-autoComplete-master/jquery.auto-complete.min.js')}}"></script>

	
@stop
@section("page-js-script")


<script type='text/javascript'>
	function formatState(state) {
		if (!state.id) {
			return state.text;
		}
		var baseUrl = "/user/pages/images/flags";
		var $state = $(
			'<span><img src="' + baseUrl + '/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' +
			state.text + '</span>'
		);
		return $state;
	};

	$(".js-example-templating").select2({
		templateResult: formatState
	});

	$('input[name="producto"]').autoComplete({
		minChars: 1,
		source: function (term, suggest) {
			term = term.toLowerCase();


			var choices = [
				['Australia', 'au'],
				['Austria', 'at'],
				['Brasil', 'br']
			];
			var suggestions = [];
			for (i = 0; i < choices.length; i++)
				if (~(choices[i][0] + ' ' + choices[i][1]).toLowerCase().indexOf(term)) suggestions.push(
					choices[i]);
			suggest(suggestions);
		},
		renderItem: function (item, search) {
			search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
			var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
			return '<div class="autocomplete-suggestion" data-langname="' + item[0] + '" data-lang="' + item[
				1] + '" data-val="' + search + '"><img src="img/' + item[1] + '.png"> ' + item[0].replace(
				re,
				"<b>$1</b>") + '</div>';
		},
		onSelect: function (e, term, item) {
			alert('Item "' + item.data('langname') + ' (' + item.data('lang') + ')" selected by ' + (e.type ==
				'keydown' ? 'pressing enter' : 'mouse click') + '.');
		}
	});
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
	$(document).on('click', '.massadd', function () {
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
	$(document).on('click', '.massshow-modal', function () {
		obtener_data($(this));
		$('.modal-descripcion').text('Vista de los Datos');
		$('#msdelete').text(' ');
		$('#massModal').modal('show');
		$('#acciones').attr('class', 'btn btn-info hibe');
		$('#acciones').text('Visible');
		$('#acciones').attr('disabled');
	});



	// Editar un registro
	$(document).on('click', '.edit-modal', function () {
		obtener_data($(this));
		id = $('#id_mass').val();
		$('#acciones').attr('class', 'btn btn-warning edit');
		$('#acciones').text('Editar');
		$('.modal-descripcion').text('Editar un Dato');
		$('#massModal').modal('show');
		$('#msdelete').text(' ');
	});

	// Eliminar un registro
	$(document).on('click', '.massdelete-modal', function () {
		$('#id_mass').val($(this).data('id'));
		id = $('#id_mass').val();
		$('#DeleteModal').modal('show');
	});



	//enviar registro para eiminar
	$('.modal-footer').on('click', '.delete', function () {
		$.ajax({
			type: 'DELETE',
			url: 'Lista_mesa/' + id,
			data: {
				'_token': $('input[name=_token]').val(),
			},
			success: function (data) {
				toastr.success('Dato Eliminado!', 'Operacion Exitosa', {
					timeOut: 5000
				});
				$('#item_' + data['id']).remove();

			}
		});
	});


	//enviar registro para añadir
	$('.modal-footer').on('click', '.add', function () {
		$.ajax({
			type: 'POST',
			url: 'Lista_mesa',
			data: $('#formmass').serialize(),
			//data: {

			error: function (jqXHR, text, error) {
				toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {
					timeOut: 5000
				});
			},
			success: function (data) {
				if ((data.errors)) {
					verificar(data);
					//$('#massModal').modal('show');
					toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {
						timeOut: 5000
					});
				} else {
					toastr.success('Operación Exitosa!', 'Datos Guardados', {
						timeOut: 5000
					});
					operaciones(data, 'add');
				}
			},
		});
	});

	$(".add_productos").submit(function () {
		event.preventDefault();
		//var producto_id = this.find('input.producto_id').val();
		//var cantida = this.find('input.cantida').val();
		//alert(producto_id);
		//alert(cantida);
		console.info(this);
		$.ajax({
			type: 'POST',
			url: 'ventas_has_producto',
			data: $('#add_productos').serialize(),
			//data: {

			error: function (jqXHR, text, error) {
				toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {
					timeOut: 5000
				});
			},
			success: function (data) {
				if ((data.errors)) {
					verificar(data);
					//$('#massModal').modal('show');
					toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {
						timeOut: 5000
					});
				} else {

					toastr.success('Operación Exitosa!', 'Datos Guardados', {
						timeOut: 5000
					});
					operaciones(data, 'add');
				}
			},
		});

	});

	$('.boton_add__').on('click', function () {
		//alert("si funcio");
		event.preventDefault();
		//exit();
		console.info(this);
		$.ajax({
			type: 'POST',
			url: 'ventas_has_producto',
			data: $('#formmass').serialize(),
			//data: {

			error: function (jqXHR, text, error) {
				toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {
					timeOut: 5000
				});
			},
			success: function (data) {
				if ((data.errors)) {
					verificar(data);
					//$('#massModal').modal('show');
					toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {
						timeOut: 5000
					});
				} else {

					toastr.success('Operación Exitosa!', 'Datos Guardados', {
						timeOut: 5000
					});
					operaciones(data, 'add');
				}
			},
		});
	});

	//add

	//enviar registro para editar
	$('.modal-footer').on('click', '.edit', function () {
		$.ajax({
			type: 'PUT',
			url: 'Lista_mesa/' + id,
			data: $('#formmass').serialize(),
			error: function (jqXHR, text, error) {
				toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>' + error, {
					timeOut: 5000
				});
			},
			success: function (data) {
				if (data.errors) {
					verificar(data);
					toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {
						timeOut: 5000
					});
					//$('#massModal').modal('show');
				} else {
					toastr.success('Modificación Exitosa Lista_mesa!', 'Datos Modificados', {
						timeOut: 5000
					});
					operaciones(data, 'edit');

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
	function operaciones(data, operacion) {



		var tabla =
			"<tr  id='item_" + data.id + "'  class='item" + data.id + "'>" +
			"<td class='col1'>" + data.id + "</td>" +
			"<td>" + data.nombre + "</td>" +
			"<td>" + data.posicion_x + "</td>" +
			"<td>" + data.posixion_y + "</td>" +
			"<td>" + data.created_at + "</td>" +
			"<td>" + data.updated_at + "</td>" +

			'<td>Ahorra</td><td>' +
			@can('Lista_mesa Show')
		' <button class="massshow-modal btn btn-success"  ' +
		"data-id='" + data.id + "'" +
			"data-nombre='" + data.nombre + "'" +
			"data-posicion_x='" + data.posicion_x + "'" +
			"data-posixion_y='" + data.posixion_y + "'" +
			"data-created_at='" + data.created_at + "'" +
			"data-updated_at='" + data.updated_at + "'" +

			"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  " +
			@endcan

		@can('Lista_mesa Editar')
		" <button class='edit-modal btn btn-info' " +
		"data-id='" + data.id + "'" +
			"data-nombre='" + data.nombre + "'" +
			"data-posicion_x='" + data.posicion_x + "'" +
			"data-posixion_y='" + data.posixion_y + "'" +
			"data-created_at='" + data.created_at + "'" +
			"data-updated_at='" + data.updated_at + "'" +

			"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  " +
			@endcan

		@can('Lista_mesa Eliminar')
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='" + data.id + "'" +
			"data-nombre='" + data.nombre + "'" +
			"data-posicion_x='" + data.posicion_x + "'" +
			"data-posixion_y='" + data.posixion_y + "'" +
			"data-created_at='" + data.created_at + "'" +
			"data-updated_at='" + data.updated_at + "'" +

			"'><span class='glyphicon glyphicon-trash'></span> Eliminar</button>  " +
			@endcan " </td></tr>";

		if ('edit' == operacion) {
			$('#item_' + data.id).replaceWith(tabla);
		}
		if ('add' == operacion) {
			$('#postTable').append(tabla);
		}
	}
</script>
@stop
</body>

</html>