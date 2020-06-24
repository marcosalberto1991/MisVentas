<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = {csrfToke: '{{ csrf_token() }}'}</script>    
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets-mosnter/images/favicon.png')}}">
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <link href="{{asset('assets-mosnter/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />


    <link href="{{ asset('css-mosnter/colors/blue.css')}}" id="theme" rel="stylesheet">


     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets-mosnter/images/favicon.png">
    <title>Monster Admin Template - The Most Complete & Trusted Bootstrap 4 Admin Template</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('assets-mosnter/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css-mosnter/style.css')}}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('css-mosnter/colors/blue.css')}}" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!--
    <link href="{{ asset('css/app.css')}}" id="theme" rel="stylesheet">
    -->
    <link href="{{ asset('scss-mosnter/icons/font-awesome/css/font-awesome.min.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/simple-line-icons/css/simple-line-icons.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/weather-icons/css/weather-icons.min.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/linea-icons/linea.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/themify-icons/themify-icons.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/flag-icon-css/flag-icon.min.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('scss-mosnter/icons/material-design-iconic-font/css/materialdesignicons.min.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('css-mosnter/spinners.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('css-mosnter/animate.css')}}" id="theme" rel="stylesheet">
    <link href="{{ asset('css-mosnter/style.css" rel="stylesheet')}}">
    <!--
    -->
    
    <style type="text/css">
    .edit-modal{
        padding-top: 2px;
        padding-bottom: 2px;
    }
    .massdelete-modal{
        padding-top: 2px;
        padding-bottom: 2px;   
    }
    .table{   
        font-family: 'Rubik';
        src: url("{{ asset('fuente_texto/LemonMilk.otf')}}") format("truetype"),
    }
    .modal{
        font-family: 'Rubik', Times, serif;
        font-size: 17px;
    }


    @font-face{

        
    }
    </style>

</head>

<body class="fix-header card-no-border">
    <div id="app">
        
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <!-- Logo icon --><b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="../assets/images/logo-icon.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo icon -->
                            <img src="../assets/images/logo-light-icon.png" alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text --><span style="">
                         <!-- dark Logo text -->
                         <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo">
                         <!-- Light Logo text -->    
                         <img src="../assets/images/logo-light-text.png" class="light-logo" alt="homepage"></span> </a>
                </div>
<!--
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ asset('assets-mosnter/images/logo-icon.png')}}" alt="homepage" class="dark-logo" />
                        <b>
                           
                            
                        </b>
                  
                        <span>
                        
                         </span> </a>
                </div>
    -->
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ url('lang', ['es']) }}" ><b>Español</b></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ url('lang', ['en']) }}" ><b>English</b></a>
                        </li>
                        @if (Route::has('login'))
                            @if (Auth::check())
                                <?php $foto=auth()->user()->avatar;?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src='{{ asset("perfil_usuario/$foto")}}' 
                                         alt="user" class="profile-pic m-r-5" /><b class="menu_info" >{{auth()->user()->name}}</b></a>

                                </li>
                                <li class="nav-item dropdown">
                                    <a href="{{ route('logout') }}" class="nav-link dropdown-toggle text-muted waves-effect waves-dark" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"><b class="menu_info"><p>{{ trans('welcome.salir') }}</p></b></a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                    </form>
                                </li>
                                <li class="nav-item dropdown">
                                    <a href="{{ action('PerfilUsuarioController@DatosUsuario') }}" class="nav-link dropdown-toggle text-muted waves-effect waves-dark"><b>Perfil</b></a>
                                </li>

                            @else 
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="{{ url('/login') }}" ><b>Login</b></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark " href="{{ url('/register') }}" ><b>Registrate</b></a>
                            </li>
                            @endif
                        @else

                        @endif
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                         <li>
                            <a href="{{ action('IndexController@index') }}" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Inicio version 1</a>
                        </li>
                        <li>
                            <a href="{{ action('ProductoController@index') }}" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Producto</a>
                        </li>
                        <li>
                            <a href="{{ action('DatosDispositivoController@index') }}" class="waves-effect"><i class="fa fa-user m-r-10" aria-hidden="true"></i>Datos</a>
                        </li>
                        <li>
                            <a href="{{ action('DatosDispositivoController@DatosGrafica') }}" class="waves-effect"><i class="fa fa-table m-r-10" aria-hidden="true"></i>Graficos de datos</a>
                        </li>
                        @hasrole('Super Administrador')
                        <li>
                            <a href="log-viewer" class="waves-effect"><i class="fa fa-font m-r-10" aria-hidden="true"></i>LOG</a>
                        </li>
                        
                        <li>
                            <a href="{{ action('AuditoriaController@index') }}" class="waves-effect"><i class="fa fa-globe m-r-10" aria-hidden="true"></i>Auditoria</a>
                        </li>
                        <li>
                            <a href="{{ action('BackupController@index') }}" class="waves-effect"><i class="fa fa-columns m-r-10" aria-hidden="true"></i>Backup</a>
                        </li>
                        @endhasrole
                        
                        <li>
                            <a href="pages-error-404.html" class="waves-effect"><i class="fa fa-info-circle m-r-10" aria-hidden="true"></i>Documentación</a>
                        </li>





          
                    </ul>
                  
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->

        <div class="page-wrapper">
          
            <div class="container-fluid" >
               
                @yield('content')
              
            </div>
            <footer class="footer text-center">
                © 2017 Monster Admin by wrappixel.com
            </footer>
        </div>
    </div>
    
    <!--
    -->
    </div>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('jsi/jquery-3.3.1.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <!--
    <script src="{{asset('assets-mosnter/plugins/jquery/jquery.min.js')}}"></script>
    -->
    <script src="{{asset('assets-mosnter/plugins/bootstrap/js/tether.min.js')}}"></script>
    <script src="{{asset('assets-mosnter/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js-mosnter/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('js-mosnter/waves.js')}}"></script>
    <script src="{{asset('js-mosnter/sidebarmenu.js')}}"></script>
    <script src="{{asset('assets-mosnter/plugins/sticky-kit-master/dist/sticky-kit.min.js')}}"></script>
    <script src="{{asset('js-mosnter/custom.min.js')}}"></script>
    <script src="{{asset('assets-mosnter/plugins/styleswitcher/jQuery.style.switcher.js')}}"></script>
    <!--
    -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"/></script>

    <script type="text/javascript" src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<!--
    <script type="text/javascript" src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    -->
    <script type="text/javascript" src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>


@yield('page-js-files')
@yield('page-js-script')

</body>

</html>



<script type="text/javascript">

  
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

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('.multiple-select').select2();
        //$('.form-control').select2();
        $('.busca_select').select2();
    });
/*
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

.menu_info{
color: #007fbd;
}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
  $(document).ready(function(){
    $("#myTable").DataTable({
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


</script>








