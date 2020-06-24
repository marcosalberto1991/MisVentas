@extends('layouts.app')
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
 
	<section class="col-lg-12 connectedSortable">
	 	<div class="box box-warning">
			<div class="box-header with-border">
			  <h3 class="box-descripcion">Mapa de los arboles</h3>

			  	<div id="map"></div>
			    
			    <script async defer
			    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWVmumfMZzD3VNw8RBjpoBt9RKfv7w8Wk&callback=initMap">
			    </script>
			</div>          
			<!-- /.box-header -->
		</div>
	</section>





<script type="text/javascript">

 $(document).ready(function ($) {
    // trigger event when button is clicked
    $("button.add").click(function () {
        // add new row to table using addTableRow function
        addTableRow($("tableadd"));
        // prevent button redirecting to new page
        return false;

    });

    // function to add a new row to a table by cloning the last row and 
    // incrementing the name and id values by 1 to make them unique
    function addTableRow(tableadd) {

        // clone the last row in the table
        var $tr = $(table).find("tbody tr:last").clone();


        // get the name attribute for the input and select fields
        $tr.find("input,select").attr("name", function () {
            // break the field name and it's number into two parts
            var parts = this.id.match(/(\D+)(\d+)$/);
            // create a unique name for the new field by incrementing
            // the number for the previous field by 1
            return parts[1] + ++parts[2];

            // repeat for id attributes
        }).attr("id", function () {
            var parts = this.id.match(/(\D+)(\d+)$/);
            return parts[1] + ++parts[2];
        });
        // append the new row to the table
        $(table).find("tbody tr:last").after($tr);
        $tr.hide().fadeIn('slow');

        // row count
        rowCount = 0;
        $("#table tr td:first-child").text(function () {
            return ++rowCount;
        });

        // remove rows
        $(".remove_button").on("click", function () {
            if ( $('#table tbody tr').length == 1) return;
            $(this).parents("tr").fadeOut('slow', function () {
                $(this).remove();
                rowCount = 0;
                $("#table tr td:first-child").text(function () {
                    return ++rowCount;
                });
            });
        });

    };
});
   
 
</script>

