      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <h5 class="centered">{{Auth::guard('Promoter')->user()->name_c}}</h5>
                  <div class="card-content white-text">
                      <span class="card-title centered"><h4><p>{{Auth::guard('Promoter')->user()->Roles()->first()->name}}</p></h4></span>
                      
                  </div>  
                    
                  <li class="mt">
                      <a href="#">
                          <i class="fa fa-user"></i>
                          <span>Mi Perfil</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="#">
                          <i class="fas fa-suitcase"></i>
                          <span>Contenido</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="{{url('admin_sellers')}}">
                          <i class="fas fa-user-tie"></i>
                          <span>Proveedores</span>
                      </a>
                  </li>                  

                  <li class="mt">
                      <a href="{{url('admin_applys')}}">
                          <i class="fas fa-archive"></i>
                          <span>Solicitudes</span>
                      </a>
                  </li>

                  <li class="mt">
                      <a href="#">
                          <i class="fa fa-users"></i>
                          <span>Clientes</span>
                      </a>
                  </li>                  
                  
                  @if(Auth::guard('Promoter')->user()->priority == 1 OR Auth::guard('Promoter')->user()->priority == 2)

                    <li class="mt">
                      <a href="{{url('BackendUsers')}}">
                          <i class="fa fa-wrench"></i>
                          <span>Usuarios Backend</span>
                      </a>
                  </li> 

                  @endif

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>