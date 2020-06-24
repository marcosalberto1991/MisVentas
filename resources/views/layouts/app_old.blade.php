<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<?php 
$foto="";
$foto = session()->get('foto');
?>
<!--
<style type="text/css">
  .loader {
    position: fixed; 
    left: 0; 
    top: 0; 
    z-index: 99999999999; 
    width: 100%; 
    height: 100%; 
    overflow: visible; 
    background: #f4645f url('{{asset('images/preloader.gif')}}') 
    no-repeat center center; 
  }
</style>
--> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SamanGir</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('fonts/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('bootstrap/css/bootstrap.min.css')}}"/>
  <link rel="stylesheet" href="{{asset('css/font-awesome_.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/ionicons_.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('dist/css/AdminLTE.min.css')}}"/>    
  <link rel="stylesheet" type="text/css" href="{{asset('dist/css/skins/_all-skins.min.css')}}"/>    
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/iCheck/flat/blue.css')}}"/>    
  <!--
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/morris/morris.css')}}"/>    
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}"/>    
  -->
  <link rel="stylesheet" type="text/css" href="{{asset('dist/css/AdminLTE.min.css')}}"/> 
  <!--   
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}"/>    
  -->
  <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"/>    
  
  <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
  <!--
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css') }}">
  -->
  <!--
  <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
  -->
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
</head>
<body id="MyConfigMenu" class="hold-transition  skin-blue sidebar-mini">
  <div id="preloader"> </div>
  <div class="loader"></div>
<div class="wrapper ">
  <header class="main-header">
    <a href="{{ url('/dashboard')}}" class="logo">
      <span class="logo-mini"><b>P</b>O</span>
      <span class="logo-lg"><b>Parqueadero</b>Online</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" onclick="MenuConfig()"  role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
<!--
          <li class="dropdown user user-menu">
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <h3 class="box-title">Collapsable</h3>

                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                    </div>
            
                  </div>
            
                  <div class="box-body">
                    The body of the box
                  </div>
            
                </div>
          </li>
-->
          <li class="dropdown user user-menu">

            <a href="#" type="button" class="dropdown-toggle" data-toggle="dropdown" data-widget="collapse">
                @if($foto=="")
              <img src="{{asset('imagenes/avatar.jpg')}}" class="user-image" alt="User Image">
              @else
              <img class="user-image" src="{{ asset("perfil_usuario/$foto")}}" alt="User Image">   
              @endif
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>            
            
            <ul class="dropdown-menu box-body">
              <li class="user-header">
                @if($foto=="")
                  <img class="img-circle" src="{{ asset('imagenes/avatar.jpg')  }}" alt="User Image">
                @else
                  <img class="img-circle" src="{{ asset("perfil_usuario/$foto")  }}" alt="User Image">   
                @endif
                <p>
                   @if(Auth::check())
                  {{ Auth::user()->name }}
                  @endif
                  <small>Nombre de Perfil</small>
                </p>
              </li>
              <li class="user-body"></li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ action('PerfilUsuarioController@DatosUsuario') }}" class="btn btn-default btn-flat">{{ Auth::user()->name }}</a>
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat" 
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
                   >Salir</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                </div>
              </li>
            </ul>
          </li>

          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
                <?php $foto=session()->get('foto'); ?>
            @if($foto=="")
                <img class="img-circle" src="{{ asset('imagenes/avatar.jpg')  }}" alt="User Image">
              @else
                <img class="img-circle" src="{{ asset("perfil_usuario/$foto")  }}" alt="User Image">   
              @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
    -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        
        <li class="header">Menu vertical</li>
       
        
<!--
         <li>
          <a href="{ action('EntradaSalidaVehiculoController@index') }}">
            <i class="fa fa-tasks"></i> <span>EntradaSalidaVehiculoController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
         <li>
          <a href="{ action('SitiosParqueaderoController@index') }}">
            <i class="fa fa-tasks"></i> <span>SitiosParqueaderoController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
          <li>
          <a href="{ action('ZonaParqueaderoController@index') }}">
            <i class="fa fa-tasks"></i> <span>ZonaParqueaderoController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
         <li>
          <a href="{ action('NivelesController@index') }}">
            <i class="fa fa-tasks"></i> <span>NivelesController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

-->

        

        
         <li>
          <a href="{ action('CategoriaParqueaderoController@index') }}">
            <i class="fa fa-tasks"></i> <span>CategoriaParqueaderoController</span>
            <span class="pull-right-container">
              <!--
              <small class="label pull-right bg-green">new</small>
            </span>
              -->
          </a>
        </li>
         <li>
          <a href="{ action('TipoVehiculoController@index') }}">
            <i class="fa fa-tasks"></i> <span>TipoVehiculoController</span>
            <!--  
            <span class="pull-right-container">
            </span>
          -->
          </a>
        </li>
        
          <li>
          <a href="{ action('ParqueaderoVehiculoController@index') }}">
            <i class="fa fa-tasks"></i> <span>ParqueaderoVehiculoController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
          <li>
          <a href="{ action('RegistroController@index') }}">
            <i class="fa fa-tasks"></i> <span>RegistroController</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>

        @hasrole('Super Administrador')
         <li>
          <a href="{{ action('PermissionController@index') }}">
            <i class="fa fa-calculator"></i> <span>Permisos</span>
            <span class="pull-right-container">
            </span>
          </a>
        </li>
        @endhasrole
        
    
        @hasrole('Super Administrador')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Log y auditoria </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
                
            <li><a href="log-viewer"><i class="fa fa-circle-o text-yellow"></i> LOG</a></li>
            <li><a href="{{ action('AuditoriaController@index') }}"><i class="fa fa-circle-o text-yellow"></i> Auditoria</a></li>
            <li><a href="{{ action('BackupController@index') }}"><i class="fa fa-circle-o text-yellow"></i> Backup</a></li>
        
          </ul>
        </li>
        @endhasrole
         <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Otros Datos </span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
          
             @hasrole('Super Administrador')
            <li><a href="{{ url('users/create') }}"><i class="fa fa-circle-o text-aqua"></i>Registro de usuario</a></li>

            
            @endhasrole

          </ul>
        </li>
        <li><a href="{ action('dashboardController@documentacion') }}"><i class="fa fa-book"></i> <span>Documentación</span></a></li>

      
       

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <!--
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
      -->
    <section class="content">
      <div class="row">
            @yield('content')
          <div class="container">
        </div>
      <div>
    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.55.7
    </div>
    <strong>Copyright &copy; 2018 <a href="http://almsaeedstudio.com">Marcos Alberto Saavedra Sanabria y Edwin Orlando Raquejo Contreras </a>.</strong> todo los derechos reservado.
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <div class="tab-content">
  
      <div class="tab-pane" id="control-sidebar-home-tab">
        
        <h3 class="control-sidebar-heading">Recent Activity</h3>
      
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>
              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
      </div>

      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
