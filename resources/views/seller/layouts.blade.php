<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link href="{{ asset('plugins/materialize_adm/css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link href="{{ asset('plugins/materialize_adm/css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>

        <!--Let browser know website is optimized for mobile-->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <title>{{ config('app.name', 'Leipel') }}</title>
    </head>

    <body>

            <header>

                <!--Menu superior navbar-->
                <div class="navbar-fixed" >
                    <nav class="blue">
                        <div class="nav-wrapper">

                            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons ">menu</i></a>

                            <!-- Logo principal -->
                            <a href="{{ url('/home')}}" class="brand-logo left logo-adjust">
                                <img class="responsive-img img-logo" src="{{asset('sistem_images/Leipel Logo1-01.png')}}">
                            </a>
                            <!-- End logo principal -->

                            <!-- Img Contenido superior -->
                            @if(Auth::guard('web_seller')->user()->estatus ==='Aprobado')
                                <ul class="right" >
                                    @if($modulos!=false)
                                        @foreach($modulos as $mod)
                                            @if($mod->name == 'Peliculas')
                                                <li>
                                                    <img class="responsive-img   img-contenidos" src="{{asset('sistem_images/logo-icon-2.png') }}">
                                                </li>
                                            @endif
                                            @if($mod->name == 'Musica')
                                                <li>
                                                    <img class="responsive-img   img-contenidos" src="{{asset('sistem_images/logo-icon-4.png')  }}">
                                                </li>
                                            @endif
                                            @if($mod->name == 'Libros')
                                                <li>
                                                    <img class="responsive-img   img-contenidos" src="{{asset('sistem_images/logo-icon.png')  }}">
                                                </li>
                                            @endif
                                            @if($mod->name == 'Radios')
                                                <li>
                                                    <img class="responsive-img   img-contenidos" src="{{asset('sistem_images/logo-icon-5.png')  }}">
                                                </li>
                                            @endif
                                            @if($mod->name == 'TV')
                                                <li>
                                                    <img class="responsive-img   img-contenidos" src="{{asset('sistem_images/logo-icon-3.png') }}">
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            @endif
                            <!-- End Img Contenido superior -->

                        </div><!-- End nav-wrapper -->
                    </nav><!-- End navbar-->
            </div><!-- End navbar-fixed -->

            <!--Menu lateral sidenav-->
            <ul id="slide-out" class="sidenav sidenav-fixed">
                    
                <li><!--Seccion de usuario -->
                    <div class="user-view blue">
                    <div class="container">
                                @if(Auth::guard('web_seller')->user()->logo)
                                    <a href="#"><img src="{{asset(Auth::guard('web_seller')->user()->logo)}}" alt="Avatar" class=" z-depth-3 responsive-img circle logo-container img-perfil"></a><!-- logo user -->
                                @else
                                    <a href="#"><img src="{{asset('sistem_images/DefaultUser.png')}}" alt="Avatar" class=" z-depth-3 responsive-img circle logo-container img-perfil"></a><!-- logo user -->
                                @endif
                    </div>
                    <div class="container">
                                <a href="#">
                                    <span class="name white-text">{{Auth::guard('web_seller')->user()->name}}</span>
                                </a>
                                
                               Tickets Disponibles:
                    </div>
                </li><!--End eccion de usuario -->

                    <li>
                    <a href="{{url('seller_edit')}}" class="waves-effect waves-blue"><i class="small material-icons">person</i>Mi Perfil</a></li>
                    <li><div class="divider"></div></li>
                    <li><a href="{{url('SellerRequest')}}" class="waves-effect waves-blue "><i class="small material-icons">attach_money</i>Retiro de fondo</a></li>

<!-- ////////////////////////////////////////////////////////////          Contenidos          ////////////////////////////////////////-->


            @if(Auth::guard('web_seller')->user()->estatus ==='Aprobado')

                                        {{--Accesos a los modulos --}}
                                    <li> <!-- COMTENIDOS -->
                                        <ul class= "collapsible collapsible-accordion" >

                                            <li>
                                              <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >apps</i>Mi contenido<i class="material-icons right" >expand_more</i></a>

                                           
                                                @if($modulos==false)
                                                <div class="collapsible-body">
                                                <blockquote>Aún no posee módulos asignados.</blockquote>
                                                </div>
                                                <div class="collapsible-body"> <!--Inicio body ul contenido sin módulos asignado -->
                                                <ul> <!--END ul contenidos -->
                                                @else
                                                <div class="collapsible-body"> <!--Inicio body ul contenido con módulos asignado -->
                                                <ul> <!--END ul contenidos -->
                                                    @foreach($modulos as $mod)
                                                        {{--musica--}}
                                                        @if($mod->name == 'Musica')
                                                            <li><!-- musica -->
                                                            <ul class= "collapsible collapsible-accordion" >
                                                            <li>

                                                            <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >music_note</i>Musica<i class="material-icons right">expand_more</i></a>
                                                               
                                                                <div class="collapsible-body">
                                                                <ul>
                                                                    <li><a href="{{ url('/albums') }}">Registrar álbum</a></li>
                                                                    <li><a href="{{ url('/single_registration') }}">Registrar canciones</a></li>
                                                                    @foreach($modulos as $mod)
                                                                        @if($mod->name == 'Productora')
                                                                            <li>
                                                                                <a href="{{ url('/showArtist') }}">
                                                                                        Listar artistas
                                                                                </a>
                                                                            </li>
                                                                        @elseif($mod->name == 'Artista')
                                                                            @if(count(App\music_authors::where('seller_id',Auth::guard('web_seller')->user()->id)->get())==0)
                                                                                <!-- Validar que las frases quepan en el espacio mostrado -->
                                                                                <li>
                                                                                    <a href="{{ url('/artist_form') }}">
                                                                                            Registrar grupo o solista
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
                                                                    <li><div class="divider"></div></li>
                                                                </ul>
                                                                </div>
                                                                </li>
                                                            </ul>
                                                            </li><!--End musica -->
                                                        @endif
                                                        {{--peliculas--}}
                                                        @if($mod->name =='Peliculas')
                                                            <li><!--Peliculas -->
                                                                 <ul class= "collapsible collapsible-accordion" >
                                                                    <li>

                                                                        <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >movie</i>Películas<i class="material-icons right">expand_more</i></a>
                                                                
                                                                        <div class="collapsible-body">
                                                                            <ul>
                                                                                <li><a href="{{ url('/movies/create') }}">Registrar película</a></li>
                                                                                <li><a href="{{ url('/movies') }}">Películas registradas</a></li>
                                                                                <li><div class="divider"></div></li>
                                                                            </ul>
                                                                        </div>
                                                                 </li>
                                                                </ul>
                                                            </li><!-- End Peliculas -->
                                                        @endif
                                                        {{--revistas--}}
                                                        @if($mod->name == 'Revistas')
                                                            <li> <!-- REvistas -->
                                                                <ul class= "collapsible collapsible-accordion" >
                                                                <li>

                                                                 <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >import_contacts</i>Revistas<i class="material-icons right">expand_more</i></a>

                                                                 <div class="collapsible-body">
                                                                        <ul>
                                                                            <li><a href="{{ url('/megazine_form') }}">Registrar revista</a></li>
                                                                            <li><a href="{{ url('/type') }}">Cadena de publicaciones</a></li>
                                                                            <li><a href="{{ url('/my_megazine',Auth::guard('web_seller')->user()->id) }}">Mis revistas</a></li>
                                                                            <li><div class="divider"></div></li>
                                                                        </ul>
                                                                </div>
                                                                </li>
                                                                </ul>
                                                            </li><!-- End Revistas -->
                                                        @endif
                                                        {{--series--}}
                                                        @if($mod->name == 'Series')
                                                            <li><!-- Series-->
                                                                <ul class= "collapsible collapsible-accordion" >
                                                                <li>

                                                                <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >local_movies</i>Series<i class="material-icons right">expand_more</i></a>

                                                                <div class="collapsible-body">
                                                                 <ul>
                                                                    <li><a href="{{ url('/series/create') }}">Registrar serie</a></li>
                                                                    <li><a href="{{ url('/series') }}">Series registradas</a></li>
                                                                    <li><div class="divider"></div></li>

                                                                </ul>
                                                                </div>
                                                                </li>
                                                                </ul>
                                                            </li><!-- End Series -->
                                                        @endif
                                                        {{--libros--}}
                                                        @if($mod->name == 'Libros')
                                                            <li><!-- Libros-->
                                                                <ul class= "collapsible collapsible-accordion" >
                                                                <li>

                                                                <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >book</i>Libros<i class="material-icons right">expand_more</i></a>

                                                                <div class="collapsible-body">
                                                                <ul>
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
                                                                    <li><div class="divider"></div></li>
                                                                </ul>
                                                                </div>
                                                                </li>
                                                                </ul>
                                                            </li><!-- End Libros -->
                                                        @endif

                                                        {{--radios--}}
                                                        @if($mod->name == 'Radios')
                                                            <li><!-- Radios -->
                                                                <ul class= "collapsible collapsible-accordion" >
                                                                <li>

                                                                <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >radio</i>Radio<i class="material-icons right">expand_more</i></a>

                                                                        <div class="collapsible-body">
                                                                            <ul class="sub">
                                                                                <li><a href="{{ url('/radios') }}">Registro de radios</a></li>
                                                                                <li><a href="{{ url('/radios/create') }}">Registrar radio</a></li>
                                                                                <li><div class="divider"></div></li>

                                                                            </ul>
                                                                        </div>
                                                                  </li>
                                                                  </ul>
                                                            </li><!-- End Radios -->
                                                        @endif
                                                        {{--Tvs--}}

                                                        @if($mod->name == 'TV')
                                                            <li ><!--Tv  -->
                                                                <ul class= "collapsible collapsible-accordion" >
                                                                <li>

                                                                <a href="javascript:;" class="collapsible-header waves-effect waves-blue"><i class="small material-icons left" >live_tv</i>TV<i class="material-icons right">expand_more</i></a>

                                                                 <div class="collapsible-body">
                                                                <ul>
                                                                    <li><a href="{{ url('/tvs') }}">Registro de TV's</a></li>
                                                                    <li><a href="{{ url('/tvs/create') }}">Registrar TV's</a></li>
                                                                    <li><div class="divider"></div></li>
                                                                </ul>
                                                                  </div>
                                                                  </li>
                                                                  </ul>
                                                            </li><!--End Tv  -->
                                                        @endif
                                                    @endforeach
                                                @endif

                                            </ul><!--END ul todos los contenidos -->
                                            </div><!-- Body ul contenidos -->
                                            </li><!--li interno contenidos -->
                                        </ul><!--End  externo collapsible -->
                                 </li> <!--End li externo COMTENIDOS -->

<!-- //////////////////////////////////////////////////////////// END  contenidos ////////////////////////////////////////-->

                                {{--Cuenta en proceso de Pre-Aprobación--}}
            @elseif(Auth::guard('web_seller')->user()->estatus ==='Pre-Aprobado')
                                <li>
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
                                <li>
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
                                <li>
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
                         <!--    <li>
                                <a href="{{ url('/seller_logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <span>
                                                <i class="glyphicon glyphicon-off"></i>
                                                Salir
                                            </span>
                                </a>
                                <form id="logout-form" action="{{ url('/seller_logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li> -->
                            <li>

                                <a href="{{ url('/seller_logout') }}" class="waves-effect waves-blue " onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="small material-icons">power_settings_new</i>Salir</a>
                                            
                                               
                                              
                                            
                                </a>
                                <form id="logout-form" action="{{ url('/seller_logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>


                        </ul><!-- End -->








                    </li>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a><!-- boton Hamburguesa menu -->

            </header>


            <main>
                <section id="main-content" class="section section-daily-stats center">

                    <div class="row">
                       @yield('content')  
                    </div>

                </section>
            </main> <!-- End main -->

            <footer class="page-footer blue ">
                <div class="footer-copyright">
                    <div class="container center">
                        Leipel &copy 2018. Todos los Derechos Reservados.
                    </div>
                </div>
            </footer>




            <!-- <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script> -->
            <script src="{{asset('assets/js/jquery.js') }}"></script>
            <!--Import jQuery before materialize.js-->
            <script src="{{asset('plugins/materialize_adm/js/materialize.js') }}"></script>
            <script src="{{asset('plugins/materialize_adm/js/init.js') }}"></script>



    </body><!-- End body -->
</html>
