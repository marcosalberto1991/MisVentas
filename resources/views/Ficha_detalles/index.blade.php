@extends('layouts.app')
<meta charset="utf-8"/>
<meta content="IE=edge" http-equiv="X-UA-Compatible"/>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<link href="{{ asset('images/favicon.jpg') }}" rel="shortcut icon"/>
<meta content="{{ csrf_token() }}" name="_token"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="styleeheet"/>
<link href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css" rel="stylesheet"/>
<link href="{{ asset('toastr/toastr.min.css') }}" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"/>
<script type="text/javascript">
    <?php echo "const  Foraarboles_id= $arboles_id;"; ?>
            <?php echo "const  Foratipo_proceso_id= $tipo_proceso_id;"; ?>
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
    .table .thead-dark th {
    color: #fff;
    background-color: #4CAF50;
    border-color: #009688;}
    
    .card{    
    border: 1px solid rgba(0,0,0,.125);
    border-radius: .25rem;}

</style>
<script>
</script>
@section('content')
<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-descripcion">
                Lista de Ficha
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
                            @can('Ficha_detalles Add')
                            <a class="massmodal" href="#" id="massadd-modal">
                                <li>
                                    Añadir una Ficha
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
                                        Código árbol
                                    </th>
                                    <th>
                                        DAP
                                    </th>
                                    <th>
                                        Altura total
                                    </th>
                                    <th>
                                        Diámetro mayor de copa
                                    </th>
                                    <th>
                                        Diámetro menor de copa
                                    </th>
                                    <th>
                                        Fecha
                                    </th>
                                    <th>
                                        Código árbol
                                    </th>
                                    <th>
                                        Estado Físico
                                    </th>
                                    <th>
                                        Estado Sanitario
                                    </th>
                                    <th>
                                        Observaciones
                                    </th>
                                    <th>
                                        Responsable
                                    </th>
                                    <th>
                                        Foto general
                                    </th>
                                    <th>
                                        Foto detalle
                                    </th>
                                    <th>
                                        Tipo de proceso
                                    </th>
                                    <th>
                                        Diámetro ecuatorial
                                    </th>
                                    <th>
                                        Updated_at
                                    </th>
                                    <th>
                                        Created_at
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
                                        <script type="text/javascript">
                                            resulmunicipios_id=Foraarboles_id.find( cas => cas.id == {{ $lists->arboles_id }} );
                            document.write(resulmunicipios_id.nombre);
                                        </script>
                                    </td>
                                    <td class="col1">
                                        {{ $lists->dap }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->altura_total }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->diametro_mayor_copa_m }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->diametro_menor_copa_m }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->fecha }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->arbol_num }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->estadofisico }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->estadosanitario }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->observaciones }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->responsable }}
                                    </td>
                                    <td class="col1">
                                        <a href="{{ asset('ficha_detalle_foto/'.$lists->fotogeneral) }}" target="_blank">
                                            <img height="40px" src="{{ asset('ficha_detalle_foto/'.$lists->fotogeneral) }}" width="40px">
                                            </img>
                                        </a>
                                    </td>
                                    <td class="col1">
                                        <a href="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}" target="_blank">
                                            <img height="40px" src="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}" width="40px">
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
                                        {{ $lists->diametro_ecuatorial }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->updated_at }}
                                    </td>
                                    <td class="col1">
                                        {{ $lists->created_at }}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $lists->updated_at)->diffForHumans() }}
                                    </td>
                                    <td>
                                        @can('Ficha_detalles Show')
                                        <button class="massshow-modal btn btn-success" data-altura_total="{{ $lists->altura_total}}" data-arbol_num="{{ $lists->arbol_num}}" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-dap="{{ $lists->dap}}" data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}" data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}" data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}" data-estadofisico="{{ $lists->estadofisico}}" data-estadosanitario="{{ $lists->estadosanitario}}" data-fecha="{{ $lists->fecha}}" data-fotodetalle="{{ $lists->fotodetalle}}" data-fotogeneral="{{ $lists->fotogeneral}}" data-id="{{ $lists->id}}" data-observaciones="{{ $lists->observaciones}}" data-responsable="{{ $lists->responsable}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                                            <span class="glyphicon glyphicon-eye-open">
                                            </span>
                                            Ver
                                        </button>
                                        @endcan     
                        @can('Ficha_detalles Editar')
                                        <button class="edit-modal btn btn-info" data-altura_total="{{ $lists->altura_total}}" data-arbol_num="{{ $lists->arbol_num}}" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-dap="{{ $lists->dap}}" data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}" data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}" data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}" data-estadofisico="{{ $lists->estadofisico}}" data-estadosanitario="{{ $lists->estadosanitario}}" data-fecha="{{ $lists->fecha}}" data-fotodetalle="{{ $lists->fotodetalle}}" data-fotogeneral="{{ $lists->fotogeneral}}" data-id="{{ $lists->id}}" data-observaciones="{{ $lists->observaciones}}" data-responsable="{{ $lists->responsable}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
                                            <span class="glyphicon glyphicon-edit">
                                            </span>
                                            Editar
                                        </button>
                                        @endcan
                        @can('Ficha_detalles Eliminar')
                                        <button class="massdelete-modal btn btn-danger" data-altura_total="{{ $lists->altura_total}}" data-arbol_num="{{ $lists->arbol_num}}" data-arboles_id="{{ $lists->arboles_id}}" data-created_at="{{ $lists->created_at}}" data-dap="{{ $lists->dap}}" data-diametro_ecuatorial="{{ $lists->diametro_ecuatorial}}" data-diametro_mayor_copa_m="{{ $lists->diametro_mayor_copa_m}}" data-diametro_menor_copa_m="{{ $lists->diametro_menor_copa_m}}" data-estadofisico="{{ $lists->estadofisico}}" data-estadosanitario="{{ $lists->estadosanitario}}" data-fecha="{{ $lists->fecha}}" data-fotodetalle="{{ $lists->fotodetalle}}" data-fotogeneral="{{ $lists->fotogeneral}}" data-id="{{ $lists->id}}" data-observaciones="{{ $lists->observaciones}}" data-responsable="{{ $lists->responsable}}" data-tipo_proceso_id="{{ $lists->tipo_proceso_id}}" data-updated_at="{{ $lists->updated_at}}">
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


<section class="col-lg-12 connectedSortable">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-descripcion">
                Lista de Ficha
            </h3>
        </div>
        <div class="box-body">
            @foreach($listmysql as $lists)
            
            <div class="row ">
            <div class="col-lg-4">
                <table class="table table-striped ">
                  <thead>
                    <tr class="thead-dark">
                      <th scope="col">Descripción</th>
                      <th scope="col">Dato</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">Fecha</th>
                      <td>{{ $lists->fecha }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Altura total</th>
                      <td>{{ $lists->altura_total }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Código árbol</th>
                      <td>{{ $lists->arbol_num }}</td>
                    </tr>
                    <tr>
                      <th scope="row">DAP</th>
                      <td>{{ $lists->dap }}</td>
                    </tr>
                   
                  </tbody>
                </table>
                <table class="table table-striped ">
                  <thead>
                    <tr class="thead-dark">
                      <th scope="col">Descripción</th>
                      <th scope="col">Datos</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row ">Estado Físico</th>
                      <td>{{ $lists->estadosanitario_pk->nombre }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Estado Sanitario</th>
                      <td>{{ $lists->estadosanitario_pk->nombre }}</td>
                    </tr>
                    <tr>
                      <th scope="row">Tipo de proceso</th>
                      <td>
                        <script type="text/javascript">
                            resulmunicipios_id=Foratipo_proceso_id.find( cas => cas.id == {{ $lists->tipo_proceso_id }} );
                            document.write(resulmunicipios_id.nombre);
                        </script>
                          

                      </td>
                    </tr>
                    
                   
                  </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <table class="table table-striped ">
                  <thead>
                    <tr class="thead-dark">
                      <th scope="col">Foto General</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                        <th scope="row">
                            <img height="40px" src="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}" width="100%"/>
                            
                        </th>
                    </tr>
                   
                  </tbody>
                </table>
            </div>
             <div class="col-lg-4">
                <table class="table table-striped ">
                  <thead>
                    <tr class="thead-dark">
                      <th scope="col">Foto Detalle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <th scope="row">
                            <img height="40px" src="{{ asset('ficha_detalle_foto/'.$lists->fotodetalle) }}" width="100%"/>
                            
                        </th>
                    </tr>
                   
                  </tbody>
                </table>
            </div>
            </div>

            <hr>

                @endforeach
                
                    <!--
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li>
                                <i class="fa fa-file-text-o">
                                </i>
                                Acciones
                            </li>
                            @can('Ficha_detalles Add')
                            <a class="massmodal" href="#" id="massadd-modal">
                                <li>
                                    Añadir una Ficha
                                </li>
                            </a>
                            @endcan
                        </ul>
                    </div>
                    <div class="panel-body" style="overflow-x:auto;">
                    </div>
                </div>
                    -->
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
                    <!--
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                            </div>
                        </div>
                        -->
                    <input class="form-control" disabled="" id="id_mass" type="hidden">
                        <!-- 
                        <div class='form-group'>
                            <label class='control-label col-sm-2' for='descripcion'>id:</label>
                            <div class='col-sm-10'>
                            -->
                        <input autofocus="" class="form-control" id="id_mass" required="required" type="hidden">
                            <!--
                                <p class='errorid text-center alert alert-danger hidden'></p>
                            </div>
                        </div>
                        -->
                            <!--
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="descripcion">arboles_id:</label>
                            <div class="col-sm-10">
                                
                                <input type="text" class="form-control" id=arboles_id_mass" required="required" autofocus>
                                -->
                            <select autofocus="" class="form-control" id="arboles_id_mass" required="required" style="visibility:hidden" value="{{$id}}">
                                <option value="">
                                </option>
                                @foreach($arboles_id as $lists)
                                <option selected="true" value="{{$lists->id}}">
                                    {{$lists->nombre}}
                                </option>
                                @endforeach
                            </select>
                            <p class="errorarboles_id text-center alert alert-danger hidden">
                                llenar los datos
                            </p>
                            <!--
                            </div>
                        </div>
                        -->
                            <div class="form-group" id="dap">
                                <label class="control-label col-sm-2" for="descripcion">
                                    DAP:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="dap_mass" maxlength="11" required="required" type="text">
                                        <p class="errordap text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="altura_total">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Altura total:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="altura_total_mass" maxlength="11" required="required" type="text">
                                        <p class="erroraltura_total text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="diametro_mayor_copa_m">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Diametro mayor de copa:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="diametro_mayor_copa_m_mass" maxlength="11" required="required" type="text">
                                        <p class="errordiametro_mayor_copa_m text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="diametro_menor_copa_m">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Diametro menor de copa:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="diametro_menor_copa_m_mass" maxlength="11" required="required" type="text">
                                        <p class="errordiametro_menor_copa_m text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="fecha">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Fecha:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="fecha_mass" maxlength="45" required="required" type="text">
                                        <p class="errorfecha text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="arbol_num">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Codigo de arbol:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="arbol_num_mass" maxlength="45" required="required" type="text">
                                        <p class="errorarbol_num text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="estadofisico">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Estado Fisico:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="estadofisico_mass" maxlength="11" required="required" type="text">
                                        <p class="errorestadofisico text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="estadosanitario">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Estado Sanitario:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="estadosanitario_mass" maxlength="11" required="required" type="text">
                                        <p class="errorestadosanitario text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="observaciones">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Observaciones:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="observaciones_mass" maxlength="200" required="required" type="text">
                                        <p class="errorobservaciones text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="responsable">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Responsable:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="responsable_mass" maxlength="45" required="required" type="text">
                                        <p class="errorresponsable text-center alert alert-danger hidden">
                                        </p>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="fotogeneral">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Foto general:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="fotogeneral_mass" maxlength="45" required="required" type="text">
                                        <input autofocus="" class="form-control" id="fotogeneral_mass_file" maxlength="45" name="fotogeneral_mass_file" required="required" type="file">
                                            <p class="errorfotogeneral text-center alert alert-danger hidden">
                                            </p>
                                        </input>
                                    </input>
                                </div>
                            </div>
                            <div class="form-group" id="fotodetalle">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Foto detalle:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="fotodetalle_mass" maxlength="45" required="required" type="text">
                                        <input autofocus="" class="form-control" id="fotodetalle_mass_file" maxlength="45" name="fotodetalle_mass_file" required="required" type="file">
                                            <p class="errorfotodetalle text-center alert alert-danger hidden">
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
                                    <select autofocus="" class="form-control" id="tipo_proceso_id_mass" required="required">
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
                            <div class="form-group" id="diametro_ecuatorial">
                                <label class="control-label col-sm-2" for="descripcion">
                                    Diametro ecuatorial:
                                </label>
                                <div class="col-sm-10">
                                    <input autofocus="" class="form-control" id="diametro_ecuatorial_mass" maxlength="112" required="required" type="text">
                                        <p class="errordiametro_ecuatorial text-center alert alert-danger hidden">
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
                        </input>
                    </input>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-primary mass" data-dismiss="modal" id="acciones" type="button">
                        <span class="glyphicon glyphicon-check">
                        </span>
                        Ver
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
            $('#dap_mass').val($(this).data('dap'));
            $('#altura_total_mass').val($(this).data('altura_total'));
            $('#diametro_mayor_copa_m_mass').val($(this).data('diametro_mayor_copa_m'));
            $('#diametro_menor_copa_m_mass').val($(this).data('diametro_menor_copa_m'));
            $('#fecha_mass').val($(this).data('fecha'));
            $('#arbol_num_mass').val($(this).data('arbol_num'));
            $('#estadofisico_mass').val($(this).data('estadofisico'));
            $('#estadosanitario_mass').val($(this).data('estadosanitario'));
            $('#observaciones_mass').val($(this).data('observaciones'));
            $('#responsable_mass').val($(this).data('responsable'));
            $('#fotogeneral_mass').val($(this).data('fotogeneral'));
            $('#fotodetalle_mass').val($(this).data('fotodetalle'));
            $('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
            $('#diametro_ecuatorial_mass').val($(this).data('diametro_ecuatorial'));
            $('#updated_at_mass').val($(this).data('updated_at'));
            $('#created_at_mass').val($(this).data('created_at'));
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
            $('#dap_mass').val($(this).data('dap'));
            $('#altura_total_mass').val($(this).data('altura_total'));
            $('#diametro_mayor_copa_m_mass').val($(this).data('diametro_mayor_copa_m'));
            $('#diametro_menor_copa_m_mass').val($(this).data('diametro_menor_copa_m'));
            $('#fecha_mass').val($(this).data('fecha'));
            $('#arbol_num_mass').val($(this).data('arbol_num'));
            $('#estadofisico_mass').val($(this).data('estadofisico'));
            $('#estadosanitario_mass').val($(this).data('estadosanitario'));
            $('#observaciones_mass').val($(this).data('observaciones'));
            $('#responsable_mass').val($(this).data('responsable'));
            $('#fotogeneral_mass').val($(this).data('fotogeneral'));
            $('#fotodetalle_mass').val($(this).data('fotodetalle'));
            $('#tipo_proceso_id_mass').val($(this).data('tipo_proceso_id'));
            $('#diametro_ecuatorial_mass').val($(this).data('diametro_ecuatorial'));
            $('#updated_at_mass').val($(this).data('updated_at'));
            $('#created_at_mass').val($(this).data('created_at'));
            ;
            $('#massModal').modal('show');
            id = $('#id_mass').val();           
            $('#acciones').attr('class', 'btn btn-danger delete');
            $('#acciones').text('Eliminar');
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'Post',
                url: '../../FichaDetalles/delete/'+id,

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
            formData.append('arboles_id',$('#arboles_id_mass').val());
            formData.append('dap',$('#dap_mass').val());
            formData.append('altura_total',$('#altura_total_mass').val());
            formData.append('diametro_mayor_copa_m',$('#diametro_mayor_copa_m_mass').val());
            formData.append('diametro_menor_copa_m',$('#diametro_menor_copa_m_mass').val());
            formData.append('fecha',$('#fecha_mass').val());
            formData.append('arbol_num',$('#arbol_num_mass').val());
            formData.append('estadofisico',$('#estadofisico_mass').val());
            formData.append('estadosanitario',$('#estadosanitario_mass').val());
            formData.append('observaciones',$('#observaciones_mass').val());
            formData.append('responsable',$('#responsable_mass').val());
            formData.append('fotogeneral',$('#fotogeneral_mass').val());
            formData.append('fotodetalle',$('#fotodetalle_mass').val());
            formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
            formData.append('diametro_ecuatorial',$('#diametro_ecuatorial_mass').val());
            formData.append('updated_at',$('#updated_at_mass').val());
            formData.append('created_at',$('#created_at_mass').val());
            formData.append('_token',$('input[name=_token]').val()); 

            $.ajax({
                type: 'post',
                url: '../store',
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
        $("#dap_mass").val($(this).data("dap"));
        $("#altura_total_mass").val($(this).data("altura_total"));
        $("#diametro_mayor_copa_m_mass").val($(this).data("diametro_mayor_copa_m"));
        $("#diametro_menor_copa_m_mass").val($(this).data("diametro_menor_copa_m"));
        $("#fecha_mass").val($(this).data("fecha"));
        $("#arbol_num_mass").val($(this).data("arbol_num"));
        $("#estadofisico_mass").val($(this).data("estadofisico"));
        $("#estadosanitario_mass").val($(this).data("estadosanitario"));
        $("#observaciones_mass").val($(this).data("observaciones"));
        $("#responsable_mass").val($(this).data("responsable"));
        $("#fotogeneral_mass").val($(this).data("fotogeneral"));
        $("#fotodetalle_mass").val($(this).data("fotodetalle"));
        $("#tipo_proceso_id_mass").val($(this).data("tipo_proceso_id"));
        $("#diametro_ecuatorial_mass").val($(this).data("diametro_ecuatorial"));
        $("#updated_at_mass").val($(this).data("updated_at"));
        $("#created_at_mass").val($(this).data("created_at"));
        
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
        formData.append('dap',$('#dap_mass').val());
        formData.append('altura_total',$('#altura_total_mass').val());
        formData.append('diametro_mayor_copa_m',$('#diametro_mayor_copa_m_mass').val());
        formData.append('diametro_menor_copa_m',$('#diametro_menor_copa_m_mass').val());
        formData.append('fecha',$('#fecha_mass').val());
        formData.append('arbol_num',$('#arbol_num_mass').val());
        formData.append('estadofisico',$('#estadofisico_mass').val());
        formData.append('estadosanitario',$('#estadosanitario_mass').val());
        formData.append('observaciones',$('#observaciones_mass').val());
        formData.append('responsable',$('#responsable_mass').val());
        formData.append('fotogeneral',$('#fotogeneral_mass').val());
        formData.append('fotodetalle',$('#fotodetalle_mass').val());
        formData.append('tipo_proceso_id',$('#tipo_proceso_id_mass').val());
        formData.append('diametro_ecuatorial',$('#diametro_ecuatorial_mass').val());
        formData.append('updated_at',$('#updated_at_mass').val());
        formData.append('created_at',$('#created_at_mass').val());
        formData.append('_token',$('input[name=_token]').val()); 


            /*
            'id': $('#id_mass').val(),
            'arboles_id': $('#arboles_id_mass').val(),
            'dap': $('#dap_mass').val(),
            'altura_total': $('#altura_total_mass').val(),
            'diametro_mayor_copa_m': $('#diametro_mayor_copa_m_mass').val(),
            'diametro_menor_copa_m': $('#diametro_menor_copa_m_mass').val(),
            'fecha': $('#fecha_mass').val(),
            'arbol_num': $('#arbol_num_mass').val(),
            'estadofisico': $('#estadofisico_mass').val(),
            'estadosanitario': $('#estadosanitario_mass').val(),
            'observaciones': $('#observaciones_mass').val(),
            'responsable': $('#responsable_mass').val(),
            'fotogeneral': $('#fotogeneral_mass').val(),
            'fotodetalle': $('#fotodetalle_mass').val(),
            'tipo_proceso_id': $('#tipo_proceso_id_mass').val(),
            'diametro_ecuatorial': $('#diametro_ecuatorial_mass').val(),
            'updated_at': $('#updated_at_mass').val(),
            'created_at': $('#created_at_mass').val(),
            */
        $.ajax({
            type: 'Post',
            url: '../update/'+id,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            error: function(jqXHR, text, error){
                toastr.error('Error de operación!', 'No se pudo Añadir los datos<br>'+error, {timeOut: 5000});  
            },
            success: function(data) {

                if(data.errors){
                    verificar(data);
                    toastr.error('Formato Inválido!', 'Formato invalido en el formulario <br>', {timeOut: 5000});   
                    $('#massModal').modal('show');
                    } else {
                    toastr.success('Modificación Exitosa Ficha_detalles!', 'Datos Modificados', {timeOut: 5000});
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
    $('.errordap').addClass('hidden');
    $('.erroraltura_total').addClass('hidden');
    $('.errordiametro_mayor_copa_m').addClass('hidden');
    $('.errordiametro_menor_copa_m').addClass('hidden');
    $('.errorfecha').addClass('hidden');
    $('.errorarbol_num').addClass('hidden');
    $('.errorestadofisico').addClass('hidden');
    $('.errorestadosanitario').addClass('hidden');
    $('.errorobservaciones').addClass('hidden');
    $('.errorresponsable').addClass('hidden');
    $('.errorfotogeneral').addClass('hidden');
    $('.errorfotodetalle').addClass('hidden');
    $('.errortipo_proceso_id').addClass('hidden');
    $('.errordiametro_ecuatorial').addClass('hidden');
    $('.errorupdated_at').addClass('hidden');
    $('.errorcreated_at').addClass('hidden');

    if (data.errors.id) {
        $(".errorid").removeClass("hidden");
        $(".errorid").text(data.errors.id);
    }
    
    if (data.errors.arboles_id) {
        $(".errorarboles_id").removeClass("hidden");
        $(".errorarboles_id").text(data.errors.arboles_id);
    }
    
    if (data.errors.dap) {
        $(".errordap").removeClass("hidden");
        $(".errordap").text(data.errors.dap);
    }
    
    if (data.errors.altura_total) {
        $(".erroraltura_total").removeClass("hidden");
        $(".erroraltura_total").text(data.errors.altura_total);
    }
    
    if (data.errors.diametro_mayor_copa_m) {
        $(".errordiametro_mayor_copa_m").removeClass("hidden");
        $(".errordiametro_mayor_copa_m").text(data.errors.diametro_mayor_copa_m);
    }
    
    if (data.errors.diametro_menor_copa_m) {
        $(".errordiametro_menor_copa_m").removeClass("hidden");
        $(".errordiametro_menor_copa_m").text(data.errors.diametro_menor_copa_m);
    }
    
    if (data.errors.fecha) {
        $(".errorfecha").removeClass("hidden");
        $(".errorfecha").text(data.errors.fecha);
    }
    
    if (data.errors.arbol_num) {
        $(".errorarbol_num").removeClass("hidden");
        $(".errorarbol_num").text(data.errors.arbol_num);
    }
    
    if (data.errors.estadofisico) {
        $(".errorestadofisico").removeClass("hidden");
        $(".errorestadofisico").text(data.errors.estadofisico);
    }
    
    if (data.errors.estadosanitario) {
        $(".errorestadosanitario").removeClass("hidden");
        $(".errorestadosanitario").text(data.errors.estadosanitario);
    }
    
    if (data.errors.observaciones) {
        $(".errorobservaciones").removeClass("hidden");
        $(".errorobservaciones").text(data.errors.observaciones);
    }
    
    if (data.errors.responsable) {
        $(".errorresponsable").removeClass("hidden");
        $(".errorresponsable").text(data.errors.responsable);
    }
    
    if (data.errors.fotogeneral) {
        $(".errorfotogeneral").removeClass("hidden");
        $(".errorfotogeneral").text(data.errors.fotogeneral);
    }
    
    if (data.errors.fotodetalle) {
        $(".errorfotodetalle").removeClass("hidden");
        $(".errorfotodetalle").text(data.errors.fotodetalle);
    }
    
    if (data.errors.tipo_proceso_id) {
        $(".errortipo_proceso_id").removeClass("hidden");
        $(".errortipo_proceso_id").text(data.errors.tipo_proceso_id);
    }
    
    if (data.errors.diametro_ecuatorial) {
        $(".errordiametro_ecuatorial").removeClass("hidden");
        $(".errordiametro_ecuatorial").text(data.errors.diametro_ecuatorial);
    }
    
    if (data.errors.updated_at) {
        $(".errorupdated_at").removeClass("hidden");
        $(".errorupdated_at").text(data.errors.updated_at);
    }
    
    if (data.errors.created_at) {
        $(".errorcreated_at").removeClass("hidden");
        $(".errorcreated_at").text(data.errors.created_at);
    }
    

}
</script>
<script type="text/javascript">
    function operaciones(data,operacion) {
    const resularboles_id=Foraarboles_id.find( cas => cas.id == data.arboles_id ); 
        const resultipo_proceso_id=Foratipo_proceso_id.find( cas => cas.id == data.tipo_proceso_id ); 
        
    

    var tabla=
        "<tr  id='item_"+data.id+"'  class='item"+data.id+"'>"+
        
        "<td>"+ resularboles_id["nombre"]  +"</td>"+
        "<td>"+ data.dap+"</td>"+
        "<td>"+ data.altura_total+"</td>"+
        "<td>"+ data.diametro_mayor_copa_m+"</td>"+
        "<td>"+ data.diametro_menor_copa_m+"</td>"+
        "<td>"+ data.fecha+"</td>"+
        "<td>"+ data.arbol_num+"</td>"+
        "<td>"+ data.estadofisico+"</td>"+
        "<td>"+ data.estadosanitario+"</td>"+
        "<td>"+ data.observaciones+"</td>"+
        "<td>"+ data.responsable+"</td>"+
        "<td>"+ data.fotogeneral+"</td>"+
        "<td>"+ data.fotodetalle+"</td>"+
        "<td>"+ resultipo_proceso_id["nombre"]  +"</td>"+
        "<td>"+ data.diametro_ecuatorial+"</td>"+
        "<td>"+ data.updated_at+"</td>"+
        "<td>"+ data.created_at+"</td>"+
        
        '<td>Ahorra</td><td>'+                  
    @can('Ficha_detalles Show') 
        ' <button class="massshow-modal btn btn-success"  ' + 
        "data-id='"+ data.id+"'"+
        "data-arboles_id='"+ data.arboles_id+"'"+
        "data-dap='"+ data.dap+"'"+
        "data-altura_total='"+ data.altura_total+"'"+
        "data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+"'"+
        "data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+"'"+
        "data-fecha='"+ data.fecha+"'"+
        "data-arbol_num='"+ data.arbol_num+"'"+
        "data-estadofisico='"+ data.estadofisico+"'"+
        "data-estadosanitario='"+ data.estadosanitario+"'"+
        "data-observaciones='"+ data.observaciones+"'"+
        "data-responsable='"+ data.responsable+"'"+
        "data-fotogeneral='"+ data.fotogeneral+"'"+
        "data-fotodetalle='"+ data.fotodetalle+"'"+
        "data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
        "data-diametro_ecuatorial='"+ data.diametro_ecuatorial+"'"+
        "data-updated_at='"+ data.updated_at+"'"+
        "data-created_at='"+ data.created_at+"'"+
         
        "'><span class='glyphicon glyphicon-eye-open'></span> Ver</button>  "+ 
    @endcan         
    
    @can('Ficha_detalles Editar')
        " <button class='edit-modal btn btn-info' "+
        "data-id='"+ data.id+"'"+
        "data-arboles_id='"+ data.arboles_id+"'"+
        "data-dap='"+ data.dap+"'"+
        "data-altura_total='"+ data.altura_total+"'"+
        "data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+"'"+
        "data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+"'"+
        "data-fecha='"+ data.fecha+"'"+
        "data-arbol_num='"+ data.arbol_num+"'"+
        "data-estadofisico='"+ data.estadofisico+"'"+
        "data-estadosanitario='"+ data.estadosanitario+"'"+
        "data-observaciones='"+ data.observaciones+"'"+
        "data-responsable='"+ data.responsable+"'"+
        "data-fotogeneral='"+ data.fotogeneral+"'"+
        "data-fotodetalle='"+ data.fotodetalle+"'"+
        "data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
        "data-diametro_ecuatorial='"+ data.diametro_ecuatorial+"'"+
        "data-updated_at='"+ data.updated_at+"'"+
        "data-created_at='"+ data.created_at+"'"+
         
        "'><span class='glyphicon glyphicon-edit'></span> Editar</button>  "+ 
    @endcan

    @can('Ficha_detalles Eliminar') 
        "<button class='massdelete-modal btn btn-danger'  " +
        "data-id='"+ data.id+"'"+
        "data-arboles_id='"+ data.arboles_id+"'"+
        "data-dap='"+ data.dap+"'"+
        "data-altura_total='"+ data.altura_total+"'"+
        "data-diametro_mayor_copa_m='"+ data.diametro_mayor_copa_m+"'"+
        "data-diametro_menor_copa_m='"+ data.diametro_menor_copa_m+"'"+
        "data-fecha='"+ data.fecha+"'"+
        "data-arbol_num='"+ data.arbol_num+"'"+
        "data-estadofisico='"+ data.estadofisico+"'"+
        "data-estadosanitario='"+ data.estadosanitario+"'"+
        "data-observaciones='"+ data.observaciones+"'"+
        "data-responsable='"+ data.responsable+"'"+
        "data-fotogeneral='"+ data.fotogeneral+"'"+
        "data-fotodetalle='"+ data.fotodetalle+"'"+
        "data-tipo_proceso_id='"+ data.tipo_proceso_id+"'"+
        "data-diametro_ecuatorial='"+ data.diametro_ecuatorial+"'"+
        "data-updated_at='"+ data.updated_at+"'"+
        "data-created_at='"+ data.created_at+"'"+
         
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
