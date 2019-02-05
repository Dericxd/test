<?php $__env->startSection('css'); ?>
    <style type="text/css">

        .embed-container {
            position: relative;
            padding-bottom: 70.25%;
            height: 0;
            overflow: hidden;
        }
        .embed-container iframe {
            position: absolute;
            top:0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        Con esto tendríamos
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>




    <div class="row">

        <div class="row">


            <div class="card col s12 m12" style="padding: 2px 10px 10px 10px;">

                <?php $__currentLoopData = $Tv; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col s8 m8 offset-s2 offset-m2">
                        <h4 class="titelgeneral"><i class="material-icons small">tv</i> <?php echo e($tv->name_r); ?></h4>

                        <div class="embed-container">
                            <iframe align="middle" src="<?php echo e(asset($tv->streaming)); ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency
                                    allow="autoplay" width="300" height="200" scrolling="no" border="0" style="border:0px;">
                            </iframe>
                        </div>

                        <div class="fixed-action-btn click-to-toggle direction-top">
                            <a class="btn-floating btn-large waves-effect waves-light green">
                                <i class="mdi mdi-forum-outline"></i>
                            </a>
                            <ul>
                                <?php if($tv->facebook!=null): ?>
                                <li><a href="<?php echo e($tv->facebook); ?>" target="_blank" class="btn-floating blue darken-4"><i class="mdi mdi-facebook"></i></a></li>
                                <?php endif; ?>
                                <?php if($tv->google!=null): ?>
                                <li><a href="<?php echo e($tv->google); ?>" target="_blank" class="btn-floating red accent-4"><i class="mdi mdi-youtube"></i></a></li>
                                <?php endif; ?>
                                <?php if($tv->twitter!=null): ?>
                                <li><a href="<?php echo e($tv->twitter); ?>" target="_blank" class="btn-floating blue lighten-2"><i class="mdi mdi-twitter"></i></a></li>
                                <?php endif; ?>
                                <?php if($tv->instagram!=null): ?>
                                <li><a href="<?php echo e($tv->instagram); ?>" target="_blank" class="btn-floating purple-gradient"><i class="mdi mdi-instagram"></i></a></li>
                                <?php endif; ?>
                                <?php if($tv->web!=null): ?>
                                <li><a href="<?php echo e($tv->web); ?>" target="_blank" class="btn-floating grey"><i class="mdi mdi-earth"></i></a></li>
                                <?php endif; ?>
                            </ul>

                        </div>


                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="row">
                    <div class="input-field col s12 m6 offset-m3">
                        <form method="POST"  id="SaveSong" action="<?php echo e(url('SearchPlayTv')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <i class="material-icons prefix blue-text">search</i>
                            <input type="text" id="seach" name="seach" class="validate">
                            <input type="hidden" name="type" id="type">

                            <br>
                            <button class="btn curvaBoton green" type="submit" name="buscar" id="buscar">Buscar...</button>
                        </form>
                    </div>
                </div>






                <?php $__currentLoopData = $Tvs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="col s6 m3">
                        <div class="card">
                            <div class="card-image">
                                <a href="<?php echo e(url('PlayTv/'.$tv->id)); ?>"><img src="<?php echo e(asset($tv->logo)); ?>" width="100%" height="170px"></a>
                                <a  href="<?php echo e(url('PlayTv/'.$tv->id)); ?>" class="btn-floating halfway-fab waves-effect waves-light blue"><i class="material-icons">live_tv</i></a>
                            </div>
                            <div class="card-content">
                                <h6 class="truncate grey-text"><?php echo e($tv->name_r); ?></h6>
                            </div>
                        </div>
                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>


        </div>



    </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

    <script type="text/javascript">

        const players = Array.from(document.querySelectorAll('#player')).map(p => new Plyr(p));
    </script>

    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

    <script type="text/javascript">

        $(document).ready(function(){
            $('#seach').keyup(function(evento){
                $('#buscar').attr('disabled',true);
            });
            $('#buscar').attr('disabled',true);
            $('#seach').autocomplete({
                source: "<?php echo e(url('SearchTv')); ?>",
                messages: {
                    noResults: '',
                    results: function() {}
                },
                minLength: 2,
                select: function(event, ui){
                    $('#seach').val(ui.item.value);
                    var valor = ui.item.value;
                    console.log(valor);
                    if (valor=='No se encuentra...'){
                        $('#buscar').attr('disabled',true);
                        swal('Tv no se encuentra regitrada','','error');
                    }else{
                        $('#buscar').attr('disabled',false);
                    }
                }

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(evento){
            var wSize = $(window).width();
            if (wSize <= 768) {
                $('#player').addClass('player');
                $('#rrss').css('margin-left','10%%')
            }
        })
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems, {
                direction: 'top'
            });
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>