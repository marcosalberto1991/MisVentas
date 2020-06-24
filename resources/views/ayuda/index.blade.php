@extends('layouts.app_mosnter')
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- Favicon -->
<link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">
<!-- CSFR token for ajax call -->
<meta name="_token" content="{{ csrf_token() }}"/>
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<!-- icheck checkboxes -->
<!--<link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">-->
{{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}
<!-- toastr notifications -->
{{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- Font Awesome -->
{{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script type='text/javascript'>
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
	.footers{

	border-radius: 10px 10px 10px 10px;
	-moz-border-radius: 10px 10px 10px 10px;
	-webkit-border-radius: 10px 10px 10px 10px;
	border: 1px solid #2c33bd;
	margin-top: 15px;
 
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    background: rgba(72,164,234,1);
	background: -moz-linear-gradient(left, rgba(72,164,234,1) 0%, rgba(43,97,148,1) 100%);
	background: -webkit-gradient(left top, right top, color-stop(0%, rgba(72,164,234,1)), color-stop(100%, rgba(43,97,148,1)));
	background: -webkit-linear-gradient(left, rgba(72,164,234,1) 0%, rgba(43,97,148,1) 100%);
	background: -o-linear-gradient(left, rgba(72,164,234,1) 0%, rgba(43,97,148,1) 100%);
	background: -ms-linear-gradient(left, rgba(72,164,234,1) 0%, rgba(43,97,148,1) 100%);
	background: linear-gradient(to right, rgba(72,164,234,1) 0%, rgba(43,97,148,1) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#48a4ea', endColorstr='#2b6194', GradientType=1 );
	padding: 10px;
	}
	.titulo{

	color: #eceeef;
	}
	.letra-2{
		font-size: 2rem;
	}
	.margin-top-15{
		margin-top: 15px;
	}
	.hljs{
	background: #f5f5f5;
    color: #292b2ccf;
    display: block;
    overflow-x: auto;
    padding: 0.5em;
	}
	.panel{
		padding: 15px;
	}

</style>
<script>

</script>
@section('content')

<section class="col-md-12 connectedSortable">
	<div class="box box-warning">

		<div class="box-header with-border" id="app">
			<h3 class="box-descripcion">Lista de ayuda</h3>
		<ayuda-component></ayuda-component>
		</div>

		@foreach($listmysql as $lists)
		
		<div class="box-body">
			<div class="col-md-12 panel panel-default">
				<div class="footers">
					<h3 class="titulo">
						{{ $lists->nombre }}
					</h3>
					
				</div>	
	   			<div>
	   				<p class="letra-2 margin-top-15"><b>Descricion</b></p><br>
					<p class="letra-2">{{ $lists->descricion }}</p>
				</div>
				<div>
					<!--
					<pre class="letra-2 brush: php ">
						{{ $lists->fuente_codigo }}
					</pre>
					-->
					<pre>
    				<code class="letra-2 hljs HTML">{{ $lists->fuente_codigo }}</code>
					</pre>
					<p class="letra-2">
					</p>
				</div>
		
				<br>
			<button class="edit-modal btn btn-info" 
				data-id="{{ $lists->id}}"
				data-nombre="{{ $lists->nombre}}"
				data-descricion="{{ $lists->descricion}}"
				data-fuente_codigo="{{ $lists->fuente_codigo}}"
				data-created_at="{{ $lists->created_at}}"
				data-updated_at="{{ $lists->updated_at}}"		
				><span class="glyphicon glyphicon-edit"></span> Editar</button>
			<br>
			</div>

		</div>
		@endforeach
	</div>
</section>

<section class="col-md-12 connectedSortable">
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-descripcion">Lista de ayuda</h3>
		</div>          
		<div class="box-body">
	   		<div class="">
			<div class="panel panel-default">
				<div class="panel-heading">
					<ul>
						<li><i class="fa fa-file-text-o"></i> Acciones</li>
							<a href="#" id="massadd-modal" class="massmodal" data-target=".bd-example-modal-lg"><li>Añadir un ayuda</li></a>
						@can('ayuda Add')
						@endcan
					</ul>
				</div>

				<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
					<thead>
					   

					<tr>
						<th>id</th>
						<th>nombre</th>
						<th>descricion</th>
						<th>fuente_codigo</th>
						<th>created_at</th>
						<th>updated_at</th>
						<th>Ultima Modificacion</th><th>Accion</th>
								
					</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>


					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}"" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
						<td class="col1">{{ $lists->nombre }}</td>
						<td class="col1">{{ $lists->descricion }}</td>
						<td class="col1">{{ $lists->fuente_codigo }}</td>
						<td class="col1">{{ $lists->created_at }}</td>
						<td class="col1">{{ $lists->updated_at }}</td>
						
						<td>\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() </td>
						<td>
						<button class="massshow-modal btn btn-success" 
						data-id="{{ $lists->id}}"
						data-nombre="{{ $lists->nombre}}"
						data-descricion="{{ $lists->descricion}}"
						data-fuente_codigo="{{ $lists->fuente_codigo}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@can('ayuda Show')
						@endcan		
						@can('ayuda Editar')
						<button class="edit-modal btn btn-info" 
						data-id="{{ $lists->id}}"
						data-nombre="{{ $lists->nombre}}"
						data-descricion="{{ $lists->descricion}}"
						data-fuente_codigo="{{ $lists->fuente_codigo}}"
						data-created_at="{{ $lists->created_at}}"
						data-updated_at="{{ $lists->updated_at}}"
						
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('ayuda Eliminar') 
						
						<button class="massdelete-modal btn btn-danger"
						data-id="{{ $lists->id}}"
						data-nombre="{{ $lists->nombre}}"
						data-descricion="{{ $lists->descricion}}"
						data-fuente_codigo="{{ $lists->fuente_codigo}}"
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
	<div id="massModal" class="modal fade bd-example-modal-lg" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-descripcion"></h4>
				</div>
				<div class="modal-body">
					<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
					<form class="form-horizontal" id="formmass" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="id_mass"  disabled>
							</div>
						</div>

					
						
						<div class='form-group' id='nombre' >
							<label class='control-label col-sm-2' for='descripcion'>nombre:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='nombre_mass' maxlength='191'   required='required' autofocus>
								<p class='errornombre text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='descricion' >
							<label class='control-label col-sm-2' for='descripcion'>descricion:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='descricion_mass' maxlength='191'   required='required' autofocus>
								<p class='errordescricion text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='fuente_codigo' >
							<label class='control-label col-sm-2' for='descripcion'>fuente_codigo:</label>
							<div class='col-sm-10'>
								<pre><code><textarea type='textarea' rows="20" cols="100%" class='form-control' id='fuente_codigo_mass'     required='required' autofocus>
								</textarea></code></pre>
								<p class='errorfuente_codigo text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='created_at' >
							<label class='control-label col-sm-2' for='descripcion'>created_at:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
								<p class='errorcreated_at text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group' id='updated_at' >
							<label class='control-label col-sm-2' for='descripcion'>updated_at:</label>
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
	
@section("page-js-files")	
<!--
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<script type="text/javascript" src="syntaxhighlighter-master/src/highlighters.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atelier-heath-dark.min.css" />
	-->


<script src="vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
@stop	
@section("page-js-script")
	
			
<script type='text/javascript'>
 //CKEDITOR.replace('#fuente_codigo_mass');
  
  $('#fuente_codigo_mass').ckeditor().then(editor => {
          editor.keystrokes.set( 'Tab', ( data, cancel ) => {
             editor.model.change( writer => {
                  writer.insertText("    ", editor.model.document.selection.getFirstPosition()) 
             });
             cancel();
           });
        myEditor = editor;
     })
     .catch(error => {
          console.error(error);
     });
    
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
			$('#nombre_mass').val($(this).data('nombre'));
			$('#descricion_mass').val($(this).data('descricion'));
			$('#fuente_codigo_mass').val($(this).data('fuente_codigo'));
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
			$('#nombre_mass').val($(this).data('nombre'));
			$('#descricion_mass').val($(this).data('descricion'));
			$('#fuente_codigo_mass').val($(this).data('fuente_codigo'));
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
				url: 'ayuda/'+id,
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
				url: 'ayuda',
				data: {

				'id': $('#id_mass').val(),
				'nombre': $('#nombre_mass').val(),
				'descricion': $('#descricion_mass').val(),
				'fuente_codigo': $('#fuente_codigo_mass').val(),
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
            			toastr.error('Formato Inválido!', 'En la verificación de datos <br>', {timeOut: 5000});	

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
		$("#nombre_mass").val($(this).data("nombre"));
		$("#descricion_mass").val($(this).data("descricion"));
		$("#fuente_codigo_mass").val($(this).data("fuente_codigo"));
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
			url: 'ayuda/' + id,
			data: {
			'id': $('#id_mass').val(),
			'nombre': $('#nombre_mass').val(),
			'descricion': $('#descricion_mass').val(),
			'fuente_codigo': $('#fuente_codigo_mass').val(),
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
                	toastr.success('Modificación Exitosa ayuda!', 'Datos Modificados', {timeOut: 5000});
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
	$('.errornombre').addClass('hidden');
	$('.errordescricion').addClass('hidden');
	$('.errorfuente_codigo').addClass('hidden');
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
    
	if (data.errors.descricion) {
    	$(".errordescricion").removeClass("hidden");
    	$(".errordescricion").text(data.errors.descricion);
    }
    
	if (data.errors.fuente_codigo) {
    	$(".errorfuente_codigo").removeClass("hidden");
    	$(".errorfuente_codigo").text(data.errors.fuente_codigo);
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
		"<td>"+ data.id+"</td>"+
		"<td>"+ data.nombre+"</td>"+
		"<td>"+ data.descricion+"</td>"+
		"<td>"+ data.fuente_codigo+"</td>"+
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('ayuda Show') 
		' <button class="massshow-modal btn btn-success"  ' + 
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-fuente_codigo='"+ data.fuente_codigo+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('ayuda Editar')
		" <button class='edit-modal btn btn-info' "+
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-fuente_codigo='"+ data.fuente_codigo+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('ayuda Eliminar') 
		"<button class='massdelete-modal btn btn-danger'  " +
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-fuente_codigo='"+ data.fuente_codigo+"'"+
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

				
