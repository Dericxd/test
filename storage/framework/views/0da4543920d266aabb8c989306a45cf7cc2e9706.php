<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Leipel')); ?></title>

    <!-- Styles -->
    
    <link rel="stylesheet" href="<?php echo e(asset('plugins/bootstrapV3.3/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('plugins/LTE/thema/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/css/login3.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/css/slick-team-slider.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('plugins/css/style.css')); ?>">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>;
    </script>
</head>
<body>
<div id="app">
    <!--HEADER START-->
    <div class="main-navigation">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo e(Request::url()); ?>"><img
                                src="<?php echo e(asset('plugins/img/Logo-Leipel.png')); ?>" width="150" height="50" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="<?php echo e(Request::url()); ?>">Inicio</a></li>
                        <li><a href="#portfolio">Destacados</a></li>
                        <li><a href="#about">Proveedores</a></li>
                        <li><a href="<?php echo e(url('/login')); ?>">Iniciar Sesion</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <!--HEADER END-->


<!--BANNER START-->
    <div id="banner" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="jumbotron">
                    <h1 class="small">Entretenimiento Al <span class="bold">M&aacute;ximo</span></h1>
                    <a href="<?php echo e(url('/register')); ?>" class="btn btn-banner">Registrate Gratis<i class="fa fa-send"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!--BANNER END-->

    <!--CTA1 START-->
    <div class="cta-1">
        <div class="container">
            <div class="row">
                <style type="text/css">
                    * {
                        box-sizing: border-box;
                    }

                    .zoom {
                        padding: 50px;
                        background-color: transparent;
                        transition: transform .2s;
                        width: 200px;
                        height: 200px;
                        margin: 0 auto;
                    }

                    .zoom:hover {
                        -ms-transform: scale(1.5); /* IE 9 */
                        -webkit-transform: scale(1.5); /* Safari 3-8 */
                        transform: scale(1.5);
                    }
                </style>
                <center>
                    <div class="col-md-4 zoom">
                        <a class="button" href="#"><img src="<?php echo e(asset('sistem_images/logo-icon-2.png')); ?>" width="200"
                                                        height="150" alt=""></a></div>
                    <div class="col-md-4 zoom">
                        <a class="button" href="#"><img src="<?php echo e(asset('sistem_images/logo-icon-4.png')); ?>" width="200"
                                                        height="150" alt=""></a></div>
                    <div class="col-md-4 zoom">
                        <a class="button" href="#"><img src="<?php echo e(asset('sistem_images/logo-icon.png')); ?>" width="200"
                                                        height="150" alt=""></a></div>
                    <div class="col-md-4 zoom">
                        <a class="button" href="#"><img src="<?php echo e(asset('sistem_images/logo-icon-5.png')); ?>" width="200"
                                                        height="150" alt=""></a>
                    </div>
                    <div class="col-md-4 zoom">
                        <a class="button" href="#"><img src="<?php echo e(asset('sistem_images/logo-icon-3.png')); ?>" width="200"
                                                        height="150" alt=""></a>
                    </div>
                </center>
            </div>
        </div>
    </div>
    <!--CTA1 END-->

    <div id="portfolio">
        <div class="container">
            <div class="page-title text-center">
                <h1>Destacados</h1>
                <hr class="pg-titl-bdr-btm"></hr>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul id="portfolio-flters">
                        <li data-filter=".filter-app, .filter-card, .filter-logo, .filter-web" class="filter-active">
                            All
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row" id="portfolio-wrapper">
                <?php $__currentLoopData = $book; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                <div class="col-lg-3 col-md-6 portfolio-item filter-app">
                    
                    <a href="">
                        <img src="<?php echo e(asset('images/bookcover/'. $b->cover)); ?>" class="image img-responsive" alt="">
                        <div class="details">
                            <h4><?php echo e($b->title); ?></h4>
                            <span><?php echo e($b->seller->name); ?></span>
                        </div>
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!--TEAM START-->
    <div id="about" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="page-title text-center">
                    <h1>Nuestros Proveedores</h1>
                    <hr class="pg-titl-bdr-btm"></hr>
                </div>
                <div class="autoplay">

                    
                    <?php $__currentLoopData = $seller; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($s->id < 5 ): ?>
                            <div class="col-md-6">
                                <div class="team-info">
                                    <div class="img-sec">
                                        <img src="<?php echo e(asset('plugins/img/agent1.jpg')); ?>" class="img-responsive">
                                    </div>
                                    <div class="fig-caption">
                                        <h3><?php echo e($s->name); ?></h3>
                                        <p class="marb-20">Sr. UI Developers</p>
                                        <p>Follow me:</p>
                                        <ul class="team-social">
                                            <li class="bgblue-dark"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li class="bgred"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                            <li class="bgblue-light"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li class="bgblue-dark"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>
    </div>
    <!--TEAM END-->

    <!--CTA2 START-->
    <div class="cta2">
        <div class="container">
            <div class="row white text-center">
                <h3 class="wd75 fnt-24">多Quieres Vender Tus Obras?</h3>
                <p class="cta-sub-title"></p>
                <a href="<?php echo e(url('/seller_login')); ?>" class="btn btn-default">Registrate Como Proveedor</a>
            </div>
        </div>
    </div>
    <!--CTA2 END-->

    <!--CONTACT START-->
    <div id="contact" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="page-title text-center">
                    <h1>Comentarios, Consultas & Sugerencias</h1>
                    <hr class="pg-titl-bdr-btm"></hr>
                </div>
                <div id="sendmessage">Your message has been sent. Thank you!</div>
                <div id="errormessage"></div>

                <div class="form-sec">
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="col-md-4 form-group">
                            <input type="text" name="name" class="form-control text-field-box" id="name"
                                   placeholder="Nombre" data-rule="minlen:4" data-msg="Please enter at least 4 chars"/>
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="email" class="form-control text-field-box" name="email" id="email"
                                   placeholder="Correo" data-rule="email" data-msg="Please enter a valid email"/>
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-4 form-group">
                            <input type="text" class="form-control text-field-box" name="subject" id="subject"
                                   placeholder="Asunto" data-rule="minlen:4"
                                   data-msg="Please enter at least 8 chars of subject"/>
                            <div class="validation"></div>
                        </div>
                        <div class="col-md-12 form-group">
                            <textarea class="form-control text-field-box" name="message" rows="5" data-rule="required"
                                      data-msg="Please write something for us" placeholder="Mensaje"></textarea>
                            <div class="validation"></div>

                            <button class="button-medium" id="contact-submit" type="submit" name="contact">Enviar
                                Ahora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--CONTACT END-->

    <!--FOOTER START-->
    <footer class="footer section-padding">
        <div class="container">
            <div class="row">
                <div style="visibility: visible; animation-name: zoomIn;" class="col-sm-12 text-center wow zoomIn">
                    <h3>Siguenos En</h3>
                    <div class="footer_social">
                        <ul>
                            <li><a class="f_facebook" href="https://www.facebook.com/LEIPELoficial"><i
                                            class="fa fa-facebook"></i></a></li>
                            <li><a class="f_twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a class="f_google" href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a class="f_linkedin" href="https://www.linkedin.com/company/informeret-s.a.-leipel"><i
                                            class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!--- END COL -->
            </div>
            <!--- END ROW -->
        </div>
        <!--- END CONTAINER -->
    </footer>
    <!--FOOTER END-->
    <div class="footer-bottom">
        <div class="container">
            <div style="visibility: visible; animation-name: zoomIn;" class="col-md-12 text-center wow zoomIn">
                <div class="footer_copyright">
                    <p> Leipel &copy 2018. Todos los Derechos Reservados.</p>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Scripts -->

<script src="<?php echo e(asset('plugins/jquery/js/jquery-3.2.1.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/bootstrapV3.3/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/js/custom.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/js/jquery.easing.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('plugins/js/slick.min.js')); ?>"></script>
</body>
</html>