    

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

    

    @foreach($listmysql as $lists)
          
          <div class="box box-primary">
            <div class="box-body box-profile">
              @if($lists->foto=="")

                <img class="profile-user-img img-responsive img-circle" src="{{asset('imagenes/avatar.jpg')}}" alt="User profile picture">
              @else
                <img class="profile-user-img img-responsive img-circle" src='{{ asset("perfil_usuario/$lists->foto")}}'   alt="User profile picture">   
              @endif
              
              <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

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
              {{ $lists->municipios->departamento_id }}, 
              {{ $lists->municipios->nombre }} 
              </p><hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Dirección</strong>
              <p class="text-muted">
              {{ $lists->direccion }} 
              </p><hr>


      



                @if (Session::has('success-message'))
                    <div class="alert alert-success">{{ Session::get('success-message') }}</div>
                @endif

                @if (Session::has('error-message'))
                    <div class="alert alert-danger">{{ Session::get('error-message') }}</div>
                @endif

        
             

            
            {{ csrf_field() }}
             <button id="boton_todo" class="edit-modal btn btn-info" 
    data-id="{{ $lists->id}}"
    data-nombre="{{ $lists->nombre}}"
    data-apellido="{{ $lists->apellido}}"
    data-telefono_1="{{ $lists->telefono_1}}"
    data-telefono_2="{{ $lists->telefono_2}}"
    data-direccion="{{ $lists->direccion}}"
    data-cedula="{{ $lists->cedula}}"
    data-municipios_id="{{ $lists->municipios_id}}"
    
    
    data-created_at="{{ $lists->created_at}}"
    data-updated_at="{{ $lists->updated_at}}"
    data-users_id="{{ $lists->users_id}}"
    
                        
                        ><span class="glyphicon glyphicon-edit"></span> Editar</button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          @endforeach
<button id="boton_todo" class="edit-modal-resert btn btn-info">
<span class="glyphicon glyphicon-edit"></span> Cambiar la contraseña</button>

  </section>


     </div>
     </div>
</section>
>
@endsection



 <div id="massModal_password" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-descripcion"></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="formmass" role="form" accept-charset="UTF-8" enctype="multipart/form-data" >
           {{ csrf_field() }}
             <div class='form-group' id='nombre' >
              <label class='control-label col-sm-2' for='descripcion'>Escribir la contraseña actual :</label>
              <div class='col-sm-10'>
                <input type='password_actual_mass' class='form-control' id='password_actual_mass' maxlength='60'   required='required' autofocus/>
                <p class='errorcontrasena text-center alert alert-danger hidden'></p>
              </div>
            </div>

            <input type='hidden' class='form-control' id='id_mass' required='required' autofocus/>
            
            
            <div class='form-group' id='nombre' >
              <label class='control-label col-sm-2' for='descripcion'>Escribir la nueva contraseña :</label>
              <div class='col-sm-10'>
                <input type='password_mass' class='form-control' id='password_mass' maxlength='60'   required='required' autofocus/>
                <p class='errorcontrasena text-center alert alert-danger hidden'></p>
              </div>
            </div>
             <div class='form-group' id='nombre' >
              <label class='control-label col-sm-2' for='descripcion'>Confirma la nueva contraseña :</label>
              <div class='col-sm-10'>
                <input type='password_confinma' class='form-control' id='password_confinma_mass' maxlength='60'   required='required' autofocus/>
                <p class='errorconfirmacontrasena text-center alert alert-danger hidden'></p>
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
          <form class="form-horizontal" id="formmass" role="form" accept-charset="UTF-8" enctype="multipart/form-data" >

           {{ csrf_field() }}

            <input type="hidden" class="form-control" id="id_mass_2"  disabled>
            <div class='form-group' id='nombre' >
              <label class='control-label col-sm-2' for='descripcion'>nombre:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='nombre_mass' maxlength='60'   required='required' autofocus>
                <p class='errornombre text-center alert alert-danger hidden'></p>
              </div>
            </div>
            
            <div class='form-group' id='apellido' >
              <label class='control-label col-sm-2' for='descripcion'>apellido:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='apellido_mass' maxlength='60'   required='required' autofocus>
                <p class='errorapellido text-center alert alert-danger hidden'></p>
              </div>
            </div>
            
            <div class='form-group' id='telefono_1' >
              <label class='control-label col-sm-2' for='descripcion'>telefono_1:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='telefono_1_mass' maxlength='15'   required='required' autofocus>
                <p class='errortelefono_1 text-center alert alert-danger hidden'></p>
              </div>
            </div>
            
            <div class='form-group' id='telefono_2' >
              <label class='control-label col-sm-2' for='descripcion'>telefono_2:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='telefono_2_mass' maxlength='15'   required='required' autofocus>
                <p class='errortelefono_2 text-center alert alert-danger hidden'></p>
              </div>
            </div>
            
            <div class='form-group' id='direccion' >
              <label class='control-label col-sm-2' for='descripcion'>direccion:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='direccion_mass' maxlength='45'   required='required' autofocus>
                <p class='errordireccion text-center alert alert-danger hidden'></p>
              </div>
            </div>
            
            <div class='form-group' id='cedula' >
              <label class='control-label col-sm-2' for='descripcion'>cedula:</label>
              <div class='col-sm-10'>
                <input type='text' class='form-control' id='cedula_mass' maxlength='20'   required='required' autofocus>
                <p class='errorcedula text-center alert alert-danger hidden'></p>
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
            <!--
            <div class="form-group">
              <label class="control-label col-sm-2" for="descripcion">entidad_municipal_id:</label>
              <div class="col-sm-10">
                
                <select class="form-control" id="entidad_municipal_id_mass" required="required" autofocus >
                  <option value=""></option>

               
                
                </select>
                <!--
                <input type="select" class="form-control" id=entidad_municipal_id_mass" required="required" autofocus>
                <p class="errorentidad_municipal_id text-center alert alert-danger hidden"> llenar los datos</p>
              </div>
            </div>
                -->
            
            <div class='form-group' id='foto' >
              <label class='control-label col-sm-2' for='descripcion'>foto:</label>
              <div class='col-sm-10'>
                <input type='file' class='form-control' id='foto_mass' name="foto_mass" maxlength='45'   required='required' autofocus>
                <p class='errorfoto text-center alert alert-danger hidden'></p>
              </div>
            </div>
            <!--
             <div class="form-group">
              <label class="control-label col-sm-2" for="id">Select a foto</label>
              <div class="col-sm-10">
                    <input name="file" type="file" id="file">
                <input type="text" class="form-control" id="id_mass"  disabled>
              </div>
            </div>
            -->  
            
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
            
                <select  style="visibility:hidden" class="form-control" id="users_id_mass" required="required" autofocus >
                  <option value=""></option>

                @foreach($users_id as $lists)
                    <option value="{{$lists->id}}">{{$lists->nombre}}</option>
                @endforeach
                
                </select>
                <p class="errorusers_id text-center alert alert-danger hidden"> llenar los datos</p>
                                
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
    $(document).ready(function(){
        $("#postTable").DataTable();
    });

    $(window).load(function(){
      $("#postTable").removeAttr("style");
    })
  </script>

      