<script>

 var nuevosarboles = [0.0,0.0];
    function initMap(){
      // Map options
      var options = {
        zoom:16,
        center:{lat:4.302314898662877,lng:-74.80926649120488}
      }

      // New map
      var map = new google.maps.Map(document.getElementById('map'), options);

      // Listen for click on map
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
        
        //var latitude=posicion.coords.latitude;
        //var longitude=posicion.coords.longitude;
        //class="form-horizontal" role="form">
        $('.modal-codigo').text('Añadir un nuevo arbol');
        $('#massModal').modal('show');
        //document.f1.f1t1.value = lista[0];
        //document.f1.f1t2.value = lista[1];
        //alert(lista[0]+" mas "+lista[1]);
        document.formmass.coodenadas_x_mass.value = lista[0];
        document.formmass.coodenadas_y_mass.value = lista[1];
      });
      // Array of markers
      var markers = [
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
        
            @foreach($listmysql as $indexKey => $lists)
        {
            //iconImage:'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png',
            
            //añadir los doatas de los arboles
            coords:{lat:{{$lists->latitud}},lng:{{$lists->longitud}}},
            //var conte={{$lists->imagen}},
            iconImage:'imagenes/punto/{{$lists->color}}',
            //iconImage:'<div>XXXX</div>',
            //alert(conte);

            //iconImage:'imagenes/punto/punto.png',
            
            content: '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h3 id="firstHeading" class="firstHeading">{{$lists->sobrenombre}} {{$lists->codigo}} </h3>'+
            '<div id="bodyContent">'+
            
            '<B> Codigo: </B>{{$lists->codigo}}.</p>'+
            '<B> Nombre Cientifico: </B>{{$lists->nombrecientifico}}.</p>'+
            '<B> Nombre Comun: </B>{{$lists->sobrenombre}}.</p>'+

            
            '</div>'+
            '</div>'+
                    '<button class="edit-modal btn btn-info"'+ 
                    'data-id="{{$lists->idarboles}}" '+
                    'data-codigo="{{$lists->codigo}}"'+
                    'data-direccion="{{$lists->direccion}}"'+  
                    'data-latitud="{{$lists->latitud}}"'+
                    'data-longitud="{{$lists->longitud}}"'+
                    'data-barrios_id="{{$lists->barrios_id}}"'+
                    'data-id_especie="{{$lists->id_especie}}"'+
                    'data-usuarios_id="{{$lists->usuarios_id}}"'+
                    'data-arboles_estado_id="{{$lists->arboles_estado_id}}">'+
                    
                    '<span class="glyphicon glyphicon-edit"></span> Edit</button>'+
                     '<button class="delete-modal btn btn-danger"'+ 
                        'data-id="{{$lists->idarboles}}" '+
                        'data-codigo="{{$lists->codigo}}"'+
                        'data-direccion="{{$lists->direccion}}"'+ 
                        'data-latitud="{{$lists->latitud}}"'+
                        'data-longitud="{{$lists->longitud}}"'+
                        'data-barrios_id="{{$lists->barrios_id}}"'+
                        'data-id_especie="{{$lists->id_especie}}"'+
                        'data-usuarios_id="{{$lists->usuarios_id}}"'+
                        'data-arboles_estado_id="{{$lists->arboles_estado_id}}">'+
                        '<span class="glyphicon glyphicon-trash"></span> Delete</button>'+
                        //'<a href="{{url('procedimiento_arbole', ['arboles' => $lists->idarboles])}}">Agregar adultos</a>'+

                        '<a class="btn btn-info" href="{{url('Procedimiento_arbole/index', ['arboles' => $lists->idarboles])}}" >'+
                        '<span class="glyphicon glyphicon-edit"></span> Ver los procesor</a>'+

                        '<a class="btn btn-info" href="{{url('Procedimiento_arbole/index', ['arboles' => $lists->idarboles])}}" >'+
                        '<span class="glyphicon glyphicon-edit"></span> Enviar una Solicitud</a>'


                        //'<button  href="{{url('procedimiento_arbole', ['arboles' => $lists->idarboles])}}"  btn btn-info"'+ 
                        //'data-id="{{$lists->idarboles}}" '+
                        //'data-codigo="{{$lists->codigo}}">'+
                        //'<span class="glyphicon glyphicon-trash"></span> Ver los procesos</button>'                   




        
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





<section class="col-lg-12 connectedSortable">
	 <div class="box box-warning">
			<div class="box-header with-border">
			  <h3 class="box-descripcion">Lista de Ficha_Arboles</h3>
			</div>          
			<!-- /.box-header -->
	  <div class="box-body">
	   <div class="">
		<div class="panel panel-default">
			<div class="panel-heading">
				<ul>
					<li><i class="fa fa-file-text-o"></i> All the current Posts</li>
					<a href="#" class="add-modal"><li>Add a Post</li></a>
					@can('Ficha_Arboles Add')
					<a href="#" id="massadd-modal" class="massmodal"><li>Añadir un Ficha_Arboles</li></a>

					@endcan

					@hasrole('funciona')
										yo soy funciona!
										@else
										I m not a writer...
										@endhasrole
				</ul>
			</div>
		
			<div class="panel-body" style="overflow-x:auto;">
					<table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
						<thead>
					   

							<tr>
								<th>id</th>
		<th>fecha</th>
		<th>codigo</th>
		<th>nom_cientifico</th>
		<th>arbol_num</th>
		<th>coodenadas_x</th>
		<th>coodenadas_y</th>
		<th>di_dap</th>
		<th>di_altura</th>
		<th>di_podar</th>
		<th>di_ecuatorial</th>
		<th>estado_fisico_id</th>
		<th>estado_sanitario_id</th>
		<th>concepto_tecnico_id</th>
		<th>comuna_id</th>
		<th>barrio_id</th>
		<th>municipios_id</th>
		<th>especie_arboles_id</th>
		<th>Entidad_municipal_id</th>
		<th>Ultima Modificacion</th><th>Accion</th>
								<!--
								<th valign="middle">#</th>
								<th>Descripcion</th>
								<th>Tipo de solicitud?</th>
								<th>Estado de Solicitud?</th>
								<th>Nombre Ususario</th>
								<th>Ultima modificacion</th>
								<th>Accion</th>
								<th>Accion</th>
								-->
							</tr>
							{{ csrf_field() }}
						</thead>
						<tbody>


							@foreach($listmysql as $lists)
						  
								<tr class="item{{$lists->id}} @if($lists->is_published) warning @endif">
									<td class="col1">{{ $lists->id }}</td>
		<td class="col1">{{ $lists->fecha }}</td>
		<td class="col1">{{ $lists->codigo }}</td>
		<td class="col1">{{ $lists->nom_cientifico }}</td>
		<td class="col1">{{ $lists->arbol_num }}</td>
		<td class="col1">{{ $lists->coodenadas_x }}</td>
		<td class="col1">{{ $lists->coodenadas_y }}</td>
		<td class="col1">{{ $lists->di_dap }}</td>
		<td class="col1">{{ $lists->di_altura }}</td>
		<td class="col1">{{ $lists->di_podar }}</td>
		<td class="col1">{{ $lists->di_ecuatorial }}</td>
		<td class="col1">{{ $lists->estado_fisico_id }}</td>
		<td class="col1">{{ $lists->estado_sanitario_id }}</td>
		<td class="col1">{{ $lists->concepto_tecnico_id }}</td>
		<td class="col1">{{ $lists->comuna_id }}</td>
		<td class="col1">{{ $lists->barrio_id }}</td>
		<td class="col1">{{ $lists->municipios_id }}</td>
		<td class="col1">{{ $lists->especie_arboles_id }}</td>
		<td class="col1">{{ $lists->Entidad_municipal_id }}</td>
		
									
									
									
									<td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}</td>
									<td>
										@can('Ficha_Arboles Show')
												<button class="massshow-modal btn btn-success" 
												data-id="{{ $lists->id}}"
		data-fecha="{{ $lists->fecha}}"
		data-codigo="{{ $lists->codigo}}"
		data-nom_cientifico="{{ $lists->nom_cientifico}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-coodenadas_x="{{ $lists->coodenadas_x}}"
		data-coodenadas_y="{{ $lists->coodenadas_y}}"
		data-di_dap="{{ $lists->di_dap}}"
		data-di_altura="{{ $lists->di_altura}}"
		data-di_podar="{{ $lists->di_podar}}"
		data-di_ecuatorial="{{ $lists->di_ecuatorial}}"
		data-estado_fisico_id="{{ $lists->estado_fisico_id}}"
		data-estado_sanitario_id="{{ $lists->estado_sanitario_id}}"
		data-concepto_tecnico_id="{{ $lists->concepto_tecnico_id}}"
		data-comuna_id="{{ $lists->comuna_id}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-especie_arboles_id="{{ $lists->especie_arboles_id}}"
		data-Entidad_municipal_id="{{ $lists->Entidad_municipal_id}}"
		
												
												>
												<span class="glyphicon glyphicon-eye-open"></span> Ver</button>
										@endcan		
										@can('Ficha_Arboles Editar')
												<button class="edit-modal btn btn-info" 
												data-id="{{ $lists->id}}"
		data-fecha="{{ $lists->fecha}}"
		data-codigo="{{ $lists->codigo}}"
		data-nom_cientifico="{{ $lists->nom_cientifico}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-coodenadas_x="{{ $lists->coodenadas_x}}"
		data-coodenadas_y="{{ $lists->coodenadas_y}}"
		data-di_dap="{{ $lists->di_dap}}"
		data-di_altura="{{ $lists->di_altura}}"
		data-di_podar="{{ $lists->di_podar}}"
		data-di_ecuatorial="{{ $lists->di_ecuatorial}}"
		data-estado_fisico_id="{{ $lists->estado_fisico_id}}"
		data-estado_sanitario_id="{{ $lists->estado_sanitario_id}}"
		data-concepto_tecnico_id="{{ $lists->concepto_tecnico_id}}"
		data-comuna_id="{{ $lists->comuna_id}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-especie_arboles_id="{{ $lists->especie_arboles_id}}"
		data-Entidad_municipal_id="{{ $lists->Entidad_municipal_id}}"
		
												
												><span class="glyphicon glyphicon-edit"></span> Editar</button>
										@endcan
										@can('Ficha_Arboles Eliminar') 
												
												<button class="massdelete-modal btn btn-danger"
												data-id="{{ $lists->id}}"
		data-fecha="{{ $lists->fecha}}"
		data-codigo="{{ $lists->codigo}}"
		data-nom_cientifico="{{ $lists->nom_cientifico}}"
		data-arbol_num="{{ $lists->arbol_num}}"
		data-coodenadas_x="{{ $lists->coodenadas_x}}"
		data-coodenadas_y="{{ $lists->coodenadas_y}}"
		data-di_dap="{{ $lists->di_dap}}"
		data-di_altura="{{ $lists->di_altura}}"
		data-di_podar="{{ $lists->di_podar}}"
		data-di_ecuatorial="{{ $lists->di_ecuatorial}}"
		data-estado_fisico_id="{{ $lists->estado_fisico_id}}"
		data-estado_sanitario_id="{{ $lists->estado_sanitario_id}}"
		data-concepto_tecnico_id="{{ $lists->concepto_tecnico_id}}"
		data-comuna_id="{{ $lists->comuna_id}}"
		data-barrio_id="{{ $lists->barrio_id}}"
		data-municipios_id="{{ $lists->municipios_id}}"
		data-especie_arboles_id="{{ $lists->especie_arboles_id}}"
		data-Entidad_municipal_id="{{ $lists->Entidad_municipal_id}}"
		
												
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
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-descripcion"></h4>
				</div>
				<div class="modal-body">
					<h3 class="text-center" id="msdelete">¿Seguro que quieres borrar los  datos?</h3>
					<form class="form-horizontal" id="formmass" name="formmass" role="form">
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="id">ID:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="id_mass"  disabled>
							</div>
						</div>

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
							
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>fecha:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='fecha_mass' maxlength='45'   required='required' autofocus>
								<p class='errorfecha text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>codigo:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='codigo_mass' maxlength='45'   required='required' autofocus>
								<p class='errorcodigo text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>nom_cientifico:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='nom_cientifico_mass' maxlength='45'   required='required' autofocus>
								<p class='errornom_cientifico text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>arbol_num:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='arbol_num_mass' maxlength='45'   required='required' autofocus>
								<p class='errorarbol_num text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>coodenadas_x:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='coodenadas_x_mass' maxlength='45'   required='required' autofocus>
								<p class='errorcoodenadas_x text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>coodenadas_y:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='coodenadas_y_mass' maxlength='45'   required='required' autofocus>
								<p class='errorcoodenadas_y text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>di_dap:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='di_dap_mass' maxlength='45'   required='required' autofocus>
								<p class='errordi_dap text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>di_altura:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='di_altura_mass' maxlength='45'   required='required' autofocus>
								<p class='errordi_altura text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>di_podar:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='di_podar_mass' maxlength='45'   required='required' autofocus>
								<p class='errordi_podar text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class='form-group'>
							<label class='control-label col-sm-2' for='descripcion'>di_ecuatorial:</label>
							<div class='col-sm-10'>
								<input type='text' class='form-control' id='di_ecuatorial_mass' maxlength='45'   required='required' autofocus>
								<p class='errordi_ecuatorial text-center alert alert-danger hidden'></p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">estado_fisico_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="estado_fisico_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($estado_fisico_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=estado_fisico_id_mass" required="required" autofocus>
								-->
								<p class="errorestado_fisico_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">estado_sanitario_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="estado_sanitario_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($estado_sanitario_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=estado_sanitario_id_mass" required="required" autofocus>
								-->
								<p class="errorestado_sanitario_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">concepto_tecnico_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="concepto_tecnico_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($concepto_tecnico_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=concepto_tecnico_id_mass" required="required" autofocus>
								-->
								<p class="errorconcepto_tecnico_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">comuna_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="comuna_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($comuna_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=comuna_id_mass" required="required" autofocus>
								-->
								<p class="errorcomuna_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">barrio_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="barrio_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($barrio_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=barrio_id_mass" required="required" autofocus>
								-->
								<p class="errorbarrio_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">municipios_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="municipios_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($municipios_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=municipios_id_mass" required="required" autofocus>
								-->
								<p class="errormunicipios_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">especie_arboles_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="especie_arboles_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($especie_arboles_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=especie_arboles_id_mass" required="required" autofocus>
								-->
								<p class="errorespecie_arboles_id text-center alert alert-danger hidden"> llenar los datos</p>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-2" for="descripcion">Entidad_municipal_id:</label>
							<div class="col-sm-10">
								
								<select class="form-control" id="Entidad_municipal_id_mass" required="required" autofocus >
 									<option value=""></option>

 								@foreach($Entidad_municipal_id as $lists)
  									<option value="{{$lists->id}}">{{$lists->nombre}}</option>
								@endforeach
								
								</select>
								<!--
								<input type="select" class="form-control" id=Entidad_municipal_id_mass" required="required" autofocus>
								-->
								<p class="errorEntidad_municipal_id text-center alert alert-danger hidden"> llenar los datos</p>
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
@section('page-js-files') 
@stop 
@section('page-js-script')

	<script>
		$(document).ready(function(){
	    	$("#postTable").DataTable();
		});

		$(window).load(function(){
			$("#postTable").removeAttr("style");
		})
	</script>

			
<script type='text/javascript'>
			<?php echo "const  Foraestado_fisico_id= $estado_fisico_id;"; ?>
			<?php echo "const  Foraestado_sanitario_id= $estado_sanitario_id;"; ?>
			<?php echo "const  Foraconcepto_tecnico_id= $concepto_tecnico_id;"; ?>
			<?php echo "const  Foracomuna_id= $comuna_id;"; ?>
			<?php echo "const  Forabarrio_id= $barrio_id;"; ?>
			<?php echo "const  Foramunicipios_id= $municipios_id;"; ?>
			<?php echo "const  Foraespecie_arboles_id= $especie_arboles_id;"; ?>
			<?php echo "const  ForaEntidad_municipal_id= $Entidad_municipal_id;"; ?>
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
$('#fecha_mass').val($(this).data('fecha'));
$('#codigo_mass').val($(this).data('codigo'));
$('#nom_cientifico_mass').val($(this).data('nom_cientifico'));
$('#arbol_num_mass').val($(this).data('arbol_num'));
$('#coodenadas_x_mass').val($(this).data('coodenadas_x'));
$('#coodenadas_y_mass').val($(this).data('coodenadas_y'));
$('#di_dap_mass').val($(this).data('di_dap'));
$('#di_altura_mass').val($(this).data('di_altura'));
$('#di_podar_mass').val($(this).data('di_podar'));
$('#di_ecuatorial_mass').val($(this).data('di_ecuatorial'));
$('#estado_fisico_id_mass').val($(this).data('estado_fisico_id'));
$('#estado_sanitario_id_mass').val($(this).data('estado_sanitario_id'));
$('#concepto_tecnico_id_mass').val($(this).data('concepto_tecnico_id'));
$('#comuna_id_mass').val($(this).data('comuna_id'));
$('#barrio_id_mass').val($(this).data('barrio_id'));
$('#municipios_id_mass').val($(this).data('municipios_id'));
$('#especie_arboles_id_mass').val($(this).data('especie_arboles_id'));
$('#Entidad_municipal_id_mass').val($(this).data('Entidad_municipal_id'));
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
$('#fecha_mass').val($(this).data('fecha'));
$('#codigo_mass').val($(this).data('codigo'));
$('#nom_cientifico_mass').val($(this).data('nom_cientifico'));
$('#arbol_num_mass').val($(this).data('arbol_num'));
$('#coodenadas_x_mass').val($(this).data('coodenadas_x'));
$('#coodenadas_y_mass').val($(this).data('coodenadas_y'));
$('#di_dap_mass').val($(this).data('di_dap'));
$('#di_altura_mass').val($(this).data('di_altura'));
$('#di_podar_mass').val($(this).data('di_podar'));
$('#di_ecuatorial_mass').val($(this).data('di_ecuatorial'));
$('#estado_fisico_id_mass').val($(this).data('estado_fisico_id'));
$('#estado_sanitario_id_mass').val($(this).data('estado_sanitario_id'));
$('#concepto_tecnico_id_mass').val($(this).data('concepto_tecnico_id'));
$('#comuna_id_mass').val($(this).data('comuna_id'));
$('#barrio_id_mass').val($(this).data('barrio_id'));
$('#municipios_id_mass').val($(this).data('municipios_id'));
$('#especie_arboles_id_mass').val($(this).data('especie_arboles_id'));
$('#Entidad_municipal_id_mass').val($(this).data('Entidad_municipal_id'));
;
			$('#massModal').modal('show');
			id = $('#id_mass').val();           
			$('#acciones').attr('class', 'btn btn-danger delete');
			$('#acciones').text('Delete');
		});
		$('.modal-footer').on('click', '.delete', function() {
			$.ajax({
				type: 'DELETE',
				url: 'Ficha_Arboles/'+id,
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
			$.ajax({
				type: 'POST',
				url: 'Ficha_Arboles',
				data: {

				'id': $('#id_mass').val(),'fecha': $('#fecha_mass').val(),'codigo': $('#codigo_mass').val(),'nom_cientifico': $('#nom_cientifico_mass').val(),'arbol_num': $('#arbol_num_mass').val(),'coodenadas_x': $('#coodenadas_x_mass').val(),'coodenadas_y': $('#coodenadas_y_mass').val(),'di_dap': $('#di_dap_mass').val(),'di_altura': $('#di_altura_mass').val(),'di_podar': $('#di_podar_mass').val(),'di_ecuatorial': $('#di_ecuatorial_mass').val(),'estado_fisico_id': $('#estado_fisico_id_mass').val(),'estado_sanitario_id': $('#estado_sanitario_id_mass').val(),'concepto_tecnico_id': $('#concepto_tecnico_id_mass').val(),'comuna_id': $('#comuna_id_mass').val(),'barrio_id': $('#barrio_id_mass').val(),'municipios_id': $('#municipios_id_mass').val(),'especie_arboles_id': $('#especie_arboles_id_mass').val(),'Entidad_municipal_id': $('#Entidad_municipal_id_mass').val(),

					'_token': $('input[name=_token]').val(),
				},
				success: function(data) {
				   
					$('.errorid').addClass('hidden');$('.errorfecha').addClass('hidden');$('.errorcodigo').addClass('hidden');$('.errornom_cientifico').addClass('hidden');$('.errorarbol_num').addClass('hidden');$('.errorcoodenadas_x').addClass('hidden');$('.errorcoodenadas_y').addClass('hidden');$('.errordi_dap').addClass('hidden');$('.errordi_altura').addClass('hidden');$('.errordi_podar').addClass('hidden');$('.errordi_ecuatorial').addClass('hidden');$('.errorestado_fisico_id').addClass('hidden');$('.errorestado_sanitario_id').addClass('hidden');$('.errorconcepto_tecnico_id').addClass('hidden');$('.errorcomuna_id').addClass('hidden');$('.errorbarrio_id').addClass('hidden');$('.errormunicipios_id').addClass('hidden');$('.errorespecie_arboles_id').addClass('hidden');$('.errorEntidad_municipal_id').addClass('hidden');;
					if ((data.errors)) {
						setTimeout(function () {
							$('#massModal').modal('show');
							toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
						}, 500);

						$('.errorid').removeClass('hidden');$('.errorid').text(data.errors.id);$('.errorfecha').removeClass('hidden');$('.errorfecha').text(data.errors.fecha);$('.errorcodigo').removeClass('hidden');$('.errorcodigo').text(data.errors.codigo);$('.errornom_cientifico').removeClass('hidden');$('.errornom_cientifico').text(data.errors.nom_cientifico);$('.errorarbol_num').removeClass('hidden');$('.errorarbol_num').text(data.errors.arbol_num);$('.errorcoodenadas_x').removeClass('hidden');$('.errorcoodenadas_x').text(data.errors.coodenadas_x);$('.errorcoodenadas_y').removeClass('hidden');$('.errorcoodenadas_y').text(data.errors.coodenadas_y);$('.errordi_dap').removeClass('hidden');$('.errordi_dap').text(data.errors.di_dap);$('.errordi_altura').removeClass('hidden');$('.errordi_altura').text(data.errors.di_altura);$('.errordi_podar').removeClass('hidden');$('.errordi_podar').text(data.errors.di_podar);$('.errordi_ecuatorial').removeClass('hidden');$('.errordi_ecuatorial').text(data.errors.di_ecuatorial);$('.errorestado_fisico_id').removeClass('hidden');$('.errorestado_fisico_id').text(data.errors.estado_fisico_id);$('.errorestado_sanitario_id').removeClass('hidden');$('.errorestado_sanitario_id').text(data.errors.estado_sanitario_id);$('.errorconcepto_tecnico_id').removeClass('hidden');$('.errorconcepto_tecnico_id').text(data.errors.concepto_tecnico_id);$('.errorcomuna_id').removeClass('hidden');$('.errorcomuna_id').text(data.errors.comuna_id);$('.errorbarrio_id').removeClass('hidden');$('.errorbarrio_id').text(data.errors.barrio_id);$('.errormunicipios_id').removeClass('hidden');$('.errormunicipios_id').text(data.errors.municipios_id);$('.errorespecie_arboles_id').removeClass('hidden');$('.errorespecie_arboles_id').text(data.errors.especie_arboles_id);$('.errorEntidad_municipal_id').removeClass('hidden');$('.errorEntidad_municipal_id').text(data.errors.Entidad_municipal_id);;
					} else {
						toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
						
						//var a = solicitudetipo.indexOf(data.id_tipo);
						//a++;
						//var e = solicitudestado.indexOf(data.id_estado);
						//e++;
						
//add
const resulestado_fisico_id=Foraestado_fisico_id.find( cas => cas.id == data.estado_fisico_id ); 
				const resulestado_sanitario_id=Foraestado_sanitario_id.find( cas => cas.id == data.estado_sanitario_id ); 
				const resulconcepto_tecnico_id=Foraconcepto_tecnico_id.find( cas => cas.id == data.concepto_tecnico_id ); 
				const resulcomuna_id=Foracomuna_id.find( cas => cas.id == data.comuna_id ); 
				const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
				const resulmunicipios_id=Foramunicipios_id.find( cas => cas.id == data.municipios_id ); 
				const resulespecie_arboles_id=Foraespecie_arboles_id.find( cas => cas.id == data.especie_arboles_id ); 
				const resulEntidad_municipal_id=ForaEntidad_municipal_id.find( cas => cas.id == data.Entidad_municipal_id ); 
							$('#postTable').append(
						"<tr class='item"+data.id+"'>"+
			"<td class='col1'>" + data.id + "</td>"+
			"<td>"+ data.fecha+"</td>"+
			"<td>"+ data.codigo+"</td>"+
			"<td>"+ data.nom_cientifico+"</td>"+
			"<td>"+ data.arbol_num+"</td>"+
			"<td>"+ data.coodenadas_x+"</td>"+
			"<td>"+ data.coodenadas_y+"</td>"+
			"<td>"+ data.di_dap+"</td>"+
			"<td>"+ data.di_altura+"</td>"+
			"<td>"+ data.di_podar+"</td>"+
			"<td>"+ data.di_ecuatorial+"</td>"+
			"<td>"+ resulestado_fisico_id["nombre"]  +"</td>"+
			"<td>"+ resulestado_sanitario_id["nombre"]  +"</td>"+
			"<td>"+ resulconcepto_tecnico_id["nombre"]  +"</td>"+
			"<td>"+ resulcomuna_id["nombre"]  +"</td>"+
			"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
			"<td>"+ resulmunicipios_id["nombre"]  +"</td>"+
			"<td>"+ resulespecie_arboles_id["nombre"]  +"</td>"+
			"<td>"+ resulEntidad_municipal_id["nombre"]  +"</td>"+
			
						'  <td>Ahorra</td><td> '+
				@can('Ficha_Arboles Show')
						' <button class="massshow-modal btn btn-success"  ' + 
						"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
						"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
				@endcan
				@can('Ficha_Arboles Editar')

						" <button class='edit-modal btn btn-info' "+
						"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
						"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
				@endcan
				@can('Ficha_Arboles Eliminar')		
						" ' <button class='massdelete-modal btn btn-danger' ' " +
						"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
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
			$("#fecha_mass").val($(this).data("fecha"));
			$("#codigo_mass").val($(this).data("codigo"));
			$("#nom_cientifico_mass").val($(this).data("nom_cientifico"));
			$("#arbol_num_mass").val($(this).data("arbol_num"));
			$("#coodenadas_x_mass").val($(this).data("coodenadas_x"));
			$("#coodenadas_y_mass").val($(this).data("coodenadas_y"));
			$("#di_dap_mass").val($(this).data("di_dap"));
			$("#di_altura_mass").val($(this).data("di_altura"));
			$("#di_podar_mass").val($(this).data("di_podar"));
			$("#di_ecuatorial_mass").val($(this).data("di_ecuatorial"));
			$("#estado_fisico_id_mass").val($(this).data("estado_fisico_id"));
			$("#estado_sanitario_id_mass").val($(this).data("estado_sanitario_id"));
			$("#concepto_tecnico_id_mass").val($(this).data("concepto_tecnico_id"));
			$("#comuna_id_mass").val($(this).data("comuna_id"));
			$("#barrio_id_mass").val($(this).data("barrio_id"));
			$("#municipios_id_mass").val($(this).data("municipios_id"));
			$("#especie_arboles_id_mass").val($(this).data("especie_arboles_id"));
			$("#Entidad_municipal_id_mass").val($(this).data("Entidad_municipal_id"));
			

			id = $('#id_mass').val();
			$('#acciones').attr('class', 'btn btn-warning edit');
			$('#acciones').text('Editar');
			$('.modal-descripcion').text('Editar un Dato');
			$('#massModal').modal('show');
			$('#msdelete').text(' ');
		});

			


			$('.modal-footer').on('click', '.edit', function() {
				$.ajax({
					type: 'PUT',
					url: 'Ficha_Arboles/' + id,
					data: {
			'id': $('#id_mass').val(),
			'fecha': $('#fecha_mass').val(),
			'codigo': $('#codigo_mass').val(),
			'nom_cientifico': $('#nom_cientifico_mass').val(),
			'arbol_num': $('#arbol_num_mass').val(),
			'coodenadas_x': $('#coodenadas_x_mass').val(),
			'coodenadas_y': $('#coodenadas_y_mass').val(),
			'di_dap': $('#di_dap_mass').val(),
			'di_altura': $('#di_altura_mass').val(),
			'di_podar': $('#di_podar_mass').val(),
			'di_ecuatorial': $('#di_ecuatorial_mass').val(),
			'estado_fisico_id': $('#estado_fisico_id_mass').val(),
			'estado_sanitario_id': $('#estado_sanitario_id_mass').val(),
			'concepto_tecnico_id': $('#concepto_tecnico_id_mass').val(),
			'comuna_id': $('#comuna_id_mass').val(),
			'barrio_id': $('#barrio_id_mass').val(),
			'municipios_id': $('#municipios_id_mass').val(),
			'especie_arboles_id': $('#especie_arboles_id_mass').val(),
			'Entidad_municipal_id': $('#Entidad_municipal_id_mass').val(),
			'_token': $('input[name=_token]').val()
				}, 
			success: function(data) {
			$('.errorid').addClass('hidden');
			$('.errorfecha').addClass('hidden');
			$('.errorcodigo').addClass('hidden');
			$('.errornom_cientifico').addClass('hidden');
			$('.errorarbol_num').addClass('hidden');
			$('.errorcoodenadas_x').addClass('hidden');
			$('.errorcoodenadas_y').addClass('hidden');
			$('.errordi_dap').addClass('hidden');
			$('.errordi_altura').addClass('hidden');
			$('.errordi_podar').addClass('hidden');
			$('.errordi_ecuatorial').addClass('hidden');
			$('.errorestado_fisico_id').addClass('hidden');
			$('.errorestado_sanitario_id').addClass('hidden');
			$('.errorconcepto_tecnico_id').addClass('hidden');
			$('.errorcomuna_id').addClass('hidden');
			$('.errorbarrio_id').addClass('hidden');
			$('.errormunicipios_id').addClass('hidden');
			$('.errorespecie_arboles_id').addClass('hidden');
			$('.errorEntidad_municipal_id').addClass('hidden');
				 
			if ((data.errors)) {
				setTimeout(function () {
					$('#editModal').modal('show');
					toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
				}, 500);
			
				if (data.errors.id) {
                	$(".error.id").removeClass("hidden");
                	$(".error.id").text(data.errorsid);
                }
				if (data.errors.fecha) {
                	$(".error.fecha").removeClass("hidden");
                	$(".error.fecha").text(data.errorsfecha);
                }
				if (data.errors.codigo) {
                	$(".error.codigo").removeClass("hidden");
                	$(".error.codigo").text(data.errorscodigo);
                }
				if (data.errors.nom_cientifico) {
                	$(".error.nom_cientifico").removeClass("hidden");
                	$(".error.nom_cientifico").text(data.errorsnom_cientifico);
                }
				if (data.errors.arbol_num) {
                	$(".error.arbol_num").removeClass("hidden");
                	$(".error.arbol_num").text(data.errorsarbol_num);
                }
				if (data.errors.coodenadas_x) {
                	$(".error.coodenadas_x").removeClass("hidden");
                	$(".error.coodenadas_x").text(data.errorscoodenadas_x);
                }
				if (data.errors.coodenadas_y) {
                	$(".error.coodenadas_y").removeClass("hidden");
                	$(".error.coodenadas_y").text(data.errorscoodenadas_y);
                }
				if (data.errors.di_dap) {
                	$(".error.di_dap").removeClass("hidden");
                	$(".error.di_dap").text(data.errorsdi_dap);
                }
				if (data.errors.di_altura) {
                	$(".error.di_altura").removeClass("hidden");
                	$(".error.di_altura").text(data.errorsdi_altura);
                }
				if (data.errors.di_podar) {
                	$(".error.di_podar").removeClass("hidden");
                	$(".error.di_podar").text(data.errorsdi_podar);
                }
				if (data.errors.di_ecuatorial) {
                	$(".error.di_ecuatorial").removeClass("hidden");
                	$(".error.di_ecuatorial").text(data.errorsdi_ecuatorial);
                }
				if (data.errors.estado_fisico_id) {
                	$(".error.estado_fisico_id").removeClass("hidden");
                	$(".error.estado_fisico_id").text(data.errorsestado_fisico_id);
                }
				if (data.errors.estado_sanitario_id) {
                	$(".error.estado_sanitario_id").removeClass("hidden");
                	$(".error.estado_sanitario_id").text(data.errorsestado_sanitario_id);
                }
				if (data.errors.concepto_tecnico_id) {
                	$(".error.concepto_tecnico_id").removeClass("hidden");
                	$(".error.concepto_tecnico_id").text(data.errorsconcepto_tecnico_id);
                }
				if (data.errors.comuna_id) {
                	$(".error.comuna_id").removeClass("hidden");
                	$(".error.comuna_id").text(data.errorscomuna_id);
                }
				if (data.errors.barrio_id) {
                	$(".error.barrio_id").removeClass("hidden");
                	$(".error.barrio_id").text(data.errorsbarrio_id);
                }
				if (data.errors.municipios_id) {
                	$(".error.municipios_id").removeClass("hidden");
                	$(".error.municipios_id").text(data.errorsmunicipios_id);
                }
				if (data.errors.especie_arboles_id) {
                	$(".error.especie_arboles_id").removeClass("hidden");
                	$(".error.especie_arboles_id").text(data.errorsespecie_arboles_id);
                }
				if (data.errors.Entidad_municipal_id) {
                	$(".error.Entidad_municipal_id").removeClass("hidden");
                	$(".error.Entidad_municipal_id").text(data.errorsEntidad_municipal_id);
                }
 				} else {
                	toastr.success('Successfully updated Ficha_Arboles!', 'Success Alert', {timeOut: 5000});
                //update

			const resulestado_fisico_id=Foraestado_fisico_id.find( cas => cas.id == data.estado_fisico_id ); 
				const resulestado_sanitario_id=Foraestado_sanitario_id.find( cas => cas.id == data.estado_sanitario_id ); 
				const resulconcepto_tecnico_id=Foraconcepto_tecnico_id.find( cas => cas.id == data.concepto_tecnico_id ); 
				const resulcomuna_id=Foracomuna_id.find( cas => cas.id == data.comuna_id ); 
				const resulbarrio_id=Forabarrio_id.find( cas => cas.id == data.barrio_id ); 
				const resulmunicipios_id=Foramunicipios_id.find( cas => cas.id == data.municipios_id ); 
				const resulespecie_arboles_id=Foraespecie_arboles_id.find( cas => cas.id == data.especie_arboles_id ); 
				const resulEntidad_municipal_id=ForaEntidad_municipal_id.find( cas => cas.id == data.Entidad_municipal_id ); 
				

				$('.item' + data.id).replaceWith(
"<tr class='item"+data.id+"'>"+"<td class='col1'>" + data.id + "</td>"+
				"<td>"+ data.fecha+"</td>"+
				"<td>"+ data.codigo+"</td>"+
				"<td>"+ data.nom_cientifico+"</td>"+
				"<td>"+ data.arbol_num+"</td>"+
				"<td>"+ data.coodenadas_x+"</td>"+
				"<td>"+ data.coodenadas_y+"</td>"+
				"<td>"+ data.di_dap+"</td>"+
				"<td>"+ data.di_altura+"</td>"+
				"<td>"+ data.di_podar+"</td>"+
				"<td>"+ data.di_ecuatorial+"</td>"+
				"<td>"+ resulestado_fisico_id["nombre"]  +"</td>"+
				"<td>"+ resulestado_sanitario_id["nombre"]  +"</td>"+
				"<td>"+ resulconcepto_tecnico_id["nombre"]  +"</td>"+
				"<td>"+ resulcomuna_id["nombre"]  +"</td>"+
				"<td>"+ resulbarrio_id["nombre"]  +"</td>"+
				"<td>"+ resulmunicipios_id["nombre"]  +"</td>"+
				"<td>"+ resulespecie_arboles_id["nombre"]  +"</td>"+
				"<td>"+ resulEntidad_municipal_id["nombre"]  +"</td>"+
				
			'  <td>Ahorra</td><td> '+			
			
			@can('Ficha_Arboles Show') 
				' <button class="massshow-modal btn btn-success"  ' + 
				"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
				"'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
			@endcan			
			
			@can('Ficha_Arboles Editar')
				" <button class='edit-modal btn btn-info' "+
				"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
				"'><span class='glyphicon glyphicon-edit'></span> Editar</button> ' "+ 
			@endcan

			@can('Ficha_Arboles Eliminar') 
				"'<button class='massdelete-modal btn btn-danger' ' " +
				"' data-id='"+ data.id+
						"' data-fecha='"+ data.fecha+
						"' data-codigo='"+ data.codigo+
						"' data-nom_cientifico='"+ data.nom_cientifico+
						"' data-arbol_num='"+ data.arbol_num+
						"' data-coodenadas_x='"+ data.coodenadas_x+
						"' data-coodenadas_y='"+ data.coodenadas_y+
						"' data-di_dap='"+ data.di_dap+
						"' data-di_altura='"+ data.di_altura+
						"' data-di_podar='"+ data.di_podar+
						"' data-di_ecuatorial='"+ data.di_ecuatorial+
						"' data-estado_fisico_id='"+ data.estado_fisico_id+
						"' data-estado_sanitario_id='"+ data.estado_sanitario_id+
						"' data-concepto_tecnico_id='"+ data.concepto_tecnico_id+
						"' data-comuna_id='"+ data.comuna_id+
						"' data-barrio_id='"+ data.barrio_id+
						"' data-municipios_id='"+ data.municipios_id+
						"' data-especie_arboles_id='"+ data.especie_arboles_id+
						"' data-Entidad_municipal_id='"+ data.Entidad_municipal_id+
						 
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

	</script>

@stop

</body>
</html>










