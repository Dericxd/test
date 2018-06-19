<?php $__env->startSection('content'); ?>
<main  class="mdl-layout__content">
<div class="mdl-layout mdl-grid">
    
  <div class="mdl-tabs mdl-js-tabs mdl-cell mdl-cell--3-col">
  
  <div class="mdl-tabs__tab-bar">
    <a href="#applys" class="mdl-tabs__tab">Solicitudes</a>
    <a href="#Promoters" class="mdl-tabs__tab">Promotores</a>  
  </div>
  
    <div id="applys" class="mdl-tabs__panel is-active mdl-cell mdl-cell--1-col">
       <div class="mdl-grid">
        
            <div class="mdl-cell mdl-cell--6-col">

                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--4dp">             
                        <thead>
                                <tr>
                                  <th class="mdl-data-table__cell--non-numeric">Nombre Comercial</th>
                                  <th class="mdl-data-table__cell--non-numeric">Nombre Del Contacto</th>
                                  <th class="mdl-data-table__cell--non-numeric">Telefono Del Contacto</th>
                                  <th class="mdl-data-table__cell--non-numeric">Correo Del Contacto</th>
                                  <th class="mdl-data-table__cell--non-numeric">Tipo Contenido</th>
                                  <th class="mdl-data-table__cell--non-numeric">Vendedor</th>
                                  <th class="mdl-data-table__cell--non-numeric">Solicitud</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php $__currentLoopData = $applys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $apply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="apply<?php echo e($apply->id); ?>">
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($apply->name_c); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($apply->contact_s); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($apply->phone_s); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($apply->email); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($apply->desired_m); ?></td>

                                      <td class="mdl-data-table__cell--non-numeric" id="apply_td<?php echo e($apply->id); ?>">
                                        <?php if($apply->promoter_id != NULL): ?>
                                       <span class="mdl-chip mdl-chip--deletable" id="a_<?php echo e($apply->promoter_id); ?>_<?php echo e($apply->id); ?>">  <span class="mdl-chip__text" id="promoter_assing"><?php echo e($apply->Promoter->name_c); ?></span> <button type="button" class="mdl-chip__action" value1="<?php echo e($apply->id); ?>" value2="<?php echo e($apply->promoter_id); ?>" name="apply" id="x"> <i class="material-icons">cancel</i> </button></span>
                                        <?php else: ?>

                                        <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="add_promoter_to" value="<?php echo e($apply->id); ?>" data-toggle="modal" data-target="#AssingPromoter">
                                       <i class="material-icons">add</i>
                                        </button>

                                         <div class="mdl-tooltip" data-mdl-for="add_promoter_to">
                                             Asignar Promotor para la <strong>Gestion</strong>
                                          </div>
                                        <?php endif; ?>
                                      </td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric">
                                          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ModifyApplys" value="<?php echo e($apply->id); ?>" data-toggle="modal" data-target="#myModal">
                                          <?php echo e($apply->status); ?>

                                        </button>
                                        
                                      </td>
                                      
                                      </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                       </table>
                       <?php echo $applys->render(); ?>          
            </div>
       </div>
    </div>

    <div id="Promoters" class="mdl-tabs__panel mdl-cell mdl-cell--1-col" >
      
      <table class="mdl-data-table mdl-js-data-table" id="promoters_table">            
                        <thead>
                                <tr>
                                  <th></th>
                                  <th>ID del Promotor</th>
                                  <th>Nombre</th>
                                  <th>Telefono</th>
                                  <th>Correo</th>
                                  <th>Solicitudes Asignadas</th>
                                </tr>
                            </thead>
                                <tbody>
                                    <?php $__currentLoopData = $promoters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promoter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="promoter<?php echo e($promoter->id); ?>">
                                      
                                      <td class="mdl-data-table__cell--non-numeric"> <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab" id="delete_promoter" value="<?php echo e($promoter->id); ?>">
                                            <i class="material-icons">cancel</i>
                                           </button>
                                           <div class="mdl-tooltip" data-mdl-for="delete_promoter">
                                          Eliminar <strong>Promotor</strong>
                                          </div>
                                      </td>

                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($promoter->id); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($promoter->name_c); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($promoter->phone_s); ?></td>
                                      
                                      <td class="mdl-data-table__cell--non-numeric"><?php echo e($promoter->email); ?></td>
                                      
                                      <td id="promoter_ap<?php echo e($promoter->id); ?>">

                                  <?php $__currentLoopData = $promoter->Applys()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $solicitud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <span class="mdl-chip mdl-chip--deletable" id="p_<?php echo e($promoter->id); ?>_<?php echo e($solicitud->id); ?>">
                                  <span class="mdl-chip__text" id="applys"><?php echo e($solicitud->name_c); ?></span>
                                  <button type="button" class="mdl-chip__action" 
                                  value1="<?php echo e($promoter->id); ?>" value2="<?php echo e($solicitud->id); ?>" name="apply" id="delete_applys"><i class="material-icons">cancel</i>
                                  </button>
                                  </span>

                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      </td>
                                                                            
                                      </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                               </tbody>
                       </table>
                       <?php echo $promoters->render(); ?>

    

    <div class="mdl-cell mdl-cell--1-col">
        <button  id="tt3" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" data-toggle="modal" data-target="#NewPromoter">
        <i class="material-icons">add</i>
        </button>
        
        <div class="mdl-tooltip" data-mdl-for="tt3">
          Crear <strong>Promotor</strong>
        </div>


    </div>
    </div>
  
  </div>

