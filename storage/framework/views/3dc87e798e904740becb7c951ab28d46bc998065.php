<?php $__env->startSection('css'); ?>
    <style>
        ul.collection {
            max-height: 450px;
            overflow: scroll;
            list-style-type: none; /* not sure if you need this. Hides bullet list dots */
        }

        li.collection-item:first-child {
            background-color: white; /* should be the same as the background color behind the list */
            position: fixed;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main'); ?>
  <!-- **********************************************************************************************************************************************************
  MAIN CONTENT
  *********************************************************************************************************************************************************** -->
  <!--main content start-->
  <h4 class="titelgeneral"><i class="material-icons small">group</i> Mis referidos:</h4>

  <!--REFERIR-->
  <input type="hidden" name="id" id="id" value="<?php echo e(Auth::user()->created_at); ?>">
  <?php if(Auth::user()->UserRefered()->count()  == 0): ?>
      <div   class="col s12  m3 offset-m1 ">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
              </div>
              <a class="btn-floating halfway-fab activator btn-small waves-effect waves-light  blue"><i class="material-icons">arrow_upward</i></a>
              <div class="card-content">
                  <i class="material-icons medium blue-text">assignment_ind</i>
                  <h6 class=" blue-text">Total de referidos:</h6>
                  <h4 class=" blue-text"><b><?php echo e($referals1+$referals2+$referals3); ?></b></h4>
              </div>
              <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4"><i class="material-icons blue-text right">arrow_downward</i></span>
                  <br>
                  <p class="valign-wrapper grey-text">Este es el total de referidos de tres generaciones de personas que llegaron a Leipel gracias a ti. Te lo agredecemos!</p>
              </div>
          </div>
      </div>



      <div class="col m4 s12">
          <div class="card-panel  center">
              <i class="material-icons blue-text medium">person_add</i>
              <h6 class="blue-text">Agregar código de patrocinador</h6>
              <br>
              <a   href="#myModalRefe" class="modal-trigger waves-effect waves-light btn curvaBoton">Agregar<i class="material-icons left">add</i></a>
      </div>

      </div>
      <div class="col s12 m3">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
              </div>
              <a class="btn-floating halfway-fab activator btn-small waves-effect waves-light  blue"><i class="material-icons">arrow_upward</i></a>
              <div class="card-content">
                  <i class="material-icons medium blue-text">group_work</i>
                  <h6 class=" blue-text">Total de puntos:</h6>
                  <h4 class=" blue-text"><b>
                          <?php if(Auth::user()->points!=NULL): ?>
                              <?php echo e(Auth::user()->points); ?>

                          <?php else: ?>
                              0
                          <?php endif; ?>
                      </b></h4>
              </div>
              <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4"><i class="material-icons blue-text right">arrow_downward</i></span>
                  <br>
                  <p class="valign-wrapper grey-text">Estos son los puntos que se han generado de tus referidos directos e indirectos</p>
              </div>
          </div>
      </div>
  <?php endif; ?>


  <?php if(Auth::user()->UserRefered()->count() <> 0): ?>
      <div class="col s12 m5 offset-m1">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
              </div>
              <a class="btn-floating halfway-fab activator btn-small waves-effect waves-light  blue"><i class="material-icons">arrow_upward</i></a>
              <div class="card-content">
              <i class="material-icons medium blue-text">assignment_ind</i>
              <h6 class=" blue-text">Total de referidos:</h6>
              <h4 class=" blue-text"><b><?php echo e($referals1+$referals2+$referals3); ?></b></h4>
              </div>
              <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4"><i class="material-icons blue-text right">arrow_downward</i></span>
                  <br>
                  <p class="valign-wrapper grey-text">Este es el total de referidos de tres generaciones de personas que llegaron a Leipel gracias a ti. Te lo agredecemos!</p>
              </div>
          </div>
      </div>

      <div class="col s12 m5">
          <div class="card">
              <div class="card-image waves-effect waves-block waves-light">
              </div>
              <a class="btn-floating halfway-fab activator btn-small waves-effect waves-light  blue"><i class="material-icons">arrow_upward</i></a>
              <div class="card-content">
                  <i class="material-icons medium blue-text">group_work</i>
                  <h6 class=" blue-text">Total de puntos:</h6>
                  <h4 class=" blue-text"><b>
                          <?php if(Auth::user()->points!=NULL): ?>
                             <?php echo e(Auth::user()->points); ?>

                          <?php else: ?>
                              0
                          <?php endif; ?>
                      </b></h4>
              </div>
              <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4"><i class="material-icons blue-text right">arrow_downward</i></span>
                  <br>
                  <p class="valign-wrapper grey-text">Estos son los puntos que se han generado de tus referidos directos e indirectos</p>
              </div>
          </div>
      </div>

  <?php endif; ?>



  <?php if($refered != null): ?>
  <div class=" s12 col m5 offset-m1  ">
      <h6 class="left-align grey-text">Lista de referidos:</h6>
              <ul class="collection">
                  <?php $__currentLoopData = $refered; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $refereds): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="collection-item avatar">
                      <?php if($refereds->img_perf): ?>
                          <img src="<?php echo e(asset($refereds->img_perf)); ?>" alt="avatar" class="z-depth-3 responsive-img circle" width="60" height="60">
                      <?php else: ?>
                          <img src="<?php echo e(asset('sistem_images/DefaultUser.png')); ?>" alt="avatar" class=" z-depth-3 responsive-img circle" width="60" height="60">
                      <?php endif; ?>
                      <span class="title blue-text"><b><?php echo e($refereds->name); ?> <?php echo e($refereds->last_name); ?></b></span><br>
                      <span><b>Email: </b> <?php echo e($refereds->email); ?></span><br>
                          <?php if($refereds->phone): ?>
                              <span><b>Teléfono:</b><?php echo e($refereds->phone); ?></span>
                          <?php else: ?>
                              <span><b>Teléfono:</b>No posee teléfono registrado</span>
                          <?php endif; ?>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
  </div>
  <?php else: ?>
      <div class="col s12 m10 offset-m1  ">
          <h6 class="left-align grey-text">Lista de referidos:</h6>
            <blockquote class="center grey lighten-4 grey-text ">
              <br> <i class="material-icons">sentiment_very_dissatisfied</i>
              <br>Aún no tienes Referidos <br>
            </blockquote>
      </div>
  <?php endif; ?>

 

  <!--MODAL ToTal-->
  <div id="myModalRefe" class="modal modal-s" >
      <div class="modal-content">
          <div class=" blue"><br>
              <h4 class="center white-text" >Ingrese el código</h4>
              <br>
          </div>
          <br>
          <div class="row">
              <form class="col m6 offset-m3"  method="POST" action="<?php echo e(url('Referals')); ?>" id="patrocinador" ><?php echo e(csrf_field()); ?>

                      <div class="input-field col m12 ">
                          <i class="material-icons prefix">vpn_key</i>
                          <input id="codigo" type="text" class="validate" name="codigo" value="<?php echo e(old('codigo')); ?>" required="required" type="text">
                          <label for="first_name">Código</label>
                          <div> <?php echo e($errors->has('codigo') ? ' has-error' : ''); ?> </div>
                          <div id="codigoMen"></div>
                      </div>
                      <button  id='ingresar' class="btn waves-effect waves-light curvaBoton" type="submit" name="action">Enviar
                          <i class="material-icons right">send</i>
                      </button>
              </form>
          </div>
      </div>
      <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Salir</a>
      </div>
  </div>
  <!--FIN DEL MODAL-->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


    <script type="text/javascript">
        document.querySelector('#patrocinador').addEventListener('submit', function(e) {
            var form = this;
            $('#codigoMen').hide();
            e.preventDefault(); // <--- prevent form from submitting
            var cod=$('#codigo').val();

            $.ajax({
                url:'sponsor/'+cod,
                type: 'get',
                dataType: "json",
                beforeSend: function() {
                    var gif = "<?php echo e(asset('/sistem_images/loading.gif')); ?>";
                    swal({
                        title: "¡Listo! Estamos validando su información...",
                        text: "Espere un momento por favor, mientras validamos el código de patrocinador.",
                        icon: gif,
                        buttons: false,
                        closeOnEsc: false,
                        closeOnClickOutside: false
                    });
                },
                success: function (result) {
                    console.log(result);
                    if(result == 2) {
                        swal({
                            title: "Ingrese otro código por favor",
                            text: "El código que introdujo le pertecene a algún miembro de su propia red, por favor ingrese otro.",
                            icon: 'info',
                            buttons: {
                                accept: 'Aceptar'
                            }
                        });
                    } else {
                        if(result == 1) {
                            swal({
                                title: "Ingrese otro código por favor",
                                text: "Disculpe, no puede ingresar su propio código",
                                icon: 'info',
                                buttons: {
                                    accept: 'Aceptar'
                                },
                                closeOnEsc: false,
                                closeOnClickOutside: false
                            });
                            $('#patrocinador')[0].reset();
                        } else if (result.id != undefined) {
                            if (result.last_name != undefined) {
                                var nombre = result.name+" "+result.last_name;
                            } else {
                                var nombre = result.name;
                            }
                            swal({
                                text: "¿Esta ingresando como patrocinador a "+nombre+"?",
                                icon: 'info',
                                buttons: {
                                    accept: 'Aceptar',
                                    cancel: 'Cancelar'
                                },
                                dangerMode: true,
                                closeOnEsc: false,
                                closeOnClickOutside: false
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    form.submit();
                                } else {
                                    $('#patrocinador')[0].reset();
                                }
                            });
                        }
                        else if(result == 0) {
                            swal.close();
                            $('#codigoMen').show();
                            $('#codigoMen').text('El código es incorrecto.');
                            $('#codigoMen').css('color','red');
                        }
                    }
                }
            });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var f1 = document.getElementById('id').value;
            var f = new Date();
            var f2=f.getDate() + "/" +(f.getMonth()+1 )+ "/" + f.getFullYear();

            var tiempo=restaFechas(f1,f2);
            if (tiempo > 7){
                document.getElementById('referir').style.display='none';
            }else{
                var total=6-tiempo;
                console.log(tiempo);
                document.getElementById('mensaje').innerHTML='Usted cuenta con '+total +' dias para agregar un patrocinador';
            }

        });
        restaFechas = function(f1,f2)
        {
            var aFecha1 = f1.split('-');
            var dFecha= aFecha1[2].split(' ');
            var aFecha2 = f2.split('/');
            var fFecha1 = Date.UTC(aFecha1[0],aFecha1[1]-1,dFecha[0]);
            var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
            var dif = fFecha2 - fFecha1;
            var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
            return dias;
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>