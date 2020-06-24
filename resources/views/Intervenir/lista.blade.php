@extends('layouts.app')
<meta charset="utf-8"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="{{ asset('images/favicon.jpg') }}" rel="shortcut icon"/>
<meta content="{{ csrf_token() }}" name="_token"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
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
                            @can('Intervenir Add')
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
                                        Codigo del Arboles
                                    </th>
                                    <th>
                                        Numero récord
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
                                        Acciones
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
                                        <script type="text/javascript">
                                            resulmunicipios_id=Foraarboles_id.find( cas => cas.id == {{ $lists->arboles_id }} );
                                            document.write(resulmunicipios_id.nombre);
                                        </script>
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
                                        @can('Intervenir Show')
                                        <button class="massshow-modal btn btn-success" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-estado_id="{{ $lists->estado_id}}" data-foto_record="{{ $lists->foto_record}}" data-id="{{ $lists->id}}" data-numero_record="{{ $lists->numero_record}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                                            <span class="glyphicon glyphicon-eye-open">
                                            </span>
                                            Ver
                                        </button>
                                        @endcan     
                        @can('Intervenir Editar')
                                        <button class="edit-modal btn btn-info" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-estado_id="{{ $lists->estado_id}}" data-foto_record="{{ $lists->foto_record}}" data-id="{{ $lists->id}}" data-numero_record="{{ $lists->numero_record}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                                            <span class="glyphicon glyphicon-edit">
                                            </span>
                                            Editar
                                        </button>
                                        @endcan
                        @can('Intervenir Eliminar')
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
                </div>
            </div>
        </div>
    </div>
