<!DOCTYPE html>

<html>

    <head>
        <meta charset="UTF-8">
        <!--
        <title>Arbol Maps</title>
        -->
        <link rel="stylesheet" href="cssi/normalize.css">
        <link rel="stylesheet" href="cssi/main.css" media="screen" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="cssi/bootstrap.css">
        <link rel="stylesheet" href="cssi/style-portfolio.css">
        <link rel="stylesheet" href="cssi/picto-foundry-food.css" />
        <link rel="stylesheet" href="cssi/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="icon" href="favicon-1.ico" type="image/x-icon">
    </head>

    <body>
       <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--
                        <a class="navbar-brand" href="#">Arbol Maps</a>
                        -->
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="navactive color_animation" href="{{ url('/#top') }}">INICIO</a></li>
                            <li><a class="color_animation" href="{{ url('/#story') }}">ACERCA DE</a></li>
                            <li><a class="color_animation" href="{{ url('/#featured') }}">OBJETIVO</a></li>
                            <li><a class="color_animation" href="{{ url('/#contact') }}">CONTACTENOS</a></li>
                            @if (Route::has('login'))
                                @if (Auth::check())
                            <li><a class="color_animation" href="{{ url('/dashboard') }}">PANEL DE CONTROL</a></li>
                                @else
                            <li><a class="color_animation" href="{{ url('/login') }}">LOGIN</a></li>
                            <!--
                            <li><a class="color_animation" href="{{ url('/register') }}">REGISTRO</a></li>
                            -->    
                                @endif
                            @endif
                            
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
        </nav>
         
    </body>
</html>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SamanGir Login </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7
  ../../bootstrap/css/bootstrap.min.css
   -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}  ">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE.min.css')}}  ../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
<!-- ../../plugins/iCheck/square/blue.css -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}   ">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">

  
  <!-- /.login-logo -->
  @yield('content')
  <!-- /.login-box-body -->

<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="{{asset('jquery-2.2.3.min.js')}}  ../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('bootstrap.min.js')}}   ../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{asset('icheck.min.js')}}   ../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>

