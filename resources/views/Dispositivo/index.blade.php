@extends('layouts.app_mosnter')
<meta name="_token" content="{{ csrf_token() }}"/>


@section("content")

	
	<div class="row">
        <div class="col-12">
         	<div id="map"></div>
        </div>
        <div class="col-12">

        <div class="box">
            <div class="box-header">
				<h3 class="box-title">Dispositivo</h3>
				@can('Dispositivo Add')	
					<button type="button" class="btn btn-success mass-add-modal" data-toggle="modal" data-target=".bd-example-modal-lg">Añadir Dispositivo</button>
        		@endcan
            </div>

            <div class="box-body">


        		<table id="myTable" class="table display table-striped table-bordered table-hover compact nowrap">
					<thead>						   
						<tr>
							<th>id</th>
							<th>nombre</th>
							<th>latitud</th>
							<th>logitud</th>
							<th>descricion</th>
							<th>tipo_dispositivo_id</th>
							
							<th>created_at</th>
							<th>updated_at</th>
							<th>Ultima Modificacion</th>	<th>Accion</th>		
						</tr>
					{{ csrf_field() }}
					</thead>
					<tbody>

					@foreach($listmysql as $lists)
						  
					<tr id="item_{{$lists->id}}"" class="item{{$lists->id}} @if($lists->is_published) warning @endif">
						<td class="col1">{{ $lists->id }}</td>
							<td class="col1">{{ $lists->nombre }}</td>
							<td class="col1">{{ $lists->latitud }}</td>
							<td class="col1">{{ $lists->logitud }}</td>
							<td class="col1">{{ $lists->descricion }}</td>
							<td class="col1">{{ $lists->tipo_dispositivo_id }}</td>
							
							<td class="col1">{{ $lists->created_at }}</td>
							<td class="col1">{{ $lists->updated_at }}</td>
							
						<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
						<td>
						@can('Dispositivo Show')
						<button class="massshow-modal btn btn-success btn_mass" 
							data-id="{{ $lists->id}}"
								data-nombre="{{ $lists->nombre}}"
								data-latitud="{{ $lists->latitud}}"
								data-logitud="{{ $lists->logitud}}"
								data-descricion="{{ $lists->descricion}}"
								data-tipo_dispositivo_id="{{ $lists->tipo_dispositivo_id}}"
								data-users_id="{{ $lists->users_id}}"
								data-created_at="{{ $lists->created_at}}"
								data-updated_at="{{ $lists->updated_at}}"
							
						
						>
						<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
						@endcan		
						@can('Dispositivo Editar')
						<button class="edit-modal btn btn-info btn_mass" 
							data-id="{{ $lists->id}}"
								data-nombre="{{ $lists->nombre}}"
								data-latitud="{{ $lists->latitud}}"
								data-logitud="{{ $lists->logitud}}"
								data-descricion="{{ $lists->descricion}}"
								data-tipo_dispositivo_id="{{ $lists->tipo_dispositivo_id}}"
								data-users_id="{{ $lists->users_id}}"
								data-created_at="{{ $lists->created_at}}"
								data-updated_at="{{ $lists->updated_at}}"
							
						
						><span class="glyphicon glyphicon-edit"></span> Editar</button>
						@endcan
						@can('Dispositivo Eliminar') 
						
						<button class="massdelete-modal btn btn-danger btn_mass"
							data-id="{{ $lists->id}}"
								data-nombre="{{ $lists->nombre}}"
								data-latitud="{{ $lists->latitud}}"
								data-logitud="{{ $lists->logitud}}"
								data-descricion="{{ $lists->descricion}}"
								data-tipo_dispositivo_id="{{ $lists->tipo_dispositivo_id}}"
								data-users_id="{{ $lists->users_id}}"
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
								<p class='errorid text-center alert alert-danger d-none'></p>
							</div>
						</div>
						-->
							
						<div class='form-group col-sm-12' id='nombre' >
							<label>nombre:</label>
							<input type='text' class='form-control' id='nombre_mass' maxlength='191'   required='required' autofocus>
							<p class='errornombre text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='latitud' >
							<label>latitud:</label>
							<input type='text' class='form-control' id='latitud_mass' maxlength='45'   required='required' autofocus>
							<p class='errorlatitud text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='logitud' >
							<label>logitud:</label>
							<input type='text' class='form-control' id='logitud_mass' maxlength='45'   required='required' autofocus>
							<p class='errorlogitud text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='descricion' >
							<label>descricion:</label>
							<input type='text' class='form-control' id='descricion_mass' maxlength='191'   required='required' autofocus>
							<p class='errordescricion text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class="form-group col-sm-12">
							<label>tipo_dispositivo_id:</label>
								<select class="form-control select2" id="tipo_dispositivo_id_mass" required="required" autofocus style="width: 100%;" >
 									<option value=""></option>
 								@foreach($tipo_dispositivo_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								</select>
								<!--
								<input type="select" class="form-control" id=tipo_dispositivo_id_mass" required="required" autofocus>
								-->
								<p class="errortipo_dispositivo_id text-center alert alert-danger d-none"> llenar los datos</p>
						</div>
						
						
						
						<div class='form-group col-sm-12' id='created_at' >
							<label>created_at:</label>
							<input type='text' class='form-control' id='created_at_mass'    readonly required='required' autofocus>
							<p class='errorcreated_at text-center alert alert-danger d-none'></p>
						</div>
							
						
						<div class='form-group col-sm-12' id='updated_at' >
							<label>updated_at:</label>
							<input type='text' class='form-control' id='updated_at_mass'    readonly required='required' autofocus>
							<p class='errorupdated_at text-center alert alert-danger d-none'></p>
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
			$('#latitud_mass').val($(this).data('latitud'));
			$('#logitud_mass').val($(this).data('logitud'));
			$('#descricion_mass').val($(this).data('descricion'));
			$('#tipo_dispositivo_id_mass').val($(this).data('tipo_dispositivo_id'));
			$('#users_id_mass').val($(this).data('users_id'));
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
				url: 'Dispositivo/'+id,
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
				url: 'Dispositivo',
				data: {

				'id': $('#id_mass').val(),
				'nombre': $('#nombre_mass').val(),
				'latitud': $('#latitud_mass').val(),
				'logitud': $('#logitud_mass').val(),
				'descricion': $('#descricion_mass').val(),
				'tipo_dispositivo_id': $('#tipo_dispositivo_id_mass').val(),
				'users_id': $('#users_id_mass').val(),
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
		$("#latitud_mass").val($(this).data("latitud"));
		$("#logitud_mass").val($(this).data("logitud"));
		$("#descricion_mass").val($(this).data("descricion"));
		$("#tipo_dispositivo_id_mass").val($(this).data("tipo_dispositivo_id"));
		$("#users_id_mass").val($(this).data("users_id"));
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
			url: 'Dispositivo/' + id,
			data: {
			'id': $('#id_mass').val(),
			'nombre': $('#nombre_mass').val(),
			'latitud': $('#latitud_mass').val(),
			'logitud': $('#logitud_mass').val(),
			'descricion': $('#descricion_mass').val(),
			'tipo_dispositivo_id': $('#tipo_dispositivo_id_mass').val(),
			'users_id': $('#users_id_mass').val(),
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
                	toastr.success('Modificación Exitosa Dispositivo!', 'Datos Modificados', {timeOut: 5000});
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
	$('.errorlatitud').addClass('d-none');
	$('.errorlogitud').addClass('d-none');
	$('.errordescricion').addClass('d-none');
	$('.errortipo_dispositivo_id').addClass('d-none');
	$('.errorusers_id').addClass('d-none');
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
    
	if (data.errors.latitud) {
    	$(".errorlatitud").removeClass("d-none");
    	$(".errorlatitud").text(data.errors.latitud);
    }
    
	if (data.errors.logitud) {
    	$(".errorlogitud").removeClass("d-none");
    	$(".errorlogitud").text(data.errors.logitud);
    }
    
	if (data.errors.descricion) {
    	$(".errordescricion").removeClass("d-none");
    	$(".errordescricion").text(data.errors.descricion);
    }
    
	if (data.errors.tipo_dispositivo_id) {
    	$(".errortipo_dispositivo_id").removeClass("d-none");
    	$(".errortipo_dispositivo_id").text(data.errors.tipo_dispositivo_id);
    }
    
	if (data.errors.users_id) {
    	$(".errorusers_id").removeClass("d-none");
    	$(".errorusers_id").text(data.errors.users_id);
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
		"<td>"+ data.latitud+"</td>"+
		"<td>"+ data.logitud+"</td>"+
		"<td>"+ data.descricion+"</td>"+
		"<td>"+ data.tipo_dispositivo_id+"</td>"+
		
		"<td>"+ data.created_at+"</td>"+
		"<td>"+ data.updated_at+"</td>"+
		
		'<td>Ahorra</td><td>'+					
	@can('Dispositivo Show') 
		" <button class='massshow-modal btn btn-success btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg'  " + 
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-latitud='"+ data.latitud+"'"+
		"data-logitud='"+ data.logitud+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-tipo_dispositivo_id='"+ data.tipo_dispositivo_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
	@endcan			
	
	@can('Dispositivo Editar')
		" <button class='edit-modal btn btn-info btn_mass' data-toggle='modal' data-target='.bd-example-modal-lg' "+
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-latitud='"+ data.latitud+"'"+
		"data-logitud='"+ data.logitud+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-tipo_dispositivo_id='"+ data.tipo_dispositivo_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
		"data-created_at='"+ data.created_at+"'"+
		"data-updated_at='"+ data.updated_at+"'"+
		 
		"'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
	@endcan

	@can('Dispositivo Eliminar') 
		"<button class='btn btn-danger delete-Modal btn_mass' data-toggle='modal' data-target='#exampleModal'  " +
		"data-id='"+ data.id+"'"+
		"data-nombre='"+ data.nombre+"'"+
		"data-latitud='"+ data.latitud+"'"+
		"data-logitud='"+ data.logitud+"'"+
		"data-descricion='"+ data.descricion+"'"+
		"data-tipo_dispositivo_id='"+ data.tipo_dispositivo_id+"'"+
		"data-users_id='"+ data.users_id+"'"+
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














<script>
    var map;
    function geocodeLatLng(geocoder, map, infowindow) {
       var input = document.getElementById('latlng').value;
       var latlngStr = input.split(',', 2);
    }
	var nuevosarboles = [0.0,0.0];
    function deleteMarkers() {
        clearMarkers();
        markers = [];
    }

    function initMap(){
        var options = {
        	zoom:16,
        	center:{lat:4.302314898662877,lng:-74.80926649120488}
        }
     // New map
     	map = new google.maps.Map(document.getElementById('map'), options);
        var geocoder = new google.maps.Geocoder;
     	var infowindow = new google.maps.InfoWindow;
		
		$("#find_btn").click(function (){
		    if ("geolocation" in navigator){
		        navigator.geolocation.getCurrentPosition(function(position){ 
		        infoWindow = new google.maps.InfoWindow({map: map});
		        var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
		        infoWindow.setPosition(pos);
		        map.setZoom(19);
		        infoWindow.setContent("Localización del usuario <br/>"+
		            "@can('Dispositivo Add')"+
		            "<a class='massmodal btn btn-success' href='#' id='massadd-modal' <span class='glyphicon glyphicon-eye-open'></span>Añadir un Árbol</a>"+
		              "@endcan"+
		            //"Lat : "+position.coords.latitude+" </br>Lang :"+ position.coords.longitude
		            "");
		        $('#latitud_mass').val(position.coords.latitude);
		        $('#logitud_mass').val(position.coords.longitude);
		        map.panTo(pos);

		        MostrarArbolesCercanos(position.coords.latitude,position.coords.longitude);
		    });
		        }else{
		            console.log("Su navegador no soporta la Geo-localización ");
		    }
		});

    	$('#acciones').attr('class', 'btn btn-success add');
        $('#acciones').text('Añadir Nuevos ');
        google.maps.Map.prototype.clearMarkers = function() {
            for(var i=0; i<this.markers.length; i++){
            this.markers[i].setMap(null);
        }
        this.markers = new Array();
        };
        @can('Dispositivo Add')
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
        //document.addmarcos.latitud_mass.value = lista[0];
        //document.addmarcos.longitud_mass.value = lista[1];

        $('#latitud_mass').val(lista[0]);
		$('#logitud_mass').val(lista[1]);
        });
        $('.modal-descripcion').text('Añadir una zona verde');
        $('#msdelete').text(' ');
        @endcan
     // Array of markers

    var markers = [


    	{
       
       	},

       
          @foreach($listmysql as $lists){
          
          coords:{lat:{{$lists->latitud}},lng:{{$lists->logitud}}},
         
          
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
          //'<h3 id="firstHeading" class="firstHeading">{{$lists->sobrenombre}} {{$lists->codigo}} </h3>'+
          '<div id="bodyContent">'+
          '<table class="table">'+
          '<tr><td>Codigo</td><td>{{$lists->id}}</td></tr>'+
          '<tr><td>Dirección</td><td>{{$lists->id}}</td></tr>'+
          '<tr><td>Barrio</td><td>{{$lists->id}}</td></tr>'+
          '<tr><td>Tipo de arbol</td><td>{{$lists->id}}</td></tr>'+
          '</table>'+
          '</div>'+
          '</div>'+

                @can('Dispositivo Editar')
                '<button class="edit-modal btn btn-info"'+ 
                'data-id="{{$lists->id}}" '+
                'data-latitud="{{$lists->latitud}}"'+
                'data-logitud="{{$lists->logitud}}"'+  
                'data-descricion="{{$lists->descricion}}"'+  
                'data-tipo_dispositivo_id="{{$lists->tipo_dispositivo_id}}"'+
                'data-created_at="{{$lists->created_at}}"'+
                'data-updated_at="{{$lists->updated_at}}">'+
                
                '<span class="glyphicon glyphicon-edit"></span> Editar</button>'+
                @endcan 
                ' '
               	

       },
          @endforeach
       {
       // coords:{lat:42.7762,lng:-71.0773},
        //content:'<h1><a href="lat:42.7762,lng:-71.0773"></h1>ubicacion</a>'
       }
     ];

     // Loop through markers
     for(var i = 0;i < markers.length;i++){
       // Add marker
       addMarker(markers[i]);
     }


    


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




<script type="text/javascript">
    function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }

    // Testing the addMarker function
    function TestMarker() {
           CentralPark = new google.maps.LatLng(37.7699298, -122.4469157);
           addMarker(CentralPark);
    }


  function mostrar_arboles(min,max) {
    TestMarker();
    var mostra_numero = $('#mostra_numero').val();
    mostra_numero=mostra_numero+1000;
    $('#mostra_numero').val(mostra_numero);
    $.ajax({
       type: 'POST',
       url: 'Arboles/mostrar_arboles',
       data: {
        '_token': $('input[name=_token]').val(),
        'min': min,
        'max': max,
       },
       success: function(data) {
        toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
        var markers = [];
        for(var i = 0;i < data.length;i++){
            markers.push({
                coords: {lat:parseFloat(data[i].latitud),lng:parseFloat(data[i].longitud)},
                iconImage:'{{asset('imagenes/punto/punto.png')}}',
                label: {
                        text: '5',
                        fontWeight: 'bold',
                        fontSize: '12px',
                        fontFamily: '"Courier New", Courier,Monospace',
                        color: 'white'
                    },
                content:'<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    //'<h3 id="firstHeading" class="firstHeading">data[i].sobrenombre data[i].codigo   </h3>'+
                    '<div id="bodyContent">'+
                    '<table class="table">'+
                    '<tr><td>Codigo</td><td>'+data[i].codigo+'</td></tr>'+
                    '<tr><td>Especie</td><td>'+data[i].especie_id_pk.nombre+'</td></tr>'+
                    '<tr><td>Dirección</td><td>'+data[i].direccion+'</td></tr>'+
                    '<tr><td>Barrio</td><td>'+data[i].barrio_id_pk.nombre+'</td></tr>'+
                    '<tr><td>Tipo de arbol</td><td>'+data[i].categoria_arbol_id_pk.nombre+'</td></tr>'+
                    '</table>'+
                    '</div>'+
                    '</div>'+
                    '<button class="edit-modal btn btn-info"'+ 
                        'data-id="'+data[i].id+'" '+
                        'data-codigo="'+data[i].codigo+'"'+
                        'data-especie_id="'+data[i].especie_id+'"'+  
                        'data-categoria_arbol_id="'+data[i].categoria_arbol_id+'"'+  
                        'data-coordenadax="'+data[i].coordenadax+'"'+
                        'data-coordenaday="'+data[i].coordenaday+'"'+
                        'data-direccion="'+data[i].direccion+'"'+
                        'data-barrio_id="'+data[i].barrio_id+'"'+
                        'data-latitud="'+data[i].latitud+'"'+
                        'data-zona="'+data[i].zona+'"'+
                        'data-longitud="'+data[i].longitud+'"'+
                        'data-created_at="'+data[i].created_at+'"'+
                        'data-updated_at="'+data[i].updated_at+'">'+
                    '<span class="glyphicon glyphicon-edit"></span> Editar</button>'+
                    '<a class="btn btn-info" href="Procesos_Detalles/'+data[i].id+'/index" >'+
                    '<span class="glyphicon glyphicon-edit"></span> Ver Procesos</a>'+

                    '<a class="btn btn-info" href="FichaDetalles/'+data[i].id+'/index" >'+
                    '<span class="glyphicon glyphicon-edit"></span> Ficha Tecnica</a>'+
                    
                    '<a class="btn btn-info" href="Asistencia/'+data[i].id+'/index" >'+
                    '<span class="glyphicon glyphicon-edit"></span> Ver Asistencia</a>'
                     
                });
        
            }
            for(var i = 0;i < markers.length;i++){
               // Add marker
               addMarker(markers[i]);
            }
        }
    });
}//fin de mostrar_arboles


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
</script>



<style>
    /* Always set the map height explicitly to define the size of the div
      * element that contains the map. */
     #map {
       height: 100%;
     }
     /* Optional: Makes the sample page fill the window. */
     html, body {
       height: 100%;
       margin: 0;
       padding: 0;
     }
</style>


<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWVmumfMZzD3VNw8RBjpoBt9RKfv7w8Wk&callback=initMap">
</script>





@stop
</body>
</html>

				
