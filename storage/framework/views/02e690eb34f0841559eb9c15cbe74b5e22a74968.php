<?php $__env->startSection('main'); ?>     
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<div class="col-lg-9 col-md-9" >
    <div class="row mtbox">  

        <!-- <div class="col-md-6 col-sm-6 mb">
          <div class="white-panel refe">
            <div class="white-header">
                <h5><i class="fa fa-user"></i>Mi Codigo de Referido:</h5>
            </div>
            <div class="row white-size">
                <div class="col-sm-6 col-xs-6 gocenter ">
                  <p>
                    <h2><?php echo e(Auth::user()->codigo_ref); ?></h2>
                  </p>
                </div>
            </div>
          </div>
        </div> -->

        <div class="col-md-12 col-sm-12">
          <dir class="col-md-6 col-sm-6" >
            <div class="panel2">
              <center><h5><i class="fa fa-user"></i> Mi Codigo de Referido:</h5></center>
            </div>
          </dir>
          <div class="col-md-6 col-sm-6">
            <p>
              <h2><?php echo e(Auth::user()->codigo_ref); ?></h2>
            </p>
          </div>
        </div>

        <div class="col-md-12 col-sm-12" style="margin-top: 5%">
          <dir class="col-md-6 col-sm-6" >
            <div class="panel2">
              <center><h5><i class="fa fa-user"></i> Mi Enlace:</h5></center>
            </div>
          </dir>
          <div class="col-md-6 col-sm-6" style="margin-top: 2%">
            <p>
              <h5><a href="<?php echo e(url('/').'/register/'.Auth::user()->codigo_ref); ?>" style="font-size: 86%;"><?php echo e(url('/').'/register/'.Auth::user()->codigo_ref); ?></a></h5>
            </p>
          </div>
        </div>

        <div class="col-md-12 col-sm-12" style="margin-top: 5%">
          <dir class="col-md-6 col-sm-6" >
            <div class="panel2">
              <center><h5><i class="fa fa-envelope-o"></i> Invitar por correo</h5></center>
            </div>
          </dir>
          <div class="col-md-6 col-sm-6" style="  ">
            <p>
              <h3>
                  <a href="#myModal" data-toggle="modal" class="btn btn-info">
                    Enviar     
                  </a>
              </h3>
            </p>
          </div>
        </div>

        <div class="col-md-12 col-sm-12" style="margin-top: 5%">
          <dir class="col-md-6 col-sm-6" style="">
            <div class="panel2">
              <center><h5><i class="fa fa-user"></i> Total de referidos:</h5></center>
            </div>
          </dir>
          <div class="col-md-6 col-sm-6" style="margin-top: -3%">
            <p>
              <h2><a href="#">
                      <center><?php echo e($referals1+$referals2+$referals3); ?></center>
                  </a>
              </h2>
              <h6>Este es el total de referidos de tres generaciones de personas que llegaron a Leipel gracias a ti. Te lo agredecemos!</h6>
            </p>
          </div>
        </div>

        <!-- <div class="col-md-6 col-sm-6 mb">
          <div class="white-panel refe">
            <div class="white-header">
                <h5><i class="fa fa-envelope-o"></i>Invitar por correo</h5>
            </div>
            <div class="row white-size">
                <div class="col-sm-6 col-xs-6 gocenter ">
                  <p>
                    <h3>
                      <a href="#myModal" data-toggle="modal" class="btn btn-info">
                        Enviar     
                      </a>
                    </h3>
                  </p>
                </div>
            </div>
          </div>
        </div> -->

        <!-- <div class="col-md-12 col-sm-12 mb">
          <div class="white-panel refe">
            <div class="white-header">
                <h5><i class="fa fa-user"></i>Mi Enlace:</h5>
            </div>
            <div class="row white-size">
                <div class="col-sm-12 col-xs-12 gocenterRef ">
                  <p>
                    <h5><a href="<?php echo e(url('/').'/register/'.Auth::user()->codigo_ref); ?>" style="font-size: 86%"><?php echo e(url('/').'/register/'.Auth::user()->codigo_ref); ?></a></h5>
                  </p>
                </div>
            </div>
          </div>
        </div> -->

        <div class="col-md-12 col-sm-12" style="margin-top: 5%">
          <dir class="col-md-6 col-sm-6" style="margin-top: 15%">
            <div class="panel2">
              <center> <h5><i class="fa fa-user"></i>Mi Codigo Qr:</h5></center>
            </div>
          </dir>
          <div class="col-md-6 col-sm-6 col-xs-12" style="  ">
            <p>
              <div class="center">
                <?php echo QrCode::size(300)->generate( url('/').'/register/'.Auth::user()->codigo_ref);; ?>

                <center><a href="data:image/png;base64,<?php echo base64_encode (QrCode::format('png')->size(300)->generate( url('/').'/register/'.Auth::user()->codigo_ref)); ?>" download="MiQr">Descargar</a></center>
            </div>
            </p>
          </div>
        </div>

 <!--        <div class="col-md-4 col-sm-4 mb">
            <div class="white-panel  pn2">
          <div class="white-header">
              <h5><i class="fa fa-user"></i>Mi Codigo Qr:</h5>
          </div>
          <div class="Qr-panel">
            <div class="center">
              <?php echo QrCode::size(300)->generate( url('/').'/register/'.Auth::user()->codigo_ref);; ?>

              <a href="data:image/png;base64,<?php echo base64_encode (QrCode::format('png')->size(300)->generate( url('/').'/register/'.Auth::user()->codigo_ref)); ?>" download="MiQr">Descargar</a>
            </div>
          </div>
          </div>
        </div> -->
  </div>
</div>
<?php if($refered != null): ?>
<div class="col-lg-3 col-md-3 ds" >
  <div class="panel panel-default">
    <!-- USERS ONLINE SECTION -->
    <h3>Mis referidos directos:</h3>
    <!-- First Member -->
    <?php $__currentLoopData = $refered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refereds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="desc">
      <div class="thumb">
        <?php if($refereds->img_perf): ?>
          <img class="img-circle" src="<?php echo e(asset('assets/img/ui-divya.jpg')); ?>" width="35px" height="35px" align="">
        <?php else: ?>
          <img src="<?php echo e(asset('sistem_images/DefaultUser.png')); ?>" class="img-circle" width="35px" height="35px" align="">
        <?php endif; ?>
      </div>
    <div class="details" style="margin-top: 3%">
      <p><a href="#"><?php echo e($refereds->name); ?></a><br/></p>
    </div>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 <?php echo e($refered->links()); ?>

</div>
</div>
<?php endif; ?>
<!--MODAL PARA ENVIAR REFERIDOS-->
<div id="myModal" class="modal fade" role="dialog">                                     
     <div class="modal-dialog">
    <!-- Modal content-->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Introduzca el Correo que desea invitar</h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" method="POST" action="<?php echo e(url('Invite')); ?>"><?php echo e(csrf_field()); ?>


                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Email</label>
                        <div class="col-lg-10">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                    </div>
                                              
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-5">
                          <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </div>
                    </form>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                    </div>
            </div>
          </div>
    </div>
</div>
              
                  
                  
                  
           

          <?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>