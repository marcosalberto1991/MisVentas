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


<section class="col-lg-12 connectedSortable">

    @foreach($Perfil_UsuarioModel as $lists)
          
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if($lists->foto=="")
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('imagenes/avatar.jpg')  }}" alt="User profile picture">
              @else
                <img class="profile-user-img img-responsive img-circle" src="{{ asset('imagenes/$lists->foto')  }}" alt="User profile picture">
              @endif
              
              <h3 class="profile-username text-center">Nina Mcintire</h3>

              <p class="text-muted text-center">Software Engineer</p>

            </div>
          
            <div class="box-header with-border">
              <h3 class="box-title">Datos Personales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

              <strong><i class="fa fa-user margin-r-5"></i>Nombre</strong>
              <p class="text-muted">
              {{ $lists->nombre }} 
              </p><hr>
              <div class="form-group has-success">
                  <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with success</label>
                  <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ...">
                  <span class="help-block">Help block with success</span>
              </div>

              <strong><i class="fa fa-users margin-r-5"></i>Apellido</strong>
              <p class="text-muted">
              {{ $lists->apellido }} 
              </p><hr>


              <strong><i class="fa fa-tty margin-r-5"></i>Prime Telefono</strong>
              <p class="text-muted">
              {{ $lists->telefono_1 }} 
              </p><hr>

              <strong><i class="fa fa-book margin-r-5"></i> Segundo Telefono</strong>
              <p class="text-muted">
              {{ $lists->telefono_2 }} 
              </p><hr>

              <strong><i class="fa fa-institution margin-r-5"></i> Numero de Documentos</strong>
              <p class="text-muted">
              {{ $lists->cedula }} 
              </p><hr>

              <strong><i class="fa  fa-bus margin-r-5"></i>Municipios</strong>
              <p class="text-muted">
              {{ $lists->municipios }}, 
              {{ $lists->municipios }} 
              </p><hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
              <p class="text-muted">
              {{ $lists->direccion }} 
              </p><hr>


             


              <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

              <p>
                <span class="label label-danger">UI Design</span>
                <span class="label label-success">Coding</span>
                <span class="label label-info">Javascript</span>
                <span class="label label-warning">PHP</span>
                <span class="label label-primary">Node.js</span>
              </p>

              <hr>
             
              <a href="{{ action('Perfil_UsuarioController@editar') }}" class="btn btn-primary btn-block"><b>Editar Perfil</b></a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          @endforeach
  </section>
  @endsection