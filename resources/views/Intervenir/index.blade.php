@extends('layouts.app')
<meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
            <meta content="" name="description">
                <meta content="" name="author">
                    <!-- Favicon -->
                    <link href="{{ asset('images/favicon.jpg') }}" rel="shortcut icon">
                        <!-- CSFR token for ajax call -->
                        <meta content="{{ csrf_token() }}" name="_token"/>
                        <!-- Bootstrap CSS -->
                        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
                            {{--
                            <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="styleeheet">
                                --}}
                                <!-- icheck checkboxes -->
                                <!--<link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">-->
                                {{--
                                <link href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css" rel="stylesheet">
                                    --}}
                                    <!-- toastr notifications -->
                                    {{--
                                    <link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet">
                                        --}}
                                        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
                                            <!-- Font Awesome -->
                                            {{--
                                            <link href="{{ asset('font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
                                                --}}
                                                <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
                                                    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
                                                        <script type="text/javascript">
                                                            <?php echo "const  Foraarboles_id= $arboles_id;"; ?>
			<?php echo "const  Foratipo_proceso_id= $tipo_proceso_id;"; ?>
			<?php echo "const  Foraestado_id= $estado_id;"; ?>
                                                        </script>
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
<script>
</script>
@section('content')
<section class="col-lg-12 connectedSortable">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-descripcion">
            Lista de Intervenir
         </h3>
      </div>
      <div class="box-body">
         <div class="">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <ul>
                     <li>
                        <i class="fa fa-file-text-o">
                        </i>
                        Acciones
                     </li>
                     <a class="massmodal" href="{{ action('IntervenirController@index') }}" id="">
                        <li>
                           Intervención activo
                        </li>
                     </a>
                     <a class="massmodal" href="{{ action('IntervenirController@arboles_inactivo') }}" id="">
                        <li>
                           Intervención inactivo
                        </li>
                     </a>
                     @can('Intervenir Add_')
                     <a class="massmodal" href="#" id="massadd-modal">
                        <li>
                           Añadir un Intervenir
                        </li>
                     </a>
                     @endcan
                  </ul>
               </div>
               <div class="panel-body" style="overflow-x:auto;">
                  <table class="table table-striped table-bordered table-hover compact nowrap" id="postTable">
                     <thead>
                        <tr>
                           <th>
                              ID
                           </th>
                           <th>
                              Código
                           </th>
                           <th>
                              Numero de récord
                           </th>
                           <th>
                              Foto de récord
                           </th>
                           <th>
                              Tipo de proceso
                           </th>
                           <th>
                              Estado
                           </th>
                           <th>
                              Creado en:
                           </th>
                           <th>
                              Modificado en:
                           </th>
                           <th>
                              Ultima Modificación
                           </th>
                           <th>
                              Accione
                           </th>
                        </tr>
                        {{ csrf_field() }}
                     </thead>
                     <tbody>
                        @foreach($listmysql as $lists)
                        <tr "="" class="item{{$lists->id}} @if($lists->is_published) warning @endif" id="item_{{$lists->id}}">
                           <td class="col1">
                              {{ $lists->id }}
                           </td>
                           <td class="col1">
                              {{ $lists->arboles_id_pk->codigo }}
                           </td>
                           <td class="col1">
                              {{ $lists->numero_record }}
                           </td>
                           <td class="col1">
                              <a href="{{ asset('intervenir/'.$lists->foto_record) }}" target="_blank">
                              <img height="40px" src="{{ asset('intervenir/'.$lists->foto_record) }}" width="40px">
                              </img>
                              </a>
                           </td>
                           <td class="col1">
                              <script type="text/javascript">
                                 resulmunicipios_id=Foratipo_proceso_id.find( cas => cas.id == {{ $lists->tipo_proceso_id }} );
                                 document.write(resulmunicipios_id.nombre);
                              </script>
                           </td>
                           <td class="col1">
                              <script type="text/javascript">
                                 resulmunicipios_id=Foraestado_id.find( cas => cas.id == {{ $lists->estado_id }} );
                                 document.write(resulmunicipios_id.nombre);
                              </script>
                           </td>
                           <td class="col1">
                              {{ $lists->created_at }}
                           </td>
                           <td class="col1">
                              {{ $lists->updated_at }}
                           </td>
                           <td>
                              {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
                           </td>
                           <td>
                              <a class="btn btn-success" href="{{ action('IntervenirController@Lista',['id' => $lists->arboles_id]) }}">
                              <span class="glyphicon glyphicon-eye-open">
                              </span>
                              Ver lista
                              </a>
                              @can('Intervenir _Show')
                              <button class="massshow-modal btn btn-success" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-estado_id="{{ $lists->estado_id}}" data-foto_record="{{ $lists->foto_record}}" data-id="{{ $lists->id}}" data-numero_record="{{ $lists->numero_record}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                              <span class="glyphicon glyphicon-eye-open">
                              </span>
                              Ver
                              </button>
                              @endcan       
                              @can('Intervenir _Editar')
                              <button class="edit-modal btn btn-info" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-estado_id="{{ $lists->estado_id}}" data-foto_record="{{ $lists->foto_record}}" data-id="{{ $lists->id}}" data-numero_record="{{ $lists->numero_record}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                              <span class="glyphicon glyphicon-edit">
                              </span>
                              Editar
                              </button>
                              @endcan
                              @can('Intervenir _Eliminar')
                              <button class="massdelete-modal btn btn-danger" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-estado_id="{{ $lists->estado_id}}" data-foto_record="{{ $lists->foto_record}}" data-id="{{ $lists->id}}" data-numero_record="{{ $lists->numero_record}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                              <span class="glyphicon glyphicon-trash">
                              </span>
                              Eliminar
                              </button>
                              @endcan
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <!-- /.panel-body -->
            </div>
            <!-- /.panel panel-default -->
         </div>
      </div>
   </div>
</section>                                                       
                                                   
@endsection
<!-- Modal form to mass a form -->
<div class="modal fade" id="massModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" type="button">
                    ×
                </button>
                <h4 class="modal-descripcion">
                </h4>
            </div>
            <div class="modal-body">
                <h3 class="text-center" id="msdelete">
                    ¿Seguro que quieres borrar los  datos?
                </h3>
                <form class="form-horizontal" id="formmass" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">
                            ID:
                        </label>
                        <div class="col-sm-10">
                            <input class="form-control" disabled="" id="id_mass" type="text">
                            </input>
                        </div>
                    </div>
                   
                    <input autofocus="" class="form-control" id="id_mass" required="required" type="hidden">
                       
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">
                                Código de Árbol:
                            </label>
                            <div class="col-sm-10">
                                <select autofocus="" class="form-control" id="arboles_id_mass" required="required">
                                    <option value="">
                                    </option>
                                    @foreach($arboles_id as $lists)
                                    <option value="{{$lists->id}}">
                                        {{$lists->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                <!--
								<input type="select" class="form-control" id=arboles_id_mass" required="required" autofocus>
								-->
                                <p class="errorarboles_id text-center alert alert-danger hidden">
                                    llenar los datos
                                </p>
                            </div>
                        </div>
                        <div class="form-group" id="numero_record">
                            <label class="control-label col-sm-2" for="descripcion">
                                numero_record:
                            </label>
                            <div class="col-sm-10">
                                <input autofocus="" class="form-control" id="numero_record_mass" maxlength="10" required="required" type="text">
                                    <p class="errornumero_record text-center alert alert-danger hidden">
                                    </p>
                                </input>
                            </div>
                        </div>
                        <div class="form-group" id="foto_record">
                            <label class="control-label col-sm-2" for="descripcion">
                                foto_record:
                            </label>
                            <div class="col-sm-10">
                                <input autofocus="" class="form-control" id="foto_record_mass" maxlength="30" required="required" type="text">
                                    <p class="errorfoto_record text-center alert alert-danger hidden">
                                    </p>
                                </input>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">
                                tipo_proceso_id:
                            </label>
                            <div class="col-sm-10">
                                <select autofocus="" class="form-control select2 select2-hidden-accessible" id="tipo_proceso_id_mass" required="required">
                                    <option value="">
                                    </option>
                                    @foreach($tipo_proceso_id as $lists)
                                    <option value="{{$lists->id}}">
                                        {{$lists->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                <!--
								<input type="select" class="form-control" id=tipo_proceso_id_mass" required="required" autofocus>
								-->
                                <p class="errortipo_proceso_id text-center alert alert-danger hidden">
                                    llenar los datos
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">
                                estado_id:
                            </label>
                            <div class="col-sm-10">
                                <select autofocus="" class="form-control select2 select2-hidden-accessible" id="estado_id_mass" required="required">
                                    <option value="">
                                    </option>
                                    @foreach($estado_id as $lists)
                                    <option value="{{$lists->id}}">
                                        {{$lists->nombre}}
                                    </option>
                                    @endforeach
                                </select>
                                <!--
								<input type="select" class="form-control" id=estado_id_mass" required="required" autofocus>
								-->
                                <p class="errorestado_id text-center alert alert-danger hidden">
                                    llenar los datos
                                </p>
                            </div>
                        </div>
                        <div class="form-group" id="created_at">
                            <label class="control-label col-sm-2" for="descripcion">
                                created_at:
                            </label>
                            <div class="col-sm-10">
                                <input autofocus="" class="form-control" id="created_at_mass" readonly="" required="required" type="text">
                                    <p class="errorcreated_at text-center alert alert-danger hidden">
                                    </p>
                                </input>
                            </div>
                        </div>
                        <div class="form-group" id="updated_at">
                            <label class="control-label col-sm-2" for="descripcion">
                                updated_at:
                            </label>
                            <div class="col-sm-10">
                                <input autofocus="" class="form-control" id="updated_at_mass" readonly="" required="required" type="text">
                                    <p class="errorupdated_at text-center alert alert-danger hidden">
                                    </p>
                                </input>
                            </div>
                        </div>
                    </input>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-primary mass" data-dismiss="modal" id="acciones" type="button">
                        <span class="glyphicon glyphicon-check">
                        </span>
                        massar
                    </button>
                    <button class="btn btn-warning" data-dismiss="modal" type="button">
                        <span class="glyphicon glyphicon-remove">
                        </span>
                        Cerra
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@section("page-js-files")
<!--
-->
<script crossorigin="anonymous" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" src="https://code.jquery.com/jquery-2.2.4.js">
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript">
</script>
@stop	
@section("page-js-script")
<script type="text/javascript">
</script>
<script type="text/javascript">
    $(document).on('click','.massmodal', function() {
			$('.modal-descripcion').text('Añadir un nuevo Dato');
			$('#massModal').modal('show');
		});
		  // Show a post
		$(document).on('click', '.massshow-modal', function() {
			$('.modal-descripcion').text('Vista de los Datos');
			$('#msdelete').text(' ');

			$('#id_mass').val($(this).data('id'));
			$('#arboles_id_mass').val($(this).data('arboles_id'));
			$('#numero_record_mass').val($(this).data('numero_record'));
			$('#foto_record_mass').val($(this).data('foto_record'));
			$('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
			$('#estado_id_mass').val($(this).data('estado_id'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#updated_at_mass').val($(this).data('updated_at'));
			;
									
			
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
			$('#arboles_id_mass').val($(this).data('arboles_id'));
			$('#numero_record_mass').val($(this).data('numero_record'));
			$('#foto_record_mass').val($(this).data('foto_record'));
			$('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
			$('#estado_id_mass').val($(this).data('estado_id'));
			$('#created_at_mass').val($(this).data('created_at'));
			$('#updated_at_mass').val($(this).data('updated_at'));
			;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Eliminar');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Intervenir/'+id,
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
			$('#acciones').attr('class', 'btn btn-success add');
			//$('#formmass').attr('id', 'form_add');
			$('#acciones').text('Añadir Nuevos ');
		});
		$('.modal-footer').on('click', '.add', function() {
			// add a new post
			$.ajax({
				type: 'POST',
				url: 'Intervenir',
				data: {

				'id': $('#id_mass').val(),
				'arboles_id': $('#arboles_id_mass').val(),
				'numero_record': $('#numero_record_mass').val(),
				'foto_record': $('#foto_record_mass').val(),
				'tipo_proceso_id': $('#tipo_proceso_id_mass').val(),
				'estado_id': $('#estado_id_mass').val(),
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
						$('#massModal').modal('show');
            			toastr.error('Formato Inválido!', 'En el envio de la verificacion de datso <br>', {timeOut: 5000});	

					} else {
						toastr.success('Operación Exitosa!', 'Datos Guardados', {timeOut: 5000});
						operaciones(data,'add');
					}
				},
			});
		});
						
//add

	// Edit a post
	$(document).on('click', '.edit-modal', function() {
		$("#id_mass").val($(this).data("id"));
		$("#arboles_id_mass").val($(this).data("arboles_id"));
		$("#numero_record_mass").val($(this).data("numero_record"));
		$("#foto_record_mass").val($(this).data("foto_record"));
		$("#tipo_proceso_id_mass").val($(this).data("tipo_proceso_id"));
		$("#estado_id_mass").val($(this).data("estado_id"));
		$("#created_at_mass").val($(this).data("created_at"));
		$("#updated_at_mass").val($(this).data("updated_at"));
		
		id = $('#id_mass').val();
		$('#acciones').attr('class', 'btn btn-warning edit');
		$('#acciones').text('Editar');
		$('.modal-descripcion').text('Editar un Dato');
		$('#massModal').modal('show');
		$('#msdelete').text(' ');
	});
	//edit a post
	$('.modal-footer').on('click', '.edit', function() {
		$.ajax({
			type: 'PUT',
			url: 'Intervenir/' + id,
			data: {
			'id': $('#id_mass').val(),
			'arboles_id': $('#arboles_id_mass').val(),
			'numero_record': $('#numero_record_mass').val(),
			'foto_record': $('#foto_record_mass').val(),
			'tipo_proceso_id': $('#tipo_proceso_id_mass').val(),
			'estado_id': $('#estado_id_mass').val(),
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
					$('#massModal').modal('show');
					} else {
                	toastr.success('Modificación Exitosa Intervenir!', 'Datos Modificados', {timeOut: 5000});
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

	$('.errorid').addClass('hidden');
	$('.errorarboles_id').addClass('hidden');
	$('.errornumero_record').addClass('hidden');
	$('.errorfoto_record').addClass('hidden');
	$('.errortipo_proceso_id').addClass('hidden');
	$('.errorestado_id').addClass('hidden');
	$('.errorcreated_at').addClass('hidden');
	$('.errorupdated_at').addClass('hidden');

	if (data.errors.id) {
    	$(".errorid").removeClass("hidden");
    	$(".errorid").text(data.errors.id);
    }
    
	if (data.errors.arboles_id) {
    	$(".errorarboles_id").removeClass("hidden");
    	$(".errorarboles_id").text(data.errors.arboles_id);
    }
    
	if (data.errors.numero_record) {
    	$(".errornumero_record").removeClass("hidden");
    	$(".errornumero_record").text(data.errors.numero_record);
    }
    
	if (data.errors.foto_record) {
    	$(".errorfoto_record").removeClass("hidden");
    	$(".errorfoto_record").text(data.errors.foto_record);
    }
    
	if (data.errors.tipo_proceso_id) {
    	$(".errortipo_proceso_id").removeClass("hidden");
    	$(".errortipo_proceso_id").text(data.errors.tipo_proceso_id);
    }
    
	if (data.errors.estado_id) {
    	$(".errorestado_id").removeClass("hidden");
    	$(".errorestado_id").text(data.errors.estado_id);
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
<script type="text/javascript">
    function operaciones(data,operacion) {
	const resularboles_id=Foraarboles_id.find( cas => cas.id == data.arboles_id ); 
		const resultipo_proceso_id=Foratipo_proceso_id.find( cas => cas.id == data.tipo_proceso_id ); 
		const resulestado_id=Foraestado_id.find( cas => cas.id == data.estado_id ); 
		
	

	var tabla=
		"<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
		"<td class='col1'>" + data.id + "</td>"+
		"<td>"+ resularboles_id["nombre"]  +"</td>"+
		"<td>"+ data.numero_record+"</td>"+
		"<td>"+ data.foto_record+"</td>"+
		"<td>"+ resultipo_proceso_id["nombre"]  +"</td>"+
		"<td>"+ resulestado_id["nombre"]  +"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Intervenir Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-arboles_id='"+ data.arboles_id+"'"+
		"data-numero_record='"+ data.numero_record+"'"+
		"data-foto_record='"+ data.foto_record+"'"+
		"data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Intervenir Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-arboles_id='"+ data.arboles_id+"'"+
		"data-numero_record='"+ data.numero_record+"'"+
		"data-foto_record='"+ data.foto_record+"'"+
		"data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Intervenir Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-arboles_id='"+ data.arboles_id+"'"+
		"data-numero_record='"+ data.numero_record+"'"+
		"data-foto_record='"+ data.foto_record+"'"+
		"data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
		"data-estado_id='"+ data.estado_id+"'"+
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
