
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">

    <title>LEIPEL</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('assets/css/bootstrap.css')); ?>" rel="stylesheet">
    <!--external css-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="<?php echo e(asset ('assets/css/zabuto_calendar.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/js/gritter/css/jquery.gritter.css')); ?>" />
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset ('assets/lineicons/style.css')); ?>">    
    
    <!-- Custom styles for this template -->
    <link href="<?php echo e(asset ('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset ('assets/css/style-responsive.css')); ?>" rel="stylesheet">

    <script src="<?php echo e(asset ('assets/js/chart-master/Chart.js')); ?>"></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
   <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo e(url('/promoter_home')); ?>" class="logo"><b><img src="<?php echo e(asset('sistem_images/Leipel Logo1-01.png')); ?>" width="110px"></b></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
               

                <!--  notification start -->
                <ul class="nav top-menu">

                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-theme">4</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 4 pending tasks</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <div class="task-info">
                                        <div class="desc">DashGum Admin Panel</div>
                                        <div class="percent">40%</div>
                                    </div>
                                    <div class="progress progress-striped">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                            <i class="fa fa-envelope"></i>
                            <span class="badge bg-theme">5</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <div class="notify-arrow notify-arrow-green"></div>
                            <li>
                                <p class="green">You have 5 new messages</p>
                            </li>
                            <li>
                                <a href="index.html#">
                                    <span class="photo"><img alt="avatar" src="assets/img/ui-zac.jpg"></span>
                                    <span class="subject">
                                    <span class="from">Zac Snider</span>
                                    <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hi mate, how is everything?
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="<?php echo e(url('/promoter_logout')); ?>">Logout</a></li>
                </ul>
            </div>
        </header>
      <!--header end-->
       <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU 
      *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <h5 class="centered"><?php echo e(Auth::guard('Promoter')->user()->name_c); ?></h5>
                  <div class="card-content white-text">
                      <span class="card-title centered"><h4><p><?php echo e(Auth::guard('Promoter')->user()->Roles()->first()->name); ?></p></h4></span>
                      
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
                      <a href="<?php echo e(url('admin_sellers')); ?>">
                          <i class="fas fa-user-tie"></i>
                          <span>Proveedores</span>
                      </a>
                  </li>                  

                  <li class="mt">
                      <a href="#">
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
                  
                  <?php if(Auth::guard('Promoter')->user()->priority == 1 OR Auth::guard('Promoter')->user()->priority == 2): ?>

                    <li class="mt">
                      <a href="#">
                          <i class="fa fa-wrench"></i>
                          <span>Usuarios Backend</span>
                      </a>
                  </li> 

                  <?php if(Auth::guard('Promoter')->user()->priority == 1): ?>

                    <li class="mt">
                      <a href="#">
                          <i class="fa fa-wrench"></i>
                          <span>Admins</span>
                      </a>
                  </li> 
                  
                  <?php endif; ?>

                  <?php endif; ?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      <section id="main-content">
          <section class="wrapper">
                <div class="row">
                    <div class="col-lg-9 main-chart">
                        <?php echo $__env->yieldContent('main'); ?>
                    </div>
                    <div class="col-lg-3 ds">
                        <?php echo $__env->make('promoter.layouts.partials.siderRigth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                    </div><!-- /col-lg-3 -->
                </div>
          </section>
      </section> 
<?php echo $__env->make('promoter.layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>
