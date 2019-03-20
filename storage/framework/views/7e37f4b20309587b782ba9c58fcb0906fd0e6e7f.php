<?php $__env->startSection('css'); ?>
    <style type="text/css">


        .card .card-content {
         padding: 24px 8px 12px 8px;
        }
       .card .card-content .card-title {
           color: #000000;
           display: block;
           line-height: 14px;
           max-height: 14px;
           min-height: 12px;
           overflow: hidden;
           text-decoration: none;
           position: relative;
           white-space: nowrap;
           text-overflow: ellipsis;
           text-align: left;
       }
       .card .card-title {
        line-height: 1.2;
           font-size: 16px;
       }

      #autor{
           color: #1e88e5 ;
           display: block;
           overflow: hidden;
           text-decoration: none;
           position: relative;
           white-space: nowrap;
           text-overflow: ellipsis;
           text-align: left;
           font-size: 14px
       }

    </style>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>  

<div class="row">
    <span class="grey-text"><h4><b><i class="material-icons small">movie</i> Mis Series</b></h4></span>
    <!-- <h5>Mis Peliculas</h5> -->
    <br>

        <div class="row">
                <?php if($Series != 0): ?>
                    <?php $__currentLoopData = $Series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Series): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- PROFILE 01 PANEL -->
                        <div class="col s6 m3 ">
                            <div class="card">

                                        <?php if($Series->img_poster): ?>
                                         <a href="<?php echo e(url('ShowMySerie/'.$Series->id.'/'.'Serie')); ?>">
                                            <div class="card-image">
                                            <img src="<?php echo e(asset($Series->img_poster)); ?>" width="100%" height="300"style="">
                                                <a href="<?php echo e(url('ShowMySerie/'.$Series->id.'/'.'Serie')); ?>" class="btn-floating halfway-fab waves-effect waves-light blue btn tooltipped " data-position="bottom" data-tooltip="Detalles"><i class="material-icons">movie</i></a>

                                            </div>
                                        <?php else: ?>
                                           <a href="<?php echo e(url('ShowMySerie/'.$Series->id.'/'.'Cap')); ?>">
                                            <div class="card-image grey lighten-2">
                                                <img  src="<?php echo e(asset($Series->Serie->img_poster)); ?>" width="100%" height="300" style="">
                                                <a href="<?php echo e(url('ShowMySerie/'.$Series->id.'/'.'Cap')); ?>" class="btn-floating halfway-fab waves-effect waves-light blue lighten-2 btn tooltipped" data-position="top" data-tooltip="Detalles"><i class="material-icons">movie</i></a>
                                            </div>

                                        <?php endif; ?>
                                    </a>

                                <div class="card-content">
                                  <?php if($Series->title): ?>
                                    <span class="card-title title"><b><?php echo e($Series->title); ?></b></span>
                                  <?php else: ?>
                                    <span class="card-title title"><b><?php echo e($Series->Serie->title); ?></b></span>
                                  <?php endif; ?>
                                    <!--
                                    <span> <a id='autor' href="ProfileBookAuthor/"></a></span>-->
                                    <!--   -->
                                </div>
                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                 <div class="col s6 offset-s3">
                     <br><br>
                    <blockquote >
                    <i class="material-icons fixed-width large grey-text">movie</i><br><h5 blue-text text-darken-2>No Posee series adquiridas</h5>
                    </blockquote>
                </div>
                </div><!--End div row -->
                <?php endif; ?>
</div>



<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>