</section>
<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-codigo">
                Lista de Arboles con asistencias
            </h3>
        </div>
        <div class="box-body">
            <div class="">
                <div id="floating-panel">
                </div>
                <div id="map">
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel panel-default -->
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
<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWVmumfMZzD3VNw8RBjpoBt9RKfv7w8Wk&callback=initMap">
</script>
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
                    <!-- 
                        <div class='form-group'>
                            <label class='control-label col-sm-2' for='descripcion'>id:</label>
                            <div class='col-sm-10'>
                            -->
                    <input autofocus="" class="" id="id_mass" required="required" type="hidden">
                        <!--
                                <p class='errorid text-center alert alert-danger hidden'></p>
                            </div>
                        </div>
                            
                                <select  style="visibility:hidden"  class="form-control" id="arboles_id_mass"  required="required" autofocus >
                                @foreach($arboles_id as $lists)
                                    <option value="{{$lists->id}}">{{$lists->nombre}}</option>
                                @endforeach
                                </select>
                        -->
                        <input autofocus="" class="form-control" id="arboles_id_mass" required="required" type="hidden" value="{{$id_arbol}}">
                            <!--
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">arboles_id:</label>
                            <div class="col-sm-10">
                                -->
                            <!--
                                <p class="errorarboles_id text-center alert alert-danger hidden"> llenar los datos</p>
                            </div>
                        </div>
                                -->
                            <div class="form-group" id="numero_record">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Numero de record:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control input-number-line" id="numero_record_mass" maxlength="10" required="required" type="text">
                                        <p class="errornumero_record text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="foto_record">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Foto de record:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="foto_record_mass" maxlength="30" name="foto_record" required="required" type="hidden">
                                        <input autofocus="" class="form-control" id="foto_record_mass_file" maxlength="30" name="foto_record_file" required="required" type="file">
                                            <p class="errorfoto_record text-center alert alert-danger hidden">
                                            </p>
                                        </input>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Tipo de proceso:
                                </label>
                                <div class="col-sm-10">
                                    <select autofocus="" class="form-control busca_select" id="tipo_proceso_id_mass" required="required" style="width: 100%;">
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
                                    Estado:
                                </label>
                                <div class="col-sm-10">
                                    <select autofocus="" class="form-control busca_select" id="estado_id_mass" required="required" style="width: 100%;">
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
                                    Creado en:
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
                                    Modificado en:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="updated_at_mass" readonly="" required="required" type="text">
                                        <p class="errorupdated_at text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                        </input>
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
            $('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id')).trigger('change.select2');
            $('#estado_id_mass').val($(this).data('estado_id')).trigger('change.select2');
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
            $('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id')).trigger('change.select2');
            $('#estado_id_mass').val($(this).data('estado_id')).trigger('change.select2');
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
                url: '../../Intervenir/'+id,
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
            var formData = new FormData($("#formmass")[0]);
            formData.append('id',$('#id_mass').val());
            formData.append('arboles_id',$('#arboles_id_mass').val());
            formData.append('numero_record',$('#numero_record_mass').val());
            //formData.append('foto_record',$('#foto_record_mass').val());
            formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
            formData.append('estado_id',$('#estado_id_mass').val());
            formData.append('created_at',$('#created_at_mass').val());
            formData.append('updated_at',$('#updated_at_mass').val());
            formData.append('_token',$('input[name=_token]').val()); 
            
            $.ajax({
                type: 'POST',
                url: '../../Intervenir/lista/add',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                
                error: function(jqXHR, text, error){
                toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});
                },
                success: function(data) { 
                    if ((data.errors)) {
                        verificar(data);
                        $('#massModal').modal('show');
                        toastr.error('Formato Inválido!', 'En el envió de la verificación de datos <br>', {timeOut: 5000}); 

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
        $("#tipo_proceso_id_mass").val($(this).data("tipo_proceso_id")).trigger('change.select2');
        $("#estado_id_mass").val($(this).data("estado_id")).trigger('change.select2');
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
        
        var formData = new FormData($("#formmass")[0]);
        formData.append('id',$('#id_mass').val());
        formData.append('arboles_id',$('#arboles_id_mass').val());
        formData.append('numero_record',$('#numero_record_mass').val());
        //formData.append('foto_record',$('#foto_record_mass').val());
        formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
        formData.append('estado_id',$('#estado_id_mass').val());
        formData.append('created_at',$('#created_at_mass').val());
        formData.append('updated_at',$('#updated_at_mass').val());
        formData.append('_token',$('input[name=_token]').val()); 


        $.ajax({
            type: 'POST',
            url: '../../Intervenir/editar/' + id,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            error: function(jqXHR, text, error){
                toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>', {timeOut: 5000});    
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
            @foreach($listmysql as $lists){
            coords:{lat:{{$lists->arboles_pk->latitud}},lng:{{$lists->arboles_pk->longitud}}},
            iconImage:'{{asset('imagenes/punto/punto.png')}}',
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
            '<tr><td>Codigo de Record</td><td>{{$lists->numero_record}}</td></tr>'+
            '</table>'+
            '</div>'+
            '<a target="_blank" href="{{ asset('../storage/app/foto_perfil/'.$lists->archivo) }}">'+
            '<img src="{{ asset('../storage/app/foto_perfil/'.$lists->archivo) }}" width="100px" height="100px" ></a>'+
            '</div>'+
                    '<button class="edit-modal btn btn-info"'+ 
                    'data-id="{{$lists->id}}" '+
                    
                    'data-arboles_id="{{$lists->arboles_id}}"'+
                    'data-numero_record="{{$lists->numero_record}}"'+
                    'data-foto_record="{{$lists->foto_record}}"'+
                    'data-tipo_proceso_id="{{$lists->tipo_proceso_id}}"'+
                    'data-estado_id="{{$lists->estado_id}}"'+
                    'data-created_at="{{$lists->created_at}}"'+
                    'data-updated_at="{{$lists->updated_at}}">'+

                    /*
                    $("#id_mass").val($(this).data("id"));
        $("#arboles_id_mass").val($(this).data("arboles_id"));
        $("#numero_record_mass").val($(this).data("numero_record"));
        $("#foto_record_mass").val($(this).data("foto_record"));
        $("#tipo_proceso_id_mass").val($(this).data("tipo_proceso_id"));
        $("#estado_id_mass").val($(this).data("estado_id"));
        $("#created_at_mass").val($(this).data("created_at"));
        $("#updated_at_mass").val($(this).data("updated_at"));

                    */

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
        "<td>"+//+ data.foto_record+
        "<a target='_blank' href='{{ asset('intervenir/')}}/"+data.foto_record+"'>"+
            "<img src='{{ asset('intervenir/') }}/"+data.foto_record+"' width='40px' height='40px'>"+
        "</a>"+
        "</td>"+
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
