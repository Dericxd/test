<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Dashboard">
        <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <title>Leipel</title>


        <!-- Bootstrap core CSS -->
        <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
        <!--external css-->
        <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('assets/css/zabuto_calendar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/gritter/css/jquery.gritter.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset ('assets/lineicons/style.css') }}">    

        <!-- Custom styles for this template -->
        <link href="{{ asset ('assets/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset ('assets/css/style-responsive.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
            }
        </style>

        @yield('css')

        <script src="{{ asset ('assets/js/chart-master/Chart.js')}}"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
  
    <body>

        <section id="container" >
            <!--
            TOP BAR CONTENT & NOTIFICATIONS
            -->
            <!--header start-->
            <header class="header" style="background: white">
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars tooltips" data-placement="right" data-original-title=""></div>
                </div>
                <!--logo start-->
                <a href="{{ url('/home')}}" class="logo"><b><img src="{{asset('sistem_images/Logo-Leipel.png')}}" width="150px">
            </b></a>
                <div class="nav pull-right top-menu" id="boton" >
                    <div class="navbar-right" style="margin-top: 12px;">
                        @foreach($modulos as $mod)
                            @if($mod->name == 'Peliculas')
                                <a href="{{ url('/movies') }}" class="logo"><b><img height="39px" src="{{asset('plugins/img/cine.png')}}"></b></a>
                            @endif                          
                            @if($mod->name == 'Musica')
                                <a href="{{ url('/my_music_panel/'.Auth::guard('web_seller')->user()->id) }}" class="logo"><b><img height="39px" src="{{asset('plugins/img/musica.png')}}"></b></a>
                            @endif
                            @if($mod->name == 'Libros')
                                <a href="{{ url('/tbook') }}" class="logo"><b><img height="39px" src="{{asset('plugins/img/lectura.png')}}"></b></a>
                            @endif
                            @if($mod->name == 'Radios')
                                <a href="#" class="logo"><b><img height="39px" src="{{asset('plugins/img/radio.png')}}"> </b></a>
                            @endif
                            @if($mod->name == 'TV')
                                <img height="39px" src="{{asset('plugins/img/tv.png')}}">
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="nav notify-row" id="top_menu">
                    
                    
                </div>
                <!--
                <div class="top-menu">
                    <ul class="nav pull-right top-menu">
                        <li>
                            <a class="logout" href="{{ url('/logout') }}">Salir</a>
                        </li>
                    </ul>
                </div>
                -->
            </header>
            <!--header end-->
            <!-- 
            MAIN SIDEBAR MENU
            -->
            <!--sidebar start-->
            <aside>
                <div id="sidebar"  class="nav-collapse ">
                    <!-- sidebar menu start-->
                    <ul class="sidebar-menu" id="nav-accordion" style="margin-top: 25%; display: none;">
                        <p class="centered">
                            <!--Revisar este enlace -->
                            <a href="{{ url('/seller_home')}}">
                                @if(Auth::guard('web_seller')->user()->logo!="NULL")
                                    <img src="{{asset(Auth::guard('web_seller')->user()->logo)}}" class="img-circle" width="80">
                                @else
                                    <img src="{{asset('sistem_images/DefaultUser.png')}}" class="img-circle" width="80">
                                @endif
                            </a>
                        </p>
                        <h5 class="centered" style="text-shadow: 0.1em 0.1em #333">
                            {{Auth::guard('web_seller')->user()->name}}
                        </h5>
                        <div class="card-content white-text">
                            <span class="card-title centered"><h6>Tickets Disponibles: <p>{{Auth::guard('web_seller')->user()->credito}}</p></h6></span>
                        </div>
                       <!--  <li class="mt">
                            <a class="active" href="{{ url('seller_home') }}">
                                <i class="glyphicon glyphicon-home"></i>
                                <span>Escritorio</span>
                            </a>
                        </li> -->
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-user"></i>
                                <span>Mi perfil</span>
                            </a>
                        </li>
                        <!-- <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-users"></i>
                                <span>Referidos</span>
                            </a>
                            <ul class="sub">
                                <li><a href="#">Mis redes</a></li>
                                <li><a href="#">Mis amigos</a></li>
                                <li><a href="#">Referir</a></li>
                            </ul>
                        </li> -->
                        <!-- <li class="sub-menu">
                            <a href="javascript:;" >
                                <i class="fa fa-heart"></i>
                                <span>Seguidos</span>
                            </a>
                            <ul class="sub">
                                <li><a href="#">Mis seguidos</a></li>
                                <li><a href="#">Mis seguidores</a></li>
                                <li><a href="#">Proveedores</a></li>
                            </ul>
                        </li> -->

                        @if(Auth::guard('web_seller')->user()->estatus ==='Aprobado')

                            {{--Accesos a los modulos --}}
                            <li class="sub-menu" style="margin-bottom: 25%;">
                                <a href="javascript:;">
                                    <i class="li_stack"></i>
                                    <span>Mi contenido</span>
                                </a>
                                <ul class="sub">
                                    @if($modulos==false)
                                        <li class="treeview">
                                            <a href="#">
                                                Aún no posee módulos 
                                                asignados.
                                            </a>
                                        </li>
                                    @else
                                        @foreach($modulos as $mod)
                                            {{--musica--}}
                                            @if($mod->name == 'Musica')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="li_music"></i>
                                                        <span>Música</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/albums') }}">Registrar álbum</a></li>
                                                        <li><a href="{{ url('/single_registration') }}">Registrar canciones</a></li>
                                                        @foreach($modulos as $mod)
                                                            @if($mod->name == 'Productora')
                                                                <li class="treeview">
                                                                    <a href="{{ url('/showArtist') }}">
                                                                        <span>
                                                                            Listar artistas
                                                                        </span>
                                                                    </a>
                                                                </li>
                                                            @elseif($mod->name == 'Artista')
                                                                @if(count(App\music_authors::where('seller_id',Auth::guard('web_seller')->user()->id)->get())==0)
                                                                    <!-- Validar que las frases quepan en el espacio mostrado -->
                                                                    <li class="treeview">
                                                                        <a href="{{ url('/artist_form') }}">
                                                                            <span>
                                                                                Registrar grupo musical
                                                                                o solista
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <!-- Validar que las frases quepan en el espacio mostrado -->
                                                                @else
                                                                    <li>
                                                                        <a href="{{ url('/modify_artist') }}">
                                                                            Artista
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        <li><a href="{{ url('/my_music_panel/'.Auth::guard('web_seller')->user()->id) }}">Mi música</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--peliculas--}}
                                            @if($mod->name =='Peliculas')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-film"></i>
                                                        <span>Películas</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/movies/create') }}">Registrar película</a></li>
                                                        <li><a href="{{ url('/movies') }}">Películas registradas</a></li>
                                                        <!--Revisar este enlace porque es igual al registro de musica-->
                                                        <!--
                                                        <li><a href="{{ url('/single_registration') }}">Mis Películas</a></li>
                                                        -->
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--revistas--}}
                                            @if($mod->name == 'Revistas')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-archive"></i>
                                                        <span>Revistas</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/megazine_form') }}">Registrar revista </a></li>
                                                        <!-- <li><a href="{{ url('/megazine_form') }}">Registrar revista independiente</a></li> -->
                                                        <!-- <li><a href="{{ url('/megazine_form') }}">Agregar revistas a cadenas de publicación</a></li> -->
                                                        <li><a href="{{ url('/type') }}">Cadena de publicaciones</a></li>
                                                        <li style="top: 20px"><a href="{{ url('/my_megazine',Auth::guard('web_seller')->user()->id) }}">Mis revistas</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--series--}}
                                            @if($mod->name == 'Series')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="li_video"></i>
                                                        <span>Series</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/series/create') }}">Registrar serie</a></li>
                                                        <li><a href="{{ url('/series') }}">Series registradas</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--libros--}}
                                            @if($mod->name == 'Libros')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-book"></i>
                                                        <span>Libros</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/tbook/create') }}">Registrar libro</a></li>
                                                        <li><a href="{{ url('/tbook') }}">Libros registrados</a></li>
                                                        @foreach($modulos as $mod)
                                                            @if($mod->name == 'Editorial')
                                                                <li>
                                                                    <a href="{{ url('/authors_books') }}">Listar autores</a>
                                                                </li>
                                                            @elseif($mod->name == 'Escritor')
                                                                @if(count(App\BookAuthor::where('seller_id',Auth::guard('web_seller')->user()->id)->get())==0)
                                                                    <li>
                                                                        <a href="{{ url('/authors_books/create') }}">Registrar autor</a>
                                                                    </li>
                                                                @else
                                                                    <li>
                                                                        @php
                                                                            $id = App\BookAuthor::where('seller_id',\Auth::guard('web_seller')->user()->id)->get()
                                                                        @endphp
                                                                        <a href="{{ route('authors_books.edit',$id[0]) }}">Modificar autor</a>
                                                                    </li>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--radios--}}
                                            @if($mod->name == 'Radios')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="glyphicon glyphicon-stats"></i>
                                                        <span>Radio</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/radios') }}">Registro de radios</a></li>
                                                        <li><a href="{{ url('/radios/create') }}">Registrar radio</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                            {{--Tvs--}}
                                            @if($mod->name == 'TV')
                                                <li class="sub-menu">
                                                    <a href="javascript:;">
                                                        <i class="fa fa-desktop"></i>
                                                        <span>TV</span>
                                                    </a>
                                                    <ul class="sub">
                                                        <li><a href="{{ url('/tvs') }}">Registro de TV's</a></li>
                                                        <li><a href="{{ url('/tvs/create') }}">Registrar TV's</a></li>
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                        {{--Cuenta en proceso de Pre-Aprobación--}}
                        @elseif(Auth::guard('web_seller')->user()->estatus ==='Pre-Aprobado')
                            <li class="treeview" style="margin-bottom: 50%;">
                                <a href="#">
                                    <span>
                                        <i class="fa fa-warning"></i>
                                        <br>
                                        Su solicitud de cuenta como
                                        productora está en proceso de
                                        analisis por parte de
                                        nuestros analistas, pronto nos
                                        comunicaremos con ustedes.
                                    </span>
                                </a>
                            </li>
                        {{--Cuenta en proceso de revision--}}
                        @elseif(Auth::guard('web_seller')->user()->estatus === 'En Proceso')
                            <li class="treeview" style="margin-bottom: 50%;">
                                <a href="#">
                                    <span>
                                        <i class="fa fa-warning"></i>
                                        
                                        Su solicitud de cuenta como 
                                        productora está en proceso 
                                        por favor finalice el 
                                        registro para continuar
                                    </span>
                                </a>
                            </li>
                        {{--Cuenta con estatus de Rechazado--}}
                        @else(Auth::guard('web_seller')->user()->estatus === 'Rechazado')
                            <li class="treeview" style="margin-bottom: 50%;">
                                <a href="#">
                                    <span>
                                        <i class="fa fa-warning"></i>
                                       
                                        Su solicitud de cuenta como
                                        productora fue rechazada
                                        por favor pongase en contacto
                                        con el administrados de sistema
                                    </span>
                                </a>
                            </li>
                        @endif
                        <li class="sub-menu  hidden-xs hidden-sm"  style="position: relative;  top: 1%  ">
                            <a href="{{ url('/seller_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span>
                                    <i class="glyphicon glyphicon-off"></i>
                                    Salir
                                </span>
                            </a>
                            <form id="logout-form" action="{{ url('/seller_logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <li class="sub-menu sidebar-menu  hidden-md hidden-lg hidden-xg" id="nav-accordion">
                            <a href="{{ url('/seller_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span>
                                    <i class="glyphicon glyphicon-off"></i>
                                    Salir
                                </span>
                            </a>
                            <form id="logout-form" action="{{ url('/seller_logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </aside>
            <!--sidebar end-->
            <section id="main-content">
                <section class="wrapper">
                    <div class="row">
                        <div class="col-lg-12 main-chart">
                            @yield('content')
                        </div>
                        <div class="col-lg-3 ds" style="margin-bottom: 50%;">
                           {{-- @include('seller.partials.siderRigth')--}} 
                        </div><!-- /col-lg-3 -->
                    </div>
                </section>
            </section> 
        @extends('seller.partials.footer')

    </body>
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{asset('assets/js/jquery.js') }}"></script>
    {{--<script src="{{asset('assets/js/jquery-1.8.3.min.js') }}"></script>--}}
    <script src="{{asset('assets/js/bootstrap.min.js') }}"></script>
    <script class="include" type="text/javascript" src="{{asset('assets/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/jquery.sparkline.js')}}"></script>

   
    <!--common script for all pages-->
    <script src="{{asset('assets/js/common-scripts.js')}}"></script>
    
    <script type="text/javascript" src="{{asset('assets/js/gritter/js/jquery.gritter.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/gritter-conf.js')}}"></script>

    <!--script for this page-->
    <script src="{{asset('assets/js/sparkline-chart.js')}}"></script>    
    {{--<script src="{{asset('assets/js/zabuto_calendar.js')}}"></script> --}}


<!--SCRIPS JS-->
  
  <script type="application/javascript">
    /*
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });
        
            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                },
                legend: [
                    {type: "text", label: "Special event", badge: "00"},
                    {type: "block", label: "Regular event", }
                ]
            });
        });
        
        
        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    */
    </script>
    <script type="text/javascript">
$(document).ready(function() {
        if ((screen.width <= 768)) {
        //alert('Resolucion: 1024x768 o mayor');
          $('#container').addClass('sidebar-closed');
        }else{
          $('#container').removeClass('sidebar-close');
        }

});
</script>
    @yield('js')


</html>