<script type='text/javascript'>
      <?php echo "const  Foramunicipios_id= $municipios_id;"; ?>
     
      <?php echo "const  Forausers_id= $users_id;"; ?>
      </script>

  <script type='text/javascript'>
   
    $('.modal-footer').on('click', '.edit-password', function() {
     
        $.ajax({
          type: 'post',
          url: 'Edit_password',
          data: {
            'password_actual_mass': $('#password_actual_mass').val(),
            'password_mass': $('#password_mass').val(),
            'password_confinma_mass': $('#password_confinma_mass').val(),
            '_token': $('input[name=_token]').val()
          }, 
          success: function(data) {
          $('.errorconfirmacontrasena').addClass('hidden');
          $('.errorcontrasena').addClass('hidden');
            if(data.errors){
              setTimeout(function () {
                $('#massModal_password').modal('show');
                  toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
                }, 500);
          
            }else{
              toastr.success('Successfully updated Perfil_Usuario!', 'Success Alert', {timeOut: 5000});
            }
          
          },

      });
    });

    // Edit a post
    $(document).on('click', '.edit-modal', function() {
      $("#id_mass_2").val($(this).data("id"));
      $("#nombre_mass").val($(this).data("nombre"));
      $("#apellido_mass").val($(this).data("apellido"));
      $("#telefono_1_mass").val($(this).data("telefono_1"));
      $("#telefono_2_mass").val($(this).data("telefono_2"));
      $("#direccion_mass").val($(this).data("direccion"));
      $("#cedula_mass").val($(this).data("cedula"));
      $("#municipios_id_mass").val($(this).data("municipios_id"));
      //$("#entidad_municipal_id_mass").val($(this).data("entidad_municipal_id"));
      $("#foto_mass").val($(this).data("foto"));
      $("#created_at_mass").val($(this).data("created_at"));
      $("#updated_at_mass").val($(this).data("updated_at"));
      $("#users_id_mass").val($(this).data("users_id"));
      

      id = $('#id_mass_2').val();
      $('#acciones').attr('class', 'btn btn-warning edit');
      $('#acciones').text('Editar');
      $('.modal-descripcion').text('Editar un Dato');
      $('#massModal').modal('show');
      $('#msdelete').text(' ');
    });

      


      $('.modal-footer').on('click', '.edit', function() {
        
        var formData = new FormData($("#formmass")[0]);
      formData.append('id',$('#id_mass_2').val());
      formData.append('nombre',$('#nombre_mass').val());
      formData.append('apellido',$('#apellido_mass').val());
      formData.append('telefono_1',$('#telefono_1_mass').val());
      formData.append('telefono_2',$('#telefono_2_mass').val());
      formData.append('direccion',$('#direccion_mass').val());
      formData.append('cedula',$('#cedula_mass').val());
      formData.append('municipios_id',$('#municipios_id_mass').val());
      //formData.append('entidad_municipal_id',$('#entidad_municipal_id_mass').val());
      //formData.append('foto',$('#foto_mass').val());
      formData.append('created_at',$('#created_at_mass').val());
      formData.append('updated_at',$('#updated_at_mass').val());
      formData.append('users_id',$('#users_id_mass').val());
      formData.append('_token',$('input[name=_token]').val()); 


      //users_id_mass      users_id_mass

        $.ajax({
          type: 'POST',
          //url: 'Perfil_Usuario/' + id,
          url: 'Usuario_perfil/Edit/' + id,
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
            /*
          data: {
      'id': $('#id_mass').val(),
      'nombre': $('#nombre_mass').val(),
      'apellido': $('#apellido_mass').val(),
      'telefono_1': $('#telefono_1_mass').val(),
      'telefono_2': $('#telefono_2_mass').val(),
      'direccion': $('#direccion_mass').val(),
      'cedula': $('#cedula_mass').val(),
      'municipios_id': $('#municipios_id_mass').val(),
      'entidad_municipal_id': $('#entidad_municipal_id_mass').val(),
      'foto': $('#foto_mass').val(),
      'created_at': $('#created_at_mass').val(),
      'updated_at': $('#updated_at_mass').val(),
      'users_id': $('#users_id_mass').val(),
      '_token': $('input[name=_token]').val()
        }, 
        */
      success: function(data) {
      $('.errorid').addClass('hidden');
      $('.errornombre').addClass('hidden');
      $('.errorapellido').addClass('hidden');
      $('.errortelefono_1').addClass('hidden');
      $('.errortelefono_2').addClass('hidden');
      $('.errordireccion').addClass('hidden');
      $('.errorcedula').addClass('hidden');
      $('.errormunicipios_id').addClass('hidden');
      $('.errorentidad_municipal_id').addClass('hidden');
      $('.errorfoto').addClass('hidden');
      $('.errorcreated_at').addClass('hidden');
      $('.errorupdated_at').addClass('hidden');
      $('.errorusers_id').addClass('hidden');
         
      if ((data.errors)) {
        setTimeout(function () {
          $('#editModal').modal('show');
          toastr.error('Validacion errorea!', 'Alerta de Error ', {timeOut: 5000});
        }, 500);
      
        if (data.errors.id) {
                  $(".error.id").removeClass("hidden");
                  $(".error.id").text(data.errorsid);
                }
        if (data.errors.nombre) {
                  $(".error.nombre").removeClass("hidden");
                  $(".error.nombre").text(data.errorsnombre);
                }
        if (data.errors.apellido) {
                  $(".error.apellido").removeClass("hidden");
                  $(".error.apellido").text(data.errorsapellido);
                }
        if (data.errors.telefono_1) {
                  $(".error.telefono_1").removeClass("hidden");
                  $(".error.telefono_1").text(data.errorstelefono_1);
                }
        if (data.errors.telefono_2) {
                  $(".error.telefono_2").removeClass("hidden");
                  $(".error.telefono_2").text(data.errorstelefono_2);
                }
        if (data.errors.direccion) {
                  $(".error.direccion").removeClass("hidden");
                  $(".error.direccion").text(data.errorsdireccion);
                }
        if (data.errors.cedula) {
                  $(".error.cedula").removeClass("hidden");
                  $(".error.cedula").text(data.errorscedula);
                }
        if (data.errors.municipios_id) {
                  $(".error.municipios_id").removeClass("hidden");
                  $(".error.municipios_id").text(data.errorsmunicipios_id);
                }
      
        if (data.errors.foto) {
                  $(".error.foto").removeClass("hidden");
                  $(".error.foto").text(data.errorsfoto);
                }
        if (data.errors.created_at) {
                  $(".error.created_at").removeClass("hidden");
                  $(".error.created_at").text(data.errorscreated_at);
                }
        if (data.errors.updated_at) {
                  $(".error.updated_at").removeClass("hidden");
                  $(".error.updated_at").text(data.errorsupdated_at);
                }
        if (data.errors.users_id) {
                  $(".error.users_id").removeClass("hidden");
                  $(".error.users_id").text(data.errorsusers_id);
                }
        } else {
                  toastr.success('Successfully updated Perfil_Usuario!', 'Success Alert', {timeOut: 5000});
                //update

     

        $("#boton_todo").replaceWith('<button id="boton_todo" class="edit-modal btn btn-info"'+ 
    'data-id="'+data.id+'"'+
    'data-nombre="'+data.nombre+'"'+
    'data-apellido="'+data.apellido+'"'+
    'data-telefono_1="'+data.telefono_1+'"'+
    'data-telefono_2="'+data.telefono_2+'"'+
    'data-direccion="'+data.direccion+'"'+
    'data-cedula="'+data.cedula+'"'+
    'data-municipios_id="'+data.municipios_id+'"'+
   // 'data-entidad_municipal_id="'+data.entidad_municipal_id+'"'+
   // 'data-foto="'+data.foto+'"'+
    'data-created_at="'+data.created_at+'"'+
    'data-updated_at="'+data.updated_at+'"'+
    'data-users_id="'+data.users_id+'"'+
    '><span class="glyphicon glyphicon-edit"></span> Editar true</button>');
          
        
//id="boton_todo" class="edit-modal btn btn-info"




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



</body>
</html>

