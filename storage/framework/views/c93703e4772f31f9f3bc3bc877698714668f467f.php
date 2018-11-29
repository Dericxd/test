<?php $__env->startSection('main'); ?>
 <div class="row mt">
    <h3>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home" id="users">Usuarios Pendientes</a></li>
        <li><a data-toggle="tab" href="#menu1" id="users_payments">Depositos de Usuarios</a></li>
        <li><a data-toggle="tab" href="#menu2" id="users_d">Usuarios Negados</a></li>
        <li><a data-toggle="tab" href="#menu3" id="users_a">Usuarios Aprobados</a></li>
      </ul>
  </h3>
</div>

<div class="row mt">
  <div class="tab-content">

    <div id="home" class="tab-pane fade in active">
      <div class="col-lg-12">
        <div class="content-panel">

          <table class="table table-bordered table-striped table-condensed" id="Clients">            
            <thead>
                <tr>
                  <th class="non-numeric">Nombre</th>
                  <th class="non-numeric">Numero Doc</th>
                  <th class="non-numeric">Imagen del Documento</th>
                  <th class="non-numeric">Fecha de Nacimiento</th>
                  <th class="non-numeric">Genero</th>
                  <th class="non-numeric">Fecha de Registro</th>
                  <th class="non-numeric">Redes</th>
                  <th class="non-numeric">Estatus</th>
              </tr>
              </thead>
          </table>

        </div>
      </div>

    </div>

   <div id="menu1" class="tab-pane fade">
      <div class="col-lg-12">
         <div class="content-panel">

            <table class="table table-bordered table-striped table-condensed" id="Payments">            
            <thead>
                <tr>
                  <th class="non-numeric">Usuario</th>
                  <th class="non-numeric">Cantidad</th>
                  <th class="non-numeric">Paquete</th>
                  <th class="non-numeric">Total de la Recarga</th>
                  <th class="non-numeric">Comprobante</th>
                  <th class="non-numeric">Fecha de la Solicitud</th>
                  <th class="non-numeric">Estado</th>

              </tr>
              </thead>
             </table>


        </div>
     </div>
   </div>

    <div id="menu2" class="tab-pane fade">
      <div class="col-lg-12">
        <div class="content-panel">

          <table class="table table-bordered table-striped table-condensed" id="ClientsDenials">
            <thead>
                <tr>
                  <th class="non-numeric">Nombre</th>
                  <th class="non-numeric">Numero Doc</th>
                  <th class="non-numeric">Imagen del Documento</th>
                  <th class="non-numeric">Fecha de Nacimiento</th>
                  <th class="non-numeric">Genero</th>
                  <th class="non-numeric">Fecha de registro</th>
                  <th class="non-numeric">Redes</th>
                  <th class="non-numeric">Estatus</th>
              </tr>
              </thead>
          </table>

        </div>
      </div>
    </div>
    
       <div id="menu3" class="tab-pane fade">
      <div class="col-lg-12">
        <div class="content-panel">

          <table class="table table-bordered table-striped table-condensed" id="ClientsAproved">            
            <thead>
                <tr>
                  <th class="non-numeric">Nombre</th>
                  <th class="non-numeric">Numero Doc</th>
                  <th class="non-numeric">Imagen del Documento</th>
                  <th class="non-numeric">Fecha de Nacimiento</th>
                  <th class="non-numeric">Genero</th>
                  <th class="non-numeric">Fecha de registro</th>
                  <th class="non-numeric">Redes</th>
                  <th class="non-numeric">Estatus</th>
              </tr>
              </thead>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