</div>


</main>

 <div class="modal fade" id="AssingPromoter" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Asignar Promotor</h4>
        </div>
        <div class="modal-body">
         <p>Asigne Un Promotor A la Solicitud</p>
        

             <form method="POST" id="AssingPromoterForm">
                              <?php echo e(csrf_field()); ?>


               <div class="form-group">

                <label for="sel1">Promotor:</label>
               <select class="form-control" id="sel1" name="promoter_n">
                  <?php $__currentLoopData = $promoters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promoter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <option value="<?php echo e($promoter->id); ?>"><?php echo e($promoter->name_c); ?></option>  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                 
               </select>
               </div>

              <div class="form-group">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">                    Enviar
                </button>
            </div>

        </form>

        
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>



  <div class="modal fade" id="NewPromoter" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crear Promotor</h4>
        </div>
        <div class="modal-body">
         <p>Crear Promotor</p>
        

             <form method="POST" id="PromotersForm">
                              <?php echo e(csrf_field()); ?>


              <div class="form-group">
                  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input class="mdl-textfield__input" type="text" name="name_c" id="name_c">
                   <label class="mdl-textfield__label" for="name_c">Nombre Completo</label>
                  </div>
              </div>

              <div class="form-group">
                   <label  for="phone_s">Telefono de Contacto</label>
                    <input class="form-control" type="tel" name="phone_s" id="phone_s">
              </div> 

              <div class="form-group">
                   <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                   <input class="mdl-textfield__input" type="email" name="email_c" id="email_c">
                   <label class="mdl-textfield__label" for="email_c">Correo Electronico</label>
                  </div>
              </div> 

               
              <div class="form-group">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">                    Enviar
                </button>
            </div>

        </form>

        
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Estatus</h4>
        </div>
        <div class="modal-body">
         <p>Modifique El Estatus De La Solicitud</p>
        

             <form method="POST"  id="formStatus">
                              <?php echo e(csrf_field()); ?>


             <div class="radio-inline">
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                <input type="radio" id="option-1" class="mdl-radio__button"  onclick="javascript:yesnoCheck();" name="status" value="Aprobado">
                <span class="mdl-radio__label">Aprobar</span>
                </label>
             </div>

             <div class="radio-inline">
             <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                <input type="radio" id="option-2" class="mdl-radio__button" onclick="javascript:yesnoCheck();" name="status" value="Denegado">
                <span class="mdl-radio__label">Negar</span>
             </label>

             </div>

             <div class="radio-inline" style="display:none" id="if_no">
              <div class="mdl-textfield mdl-js-textfield">
               <textarea name="message" class="mdl-textfield__input" type="text" rows= "6" id="razon" ></textarea>
               <label class="mdl-textfield__label" for="razon">Explique La Razon</label>
              </div>
             </div>

             <div class="radio-inline">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit">                    Enviar
                </button>
            </div>

        </form>

        
        
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  




<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>

$("#phone_s").intlTelInput();

function yesnoCheck() {
    if (document.getElementById('option-2').checked) 
    {
        $('#if_no').show();
    } 
    else 
    {
        $('#if_no').hide();
        $('#razon').val('');
    }
  };



$(document).on('click', '#x', function() {
  
  var apply = $(this).attr('value1'); ;
  var promoter = $(this).attr('value2');;
  var url = 'delete_promoter_from/'+apply+'/'+promoter;

       $.ajax({
         url: url,
         type:'get',
         data:"json",

         success: function(data)
         {
          
           swal("Se Ha Retirado el Promotor de la Solicitud con exito","","success");
           var button = '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" id="add_promoter_to" value="'+apply+'" data-toggle="modal" data-target="#AssingPromoter"><i class="material-icons">add</i> </button><div class="mdl-tooltip" data-mdl-for="add_promoter_to">Asignar Promotor para la <strong>Gestion</strong></div>';
              $("#apply_td"+apply).prepend(button).hide().fadeIn();
              $("#a_"+promoter+"_"+apply).fadeOut();
              $("#a_"+promoter+"_"+apply).remove();
          
                                       

                                         
                                             
                                          
         },

         error: function(data)
         {
           alert("NO Permitido Por Favor Recargue la Pagina");
         },

       });
});


