@if(Auth::check())
    <ul class="dropdown-content" id="user_tickets">
      <li>
          <a class="indigo-text tooltipped" data-position="left" data-tooltip="Comprar Tickets" href="#!">
           <i class="material-icons">add_shopping_cart</i>
          </a>
      </li>
      
      <li>
        <a class="indigo-text tooltipped" data-position="left" data-tooltip="Ver Transacciones" href="#!">
          <i class="material-icons">
          account_balance
          </i>
        </a>
      </li>   
    </ul>

    <ul class="dropdown-content" id="user_dropdown">
      <li>
        <a class="indigo-text tooltipped" data-position="left" data-tooltip="Editar Datos de Perfil" href="#!">
          <i class="material-icons">
                settings
          </i>
         </a>
     </li>
      
      <li>

        <a class="indigo-text tooltipped" data-position="left" data-tooltip="Salir" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

        <a class="indigo-text tooltipped" data-position="left" data-tooltip="Salir" href="{{ url('/logout') }}"
           onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
          <i class="material-icons">
          power_settings_new
          </i>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                  style="display: none;">
                {{ csrf_field() }}
            </form>
        </a>
      </li>
    
    </ul>
@endif
    <nav class="white" role="navigation">
      <div class="nav-wrapper">
        <a data-activates="slide-out" class="button-collapse show-on-large" href="#!"><img style="margin-top: 5px; width:30%; margin-left: 5px;" src="{{ asset('sistem_images/Logo-Leipel.png') }}"/></a>
@if(Auth::check())
        <ul class="right hide-on-med-and-down">
         
          <li>
            <a class='right dropdown-button' href='' data-activates='user_dropdown'><i class="fas fa-user" style="color: #3871b9"></i></a>
          </li>



          <li>
            <a class='right dropdown-button' href='' data-activates='user_tickets' style="color: #3871b9"><i class="fas fa-ticket-alt"></i></a>
          </li>
        </ul>

@else
<ul class="right hide-on-med-and-down">
<li>
  <a href="{{route('login')}}"><span class="blue-text">Iniciar Sesion</span></a>
</li>

<li>
  <a href="{{route('register')}}"><span class="blue-text">Registrarse</span></a>
</li>
</ul>


@endif

        <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
      </div>
    </nav>