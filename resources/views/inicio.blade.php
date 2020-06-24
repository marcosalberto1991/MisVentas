<!doctype html>
<html lang="{{ config('app.locale') }}">
<!--
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
-->

        <!-- Fonts
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
         -->

        <!-- Styles
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
         -->

         <!--
    </head>
    <body>
        <div class="flex-center position-ref full-height">
     -->
<!--
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
-->


<html>

    <head>
        <meta charset="UTF-8">
        <!--
        <title>Arbol Maps</title>
        -->
        <link rel="stylesheet" href="cssi/normalize.css">
        <link rel="stylesheet" href="cssi/main.css" media="screen" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
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
                        -->
                        <a class="navbar-brand" href="#">SamanGir</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="navactive color_animation" href="#top">INICIO</a></li>
                            <li><a class="color_animation" href="#story">OBJETIVO</a></li>
                            <!--
                            <li><a class="color_animation" href="#featured">OBJETIVO</a></li>
                            -->
                            <li><a class="color_animation" href="#contact">CONTACTENOS</a></li>
                            @if (Route::has('login'))
                                @if (Auth::check())
                            <li><a class="color_animation" href="{{ url('dashboard') }}">PANEL DE CONTROL</a></li>
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

        



        <div id="top" class="starter_container bg">
            <div class="follow_container">
                <div class="col-md-6 col-md-offset-3">
                    <a href="http://localhost/ArbolMapsv2/public/dashboard" class="logo">
        <span class="logo-mini"><b>S</b>G</span>
        <span class="logo-lg"><b>Saman</b>Gir</span>
        </a>

                    <h2 class="top-title"> SamanGir</h2>
                    <h2 class="white second-title">" Control y manejo de zonas verdes "</h2>
                    <hr>
                
                </div>
            </div>
        </div>

        <!-- ============ About Us ============= -->

        <section id="story" class="description_content">
            <div class="text-content container">
                <div class="col-md-6">
                    <h1>objetivos del software</h1>
                    <br><br>
                    <!--
                    <div class="fa fa-cutlery fa-2x"></div>
                    --><p class="desc-text">
                        Este  aplicativo contribuye a acelerar los procesos de las zonas verdes 
                        logrando impactar de manera favorable en la conservación de las especies forestales, en la cual con el uso de un mapa interactivo mejorar la perspectiva de las zonas verdes.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="img-section">
                       <img src="imagesi/kabob.jpg" width="250" height="220">
                       <img src="imagesi/limes.jpg" width="250" height="220">
                       <div class="img-section-space"></div>
                       <img src="imagesi/radish.jpg"  width="250" height="220">
                       <img src="imagesi/corn.jpg"  width="250" height="220">
                   </div>
                </div>
            </div>
        </section>


      

     


        
        <!-- ============ Featured Dish  ============= -->
<!--
        <section id="featured" class="description_content">
            <div  class="featured background_content">
                <h1> Objetivo del  <span>proyecto</span></h1>
            </div>
            <div class="text-content container"> 
                <div class="col-md-6">
                    <h1>Objetivos de este proyecto</h1>
                    <div class="icon-hotdog fa-2x"></div>
                    <p class="desc-text">Este proyecto es parte de un programa para la recolección
                                        de datos sobre árboles y
                                        Parque que tiene un municipio o ciudad.</p>
                </div>
                <div class="col-md-6">
                    <ul class="image_box_story2">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="imagesi/slider1.jpg"  alt="...">
                                    <div class="carousel-caption">
                                        
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="imagesi/slider2.jpg" alt="...">
                                    <div class="carousel-caption">
                                        
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="imagesi/slider3.JPG" alt="...">
                                    <div class="carousel-caption">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </section>
-->


        
        <!-- ============ Social Section  ============= -->
      
        <section class="social_connect">
            <div class="text-content container"> 
                <div class="col-md-6">
                    <span class="social_heading">Redes Sociales</span>
                    <ul class="social_icons">
                        <li><a class="icon-twitter color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-github color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-linkedin color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-mail color_animation" href="#"></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <span class="social_heading">Contáctenos</span>
                    <span class="social_info"><a class="color_animation" href="tel:883-335-6524">(+57) 311 839 4534</a></span>
                </div>
            </div>
        </section>

        <!-- ============ Contact Section  ============= -->

        <section id="contact">
            <div class="map">
               <div style="width: 100%"><iframe width="100%" height="600" src="https://maps.google.com/maps?width=100%&height=600&hl=es&coord=4.3011202,-74.8027673&q=girardot+(Contactos)&ie=UTF8&t=&z=16&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.mapsdirections.info/crear-un-mapa-de-google/">Crear Google Map</a> by <a href="https://www.mapsdirections.info/">Mapa España</a></iframe></div><br />
            </div>
            <div class="container">
                <div class="row">
                                
                    <form id="contactForm" action="contact_form.php" method="post">
                        <!-- Left Inputs -->
                        <div class="col-md-6 ">
                            <div class="input-group">       
                                <input class="form form-control" type="text" placeholder="Nombre" name="name" required>
                            </div>
                            <div class="input-group">       
                                <input class="form form-control" name="email" type="email" placeholder="Correo Electrónico" required>
                            </div>
                            <div class="input-group">       
                                <input class="form form-control" type="tel" placeholder="Numeros telefonico" name="number">
                            </div>
                            
                        </div><!-- End Left Inputs -->


                        <!-- Right Inputs -->
                        <div class="col-md-6">
                            <div class="input-group">
                                <textarea class="form form-control" rows="9" placeholder="Escriba tu Mensaje" name="message"></textarea>
                            </div>
                            <button id="cfsubmit" type="submit" class="text-center form-btn form-btn">Enviar un Mensaje</button>
                        
                        </div><!-- End Contact Form Area -->
                </form>
                <div id="contactFormResponse"></div>

                       
            </div>
        </section>

        <!-- ============ Footer Section  ============= -->

        <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center">&copy; ArbolMap 2017, </p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Regresar desde el inicio <a href="#top">Inicio</a></p>
                </div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Desarrollador por: <a href="#" target="_blank"> Marcos Alberto Saavedra y Edwin Orlando Raquejo Contreras</a></p></div>
            </div>
        </footer>


        <script type="text/javascript" src="jsi/jquery-1.10.2.min.js"> </script>
        <script type="text/javascript" src="jsi/bootstrap.min.js" ></script>
        <script type="text/javascript" src="jsi/jquery-1.10.2.js"></script>     
        <script type="text/javascript" src="jsi/jquery.mixitup.min.js" ></script>
        <script type="text/javascript" src="jsi/main.js" ></script>

    </body>
</html>
