@extends('layouts.app_mosnter')

<meta charset="utf-8">
<meta name="_token" content="{{ csrf_token() }}"/>
<!--
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
{{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
{{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}
{{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
{{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

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
    -->
  <style>
    .box-profile{
    margin-top: 70px;
    }
    
    .cuadro{

    color:#d2d6de;
    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;
    border: 3px solid #000000;
    background-color: #337ab7;

    }
    .espacio{
      margin-top:50px;
    }
  </style>
@section('content')

<section class="col-lg-12 connectedSortable">

  <div class="col-sm-12 center-block">
    @include('flash-message')
  </div>
    <div class="col-sm-3 center-block ">
      <h1>Datos de perfil</h1>
              <div class="box-body box-profile ">
                @php
                $foto=$data_form->avatar;
                @endphp 
                @if($data_form->avatar=="")
                  <img class="center-block profile-user-img img-responsive img-circle" src="{{asset('imagenes/avatar.jpg')}}" alt="User profile picture">
                @else
                
                  <img class="center-block profile-user-img img-responsive img-circle" src='{{ asset("perfil_usuario/$foto")}}'   alt="User profile picture">
                @endif
                <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                <p class="text-muted text-center">Foto de usuario</p>
              </div>
          
           {!! Form::model($data_form, ['method' => 'PUT','enctype'=>'multipart/form-data', 'route' => [
            'PerfilUsuario.update',
            
            $data_form->id]]) !!}
           {{ csrf_field() }}
                <input type='hidden' class='form-control' id='id_mass_2' required='required' autofocus>
            



           <div class="col-xs-12 form-group">
              {!! Form::label('avatar', 'avatar ', ['class' => 'control-label']) !!}
              {!! Form::file('avatar', old('avatar'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('avatar'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('avatar') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('nombre', 'nombre*', ['class' => 'control-label']) !!}
              {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('nombre'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('nombre') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('apellido', 'apellido*', ['class' => 'control-label']) !!}
              {!! Form::text('apellido', old('apellido'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('apellido'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('apellido') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('cedula', 'cedula*', ['class' => 'control-label']) !!}
              {!! Form::text('cedula', old('cedula'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('cedula'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('cedula') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('correo', 'correo*', ['class' => 'control-label']) !!}
              {!! Form::text('correo', old('correo'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('correo'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('correo') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('celular', 'celular*', ['class' => 'control-label']) !!}
              {!! Form::text('celular', old('celular'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('celular'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('celular') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('direccion_correo', 'direccion_correo*', ['class' => 'control-label']) !!}
              {!! Form::text('direccion_correo', old('direccion_correo'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('direccion_correo'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('direccion_correo') }}</b>
              </div>
              @endif
            </div>

              <div class="col-xs-12 form-group">
              {!! Form::label('telefono_fijo', 'telefono_fijo*', ['class' => 'control-label']) !!}
              {!! Form::text('telefono_fijo', old('telefono_fijo'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('telefono_fijo'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('telefono_fijo') }}</b>
              </div>
              @endif
            </div>

         

            {!! Form::submit('Aceptar', ['class' => 'btn btn-primary']) !!}  
            {!! Form::close() !!}

            
    @foreach($errors as $men)
           <h1>sss  $men->messages
    @endforeach

          </div>
           <div class="col-md-4">
          <h1>Cambiar la contraseña </h1>

          {!! Form::open(['method' => 'POST', 'route' => ['Perfil.Edit_password']]) !!}
            {{ csrf_field() }}
            <div class="col-xs-12 form-group">
              {!! Form::label('password', 'password*', ['class' => 'control-label']) !!}
              {!! Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('password'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('password') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('password_new', 'password_new*', ['class' => 'control-label']) !!}
              {!! Form::text('password_new', old('password_new'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('password_new'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('password_new') }}</b>
              </div>
              @endif
            </div>

           <div class="col-xs-12 form-group">
              {!! Form::label('password_confirma', 'password_confirma*', ['class' => 'control-label']) !!}
              {!! Form::text('password_confirma', old('password_confirma'), ['class' => 'form-control', 'placeholder' => '']) !!}
              @if($errors->has('password_confirma'))
              <div class="alert alert-danger" role="alert">
                  <b >{{ $errors->first('password_confirma') }}</b>
              </div>
              @endif
            </div>

            {!! Form::submit('Aceptar', ['class' => 'btn btn-primary']) !!}  
            {!! Form::close() !!}




      </div>



<!--
<div class="row">
  

  <div class="col-lg-3 center-block" align='center'  >
    <a class="" href="#home"  id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
      <div class="center  cuadro connectedSortable">
      <i class="fa fa-user" style="font-size:50px;margin-top: 15px;"></i>
        <p class="center-block"><b>Informacion Personal</b></p>
      </div>
    </a>
  </div>

  <div class="col-lg-3 center-block" align='center'>
    <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
      <div class="center-block  cuadro connectedSortable">
      <i class="fa fa-user" style="font-size:50px;margin-top: 15px;"></i>
        <p class="center-block"><b>Cambiar Clave</b></p>
      </div>
    </a>
  </div>

  <div class="col-lg-3 center-block" align='center'  >
    <a class="" href="#home"  id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
      <div class="center-block  cuadro connectedSortable">
        <i class="fa fa-user" style="font-size:50px;margin-top: 15px;"></i>
        <p class="center-block"><b>Bandeja de Mensaje</b></p>
      </div>
    </a>
  </div>

  <div class="col-lg-3 center-block" align='center'  >
    <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
      <div class="center-block  cuadro connectedSortable">
      <i class="fa fa-user" style="font-size:50px;margin-top: 15px;"></i>
        <p class="center-block"><b>Preguntas frecuentes</b></p>
      </div>
    </a>
  </div>

</div>
-->


</section>
<section class="col-md-12 ">


<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
   
    <div id="myTabContent" class="tab-content">
      
      <div role="tabpanel" class="tab-pane center-block  fade in active espacio col-md-offset-3" id="home" aria-labelledby="home-tab">
         
        








      </div>
     
     
    </div>
  </div>






</section>
</div>


 

    
@endsection








  <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
  {{-- <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script> --}}
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
 




</body>
</html>