<?php echo $__env->make('promoter.modals.ClientViewModal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bluebird/1.2.2/bluebird.js"></script>
<script src="<?php echo e(asset('js/jquery.mlens-1.7.min.js')); ?>"></script>
<script id="jsbin-javascript">
  function getDatilAgain(idTicketSales,medio,idUser,callback) {
    var msn = "";
    getDatil(idTicketSales,medio,idUser).then(function(response) {
        var res = JSON.parse(response);
        msn = res;
    }, function(error) {
        msn = error;
    });
    setTimeout(function() {
        callback(msn);
    },6000); // 6000
  }
  function getDatil(idTicketSales,medio,idUser) {
    return new Promise(function(resolve,reject) {
      var parametros = "/"+idTicketSales+"/"+medio+"/"+idUser;
      var url = "<?php echo e(url('/facturaDeposito/')); ?>"+parametros;

      var req = new XMLHttpRequest();
      req.open("GET",url);
      req.onload = function() {
          if (req.status == 200) {
              resolve(req.response);
          }
          else {
              resolve(req.response);
          }
      };
      req.onerror = function() {
          reject(Error("Network Error"));
      };
      req.send();
    });
  }
  function setFactura(idTicketSales,idFactura,callback){
    var parametros = "/"+idTicketSales+"/"+idFactura;
    var ruta = "<?php echo e(url('/setFactura/')); ?>"+parametros;
    var factura = "";

    $.ajax({
        url     : ruta,
        type    : "GET",
        dataType: "json",
        success: function (data) {
            var factura = data;
            callback(factura);
        }
    });
    return factura;
  }
  $(document).ready(function(){

    var ClientsDataTable = $('#Clients').DataTable({
          processing: true,
          serverSide: true,
            responsive: true,

          ajax: '<?php echo url('ClientsDataTable'); ?>',
          columns: [
              {data: 'name', name: 'name'},
              {data: 'num_doc', name: 'num_doc'},
              {data: 'img_doc', name: 'img_doc',orderable: false, searchable: false},
              {data: 'fech_nac', name: 'fech_nac'},
              {data: 'type', name: 'type'},
              {data: 'created_at', name: 'created_at'},
              {data: 'webs', name: 'webs'},
              {data: 'Estatus', name: 'Estatus', orderable: false, searchable: false},
          ]
      });



    $(document).on('click', '#Status', function() {
      var x = $(this).val();
      $( "#formStatus" ).on( 'submit', function(e) {
        var s=$("input[type='radio'][name=status]:checked").val();
        var message=$('#razon').val();
        var url = 'ValidateUser/'+x;
        console.log(message);
        console.log(s);
        e.preventDefault();
        var gif = "<?php echo e(asset('/sistem_images/loading.gif')); ?>";
        swal({
            title: "Procesando la información",
            text: "Espere mientras se procesa la información.",
            icon: gif,
            buttons: false,
            closeOnEsc: false,
            closeOnClickOutside: false
        });
        $.ajax({
          url: url,
          type: 'post',
          //async: false,
          data: {
            _token: $('input[name=_token]').val(),
            status: s,
            message: message,
          }, 
          success: function (result) {
            $('#myModal').toggle();
            $('.modal-backdrop').remove();
            swal("Se ha "+s+" con éxito","","success")
            .then((recarga) => {
              location.reload();
            });
          },
          error: function (result) {
            swal('Existe un Error en su Solicitud','','error')
            .then((recarga) => {
              location.reload();
            });
            console.log(result);
          }
        }); 
      });
    });

    // Modal de la imagen del documento
    $(document).on('click', '#file_b', function() {
      var x = $(this).val();
      var file = $("#photo"+x).attr("src");
      console.log(file);
      $("#ci_photo").attr("src", file);
      $("#ci_photo").attr("data-big", file);
      $("#ci_photo").mlens({
        imgSrc: $("#ci_photo").attr("data-big"),    // path of the hi-res version of the image
        imgSrc2x: $("#ci_photo").attr("data-big2x"),  // path of the hi-res @2x  version of the image
                                                  //for retina displays (optional)
        lensShape: "square",                // shape of the lens (circle/square)
        lensSize: ["50%","50%"],            // lens dimensions (in px or in % with respect to image dimensions)
                                        // can be different for X and Y dimension
        borderSize: 5,                  // size of the lens border (in px)
        borderColor: "#666",            // color of the lens border (#hex)
        borderRadius: 10,                // border radius (optional, only if the shape is square)
        imgOverlay: $("#ci_photo").attr("data-overlay"), // path of the overlay image (optional)
        overlayAdapt: true,    // true if the overlay image has to adapt to the lens size (boolean)
        zoomLevel: 5,          // zoom level multiplicator (number)
        responsive: true       // true if mlens has to be responsive (boolean)
      });
    });
    // Modal de la imagen del documento

    $(document).on('click', '#webs', function() {
        
        var x = $(this).val();
       
        
        var WebsDataTable = $('#WebsTable').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,

          ajax:'ReferalsDataTable/'+x,
          columns: [
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'level', name: 'level'}
          ]
      });

    $('#webModal').on('hidden.bs.modal', function () {
          WebsDataTable.destroy();
         });

    });
    
    $(document).on('click', '#users_payments', function() {
        
        var PaymentsDataTable = $('#Payments').DataTable({
          processing: true,
          serverSide: true,
          responsive: true,

          ajax: '<?php echo url('DepsitDataTable'); ?>',
          columns: [
              {data: 'user_id', name: 'user_id'},
              {data: 'value', name: 'value'},
              {data: 'tickets.name', name: 'tickets.name'},
              {data: 'total', name: 'total'},
              {data: 'voucher', name: 'voucher', orderable: false, searchable: false},
              {data: 'created_at', name: 'created_at'},
              {data: 'Estatus', name: 'Estatus', orderable: false, searchable: false}
          ]
        });
        
      $(document).on('click', '#users', function() {
           
           PaymentsDataTable.destroy();
      });


      $(document).on('click', '#payval', function() { 
        var x = $(this).val();
        
        $( "#formPayment" ).on( 'submit', function(e){

          var gif = "<?php echo e(asset('/sistem_images/loading.gif')); ?>";
          swal({
              title: "Procesando la información",
              text: "Espere mientras se procesa la información.",
              icon: gif,
              buttons: false,
              closeOnEsc: false,
              closeOnClickOutside: false
          });

          var url = "<?php echo e(url('/DepositStatus/')); ?>"+"/"+x;
          
          var s=$("input[type='radio'][name=status_p]:checked").val();
          
          var message=$('#razon_p').val();
          console.log(message);
          console.log(x,url,s);
          e.preventDefault();
          $.ajax({
            url: url,
            type: 'post',
            //async: false,
            data: {
              _token: $('input[name=_token]').val(),
              status_p: s,
              message: message,
            }, 
            success: function (result) {
              $('#PayModal').toggle();
              $('.modal-backdrop').remove();
              var idTicketSales = x;
              var idUser = result.id;
              var medio = "deposito_cuenta_bancaria";
              console.log(result,idTicketSales,idUser,medio,s);
              if (s=="Aprobado") {
                swal({
                  title: "Generando factura",
                  text: "Espere mientras se genera la factura.",
                  icon: gif,
                  buttons: false,
                  closeOnEsc: false,
                  closeOnClickOutside: false
                });
                var intento = 0;
                var maxIntento = 10; // 1min de espera // 10
                getDatilAgain(idTicketSales,medio,idUser,function callback(infoFactura) {
                  console.log(infoFactura);
                  var idFactura = infoFactura.id;
                  console.log(idFactura);
                  if (intento <= maxIntento) {
                    if (idFactura!=undefined) {
                      setFactura(idTicketSales,idFactura,function(ticketSales) {
                        console.log(ticketSales);
                        swal({
                          title: "Se ha "+s+" con exito",
                          icon: "success",
                          closeOnEsc: false,
                          closeOnClickOutside: false
                          })
                          .then((recarga) => {
                            location.reload();
                        });
                      });
                      intento++;
                    } else {
                      console.log('intento: '+intento);
                      getDatilAgain(idTicketSales,medio,idUser,callback);
                      intento++;
                    }
                  } else {
                    swal({
                      title: "No se pudo conectar con Datil",
                      text: "El pago ya fue procesado exitosamente, sin embargo la factura la podrá solicitar el cliente, por expirarse el tiempo de espera.",
                      icon: "info",
                      closeOnEsc: false,
                      closeOnClickOutside: false
                    })
                    .then((recarga) => {
                      location.reload();
                    });
                  }
                });
              } else {
                swal({
                  title: "Se ha "+s+" con exito",
                  icon: "success",
                  closeOnEsc: false,
                  closeOnClickOutside: false
                })
                .then((recarga) => {
                  location.reload();
                });
              }
            },
            error: function (result) {
              swal('Existe un Error en su Solicitud','','error');
              console.log(result);
            }
          });
        });
      });

    });

    $(document).on('click', '#users_a', function() {

      var AllClientsDataTable = $('#ClientsAproved').DataTable({
          processing: true,
          serverSide: true,
            responsive: true,

          ajax: '<?php echo url('AllClientsDataTable'); ?>',
          columns: [
              {data: 'name', name: 'name'},
              {data: 'num_doc', name: 'num_doc'},
              {data: 'img_doc', name: 'img_doc',orderable: false, searchable: false},
              {data: 'fech_nac', name: 'fech_nac'},
              {data: 'type', name: 'type'},
              {data: 'created_at', name: 'created_at'},
              {data: 'webs', name: 'webs'},
              {data: 'Estatus', name: 'Estatus', orderable: false, searchable: false}
          ]
      });

      $(document).on('click', '#users', function() {

           AllClientsDataTable.destroy();
      });

      $(document).on('click', '#users_d', function() {

           AllClientsDataTable.destroy();
      });

      $(document).on('click', '#users_payments', function() {

           AllClientsDataTable.destroy();
      });

  });

    $(document).on('click', '#users_d', function() {

      var DenialClientsDataTable = $('#ClientsDenials').DataTable({
          processing: true,
          serverSide: true,
            responsive: true,

          ajax: '<?php echo url('RejectedClientsDataTable'); ?>',
          columns: [
              {data: 'name', name: 'name'},
              {data: 'num_doc', name: 'num_doc'},
              {data: 'img_doc', name: 'img_doc',orderable: false, searchable: false},
              {data: 'fech_nac', name: 'fech_nac'},
              {data: 'type', name: 'type'},
              {data: 'created_at', name: 'created_at'},
              {data: 'webs', name: 'webs'},
              {data: 'Estatus', name: 'Estatus', orderable: false, searchable: false}
          ]
      });

      $(document).on('click', '#users', function() {

           DenialClientsDataTable.destroy();
      });

      $(document).on('click', '#users_a', function() {

           DenialClientsDataTable.destroy();
      });

      $(document).on('click', '#users_payments', function() {

           DenialClientsDataTable.destroy();
      });

  });


  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('promoter.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>