@yield('page-js-files')
<script src="{{ asset('jsi/jquery-3.3.1.js') }}"></script>
<!--
<script  src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
-->
<script type="text/javascript" src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{ asset('js/kinetic.js') }}"></script>
<!-- jQuery UI 1.11.4 
<script type="text/javascript" src="{{ asset('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') }}"></script>
-->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
</script>
<script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script    src="{{ asset('js/jquery-ui.js') }}"></script>
<!--
<script type="text/javascript" src="{{ asset('js/raphael-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/knob/jquery.knob.js') }}"></script>
-->
<script type="text/javascript" src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!--
-->
<link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
<script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/js/app.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('dist/js/demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!--
<script type="text/javascript" src="{{ asset('plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('dynatable/jquery.dynatable.css')}}"/> 
<script type="text/javascript" src="{{ asset('dynatable/jquery.dynatable.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
-->
<script src="{{ asset('js/select2.min.js') }}"></script>
<!--
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script> 
-->
</body>
</html>
@yield('page-js-script')
<script type="text/javascript">
function MenuConfig () {
  var data = sessionStorage.getItem('MenuConfig');
    //alert(data);
    if (data=="false") {
      sessionStorage.setItem('MenuConfig', 'true');
      //$('#MyConfigMenu').addClass('sidebar-collapse');
    }else{
      sessionStorage.setItem('MenuConfig', 'false');
      //$('#MyConfigMenu').removeClass('sidebar-collapse');

    }
}
$(window).load(function() {
    $(".loader").fadeOut("slow");
    var data = sessionStorage.getItem('MenuConfig');
    //alert(data);
    if (data=="null") {
      sessionStorage.setItem('key', 'false');
    }
    if (data=="false") {
      $('#MyConfigMenu').addClass('sidebar-collapse');

    }

    //sessionStorage.setItem('key', 'value');
});
</script>

<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  
<script type="text/javascript">
    $('select#country').change(function(){
        var countryId = $(this).val();
        $ciudaditems = $('.cityItems').remove();
        $.get('ciudades/'+countryId, function(data){
            $.each(data, function(index, element){
              //console.log(element);
                $('select#municipios_id_mass').append('<option value="'+element.id+'" class="cityItems">'+element.nombre+'</option>')
            });
        }, 'json');
    });

  
    $('.input-number-line').on('input', function () { 
      this.value = this.value.replace(/[^0-9-]/g,'');
    });
     $('.input-number-guion-abajo').on('input', function () { 
      this.value = this.value.replace(/[^0-9_]/g,'');
    });
    $('.input-number').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
    });
    $('.input-number-coma').on('input', function () { 
      this.value = this.value.replace(/[^0-9,]/g,'');
    });
    $('.input-number-coma-punto').on('input', function () { 
      this.value = this.value.replace(/[^0-9.]/g,'');
    });
     $('.input-number-punto').on('input', function () { 
      this.value = this.value.replace(/[^0-9.-]/g,'');
    });
    $('.input-number-punto-coma').on('input', function () { 
      this.value = this.value.replace(/[^0-9.,]/g,'');
    });
    $('.solo-texto').on('input', function () { 
      this.value = this.value.replace(/[^a-zA-ZñÑáéíóúÁÉÍÓÚ.(),@ _-]/g,'');
    });
    $('.form-control').on('input', function () { 
      this.value = this.value.replace(/[^0-9a-zA-ZñÑáéíóúÁÉÍÓÚ.(),@ _-]/g,'');
    });

    $('.datepicker').datepicker({
    format: 'yyyy-mm-dd',
    //startDate: '-3d',
    todayHighlight: true,
    closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''

    });

    $('#fecha_mass').datepicker({
          autoclose: true,
          format: 'yyyy-dd-mm',
          closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    });


</script>
<style>
.datepicker{z-index:1151 !important;}
</style>

<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
    $('.multiple-select').select2();
    //$('.form-control').select2();
    $('.busca_select').select2();
});
/*
$(".select2").select2({
    placeholder: "Select a state",
    allowClear: true
});
*/
</script>

<script>
  $(document).ready(function(){
    $("#postTable").DataTable({
     language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }, 
    });
  });

  $(window).load(function(){
    $("#postTable").removeAttr("style");
    });


</script>








