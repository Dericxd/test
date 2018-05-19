<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'LEIPEL')); ?></title>

    <!-- Styles -->
    
    
    <!-- Styles del AdminLTE-->

    <!--                                 del template de vistor Bootstrap               -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/visitor/css/bootstrap.min.css')); ?>" >

    <!-- del template visitor  Custom CSS -->
    <link href="<?php echo e(asset('plugins/visitor/css/style.css')); ?>" rel='stylesheet' type='text/css' />
    <link href="<?php echo e(asset('plugins/visitor/css/style-responsive.css')); ?>" rel="stylesheet"/>
    <!-- font CSS -->

    <!--                             Iconos                                                -->
    

    <!--        del template visitor font-awesome icons         -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/visitor/css/font.css')); ?>" type="text/css"/>
    <link href="<?php echo e(asset('plugins/visitor/css/font-awesome.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('plugins/visitor/css/morris.css')); ?>" type="text/css"/>

                        <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/LTE/thema/Ionicons/css/ionicons.min.css')); ?>">
    <!--                             Iconos                                                -->

    <!--    del template visitor calendar   -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/visitor/css/monthly.css')); ?>">
    <!--        //calendar          -->

    <!--       del template visitor     //font-awesome icons -->

    <script src="<?php echo e(asset('plugins/visitor/js/raphael-min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/visitor/js/morris.js')); ?>"></script>
    <!-- del template admin del seller Morris chart -->


    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/LTE/thema/jvectormap/jquery-jvectormap.css')); ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    
    <link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    
    <style type="text/css">
#image-preview {
  width: 280px;
  height: 400px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}
 * {
    box-sizing: border-box;
}

.zoom {
    padding: 50px;
    background-color: transparent;
    transition: transform .2s;
    width: 200px;
    height: 200px;
    margin-bottom: 20px;
}

.zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
}
</style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>

</head>
<body>
<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <!--logo start-->
        <div class="brand">
            <a href="<?php echo e(url('/')); ?>" class="logo">
                
            </a>
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars"></div>
            </div>
        </div>
        <!--logo end-->
        <?php echo $__env->make('layouts.partials.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </header>
    <!--header end-->

    <!--sidebar start-->
    <?php echo $__env->make('layouts.partials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--sidebar end-->

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">


            <br/>
            <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>



        </section>
        <!-- footer -->
        <div class="footer ">
            <div class="">
                <p>Leipel 2018</p>
            </div>
        </div>
        <!-- / footer -->
    </section>
    <!--main content end-->
</section>

<!-- Scripts -->


<script src="<?php echo e(asset('plugins/visitor/js/jquery2.0.3.min.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/bootstrap.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/jquery.dcjqaccordion.2.7.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/scripts.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/script.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/upload/jquery.uploadPreview.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/jquery.slimscroll.js')); ?>"></script>

<script src="<?php echo e(asset('plugins/visitor/js/jquery.nicescroll.js')); ?>"></script>

<!--[if lte IE 8]>
<script language="javascript" type="text/javascript" src="<?php echo e(asset('plugins/visitor/js/flot-chart/excanvas.min.js')); ?>"></script>
<![endif]-->

<script src="<?php echo e(asset('plugins/visitor/js/jquery.scrollTo.js')); ?>"></script>

<!-- del template admin de seller Morris.js charts -->



<?php echo $__env->yieldContent('js'); ?>



</body>
</html>