$(document).on('click', '#tt3', function() {    

    $(document).ready(function (e){

        $( "#PromotersForm" ).on( 'submit', function(e){
          
          var name_c = $('input[name=name_c]').val();
          var phone_s =  $("#phone_s").intlTelInput("getNumber");
          var email_c = $('input[name=email_c]').val();

          e.preventDefault();
            
            $.ajax({

              url: 'promoter_c',
              type:'POST',
              data:{
                    _token: $('input[name=_token]').val(),
                    name_c: name_c,
                    phone_s: phone_s,
                    email_c: email_c,
                    }, 

                    success: function (result) 
                    {
                      swal('Promotor Registrado con exito','','success');
                    
                      var table = document.getElementById("promoters_table");
                      var row = table.insertRow();
                      var buttonDelete = row.insertCell();
                      var id = row.insertCell();
                      var name = row.insertCell();
                      var phone = row.insertCell();
                      var email = row.insertCell();
                      
                      row.id='promoter'+result['id'];

                      buttonDelete.innerHTML = '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab" id="delete_promoter" value="'+result['id']+'"> <i class="material-icons">cancel</i> </button>'
                                            
                                           
                      id.innerHTML = result['id'];
                      name.innerHTML = result['name_c'];
                      phone.innerHTML = result['phone_s'];
                      email.innerHTML = result['email_c'];
                    
                    },

                    error: function (result) 
                    {
                      swal('Error en Su solicitud Por Favor Recargue la Pagina','','error');
                      console.log(result);
                    }

            });
          
        });
    });
});

$(document).on('click', '#delete_promoter', function() {
  
  var promoter = $(this).val();
  var url = 'promoter_delete/'+promoter;
 

    $.ajax({
             url: url,
             type:'get',
             data:"json",

            success: function(data)
            {
              swal("Se Ha Eliminado el Promotor con exito","","success");
              console.log(data);
              $("#promoter"+promoter).fadeOut();
            },

            error: function(data)
            {
             swal("NO Permitido Por Favor Recargue la Pagina","","error");
            },

       });
});

$(document).on('click', '#add_promoter_to', function() {

    var apply = $(this).val();
    console.log(apply); 
     $(document).ready(function (e){

       $( "#AssingPromoterForm" ).on( 'submit', function(e){

        var promoter = $("#sel1").val();
        var name = $( "#sel1 option:selected" ).text();
        var url = 'add_promoter_to/'+apply;
        
        e.preventDefault();
         $.ajax({
                    url: url,
                    type:'POST',
                    data:{
                            _token: $('input[name=_token]').val(),
                            promoter_id: promoter,
                    },                  

                      success: function(result){

                          swal('Promotor asignado con exito','','success');

                         var add = '<span class="mdl-chip mdl-chip--deletable" id="a_'+promoter+'_'+apply+'">  <span class="mdl-chip__text" id="promoter_assing">'+name+'</span> <button type="button" class="mdl-chip__action" value1="'+apply+'" value2="'+promoter+'" name="apply" id="x"> <i class="material-icons">cancel</i> </button></span>';
                         
                         var row =  $("#apply_td"+apply);

                         $("#add_promoter_to").fadeOut();
                         row.prepend(add);


                      },

                      error: function(result){
                        swal("NO Permitido Por Favor Recargue la Pagina","","error");
                      },
                });


       });

     });
});

$(document).on('click', '#ModifyApplys', function() {    
        var x = $(this).val();

            $(document).ready(function (e){
            $( "#formStatus" ).on( 'submit', function(e)
                {
                    var s=$("input[type='radio'][name=status]:checked").val();
                    var message=$('#razon').val();
                    var url = 'AdminAproveOrDenialApplys/'+x;
                    
                    e.preventDefault();
                    $.ajax({
                            url: url,
                            type: 'post',
                            data: {
                                    _token: $('input[name=_token]').val(),
                                    status: s,
                                    message: message,
                                  }, 
                            success: function (result) {

                                                        $('#myModal').toggle();
                                                        $('.modal-backdrop').remove();
                                                        swal("Se ha "+s+" con exito","","success");
                                                        $('#album'+x).fadeOut();
                                                        },

                            error: function (result) {
                            swal('Existe un Error en su Solicitud','','error');
                            console.log(result);
                            }
                            });  
                                            });
                });

});

$(document).on('click', '#delete_applys', function() {
  var promoter = $(this).attr('value1'); 
  var apply = $(this).attr('value2');

 $.ajax({

              url: 'delete_applys_from/'+promoter+'/'+apply,
              type:'GET',
              data: 'json',

              success : function(data)
              {
                swal("Se Ha Retirado Con Exito La Solicitud","","success");
                $("#p_"+promoter+"_"+apply).fadeOut();
              },

              error: function(data) 
              {
                swal('Error en Solicitud Por Favor Recargue la Pagina','','error');
              }



          });

});


</script>

<?php $__env->stopSection(); ?>
                            
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>