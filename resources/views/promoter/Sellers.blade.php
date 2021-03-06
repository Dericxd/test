@extends('promoter.layouts.app')


@section('content')
<main  class="mdl-layout__content">
<div class="mdl-layout mdl-grid">
    <div class="mdl-grid">
        
            <div class="mdl-cell mdl-cell-1--col">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="mdl-data-table mdl-js-data-table ">            
                        <thead>
                                <tr>
                                  <th>Estatus</th>
                                  <th>Nombre</th>
                                  <th>Correo</th>
                                  <th>Ruc</th>
                                  <th>Descripcion</th>
                                  <th>Modulos</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @foreach($sellers as $seller)
                                    <tr id="seller{{$seller->id}}">
                                      <td>                          
                                       <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="ModifySellers" value="{{$seller->id}}" data-toggle="modal" data-target="#myModal">
                                          {{$seller->estatus}}
                                        </button>
                                      </td>
                                      <td>{{$seller->name}}</td>
                                      <td>{{$seller->email}}</td>
                                      <td>{{$seller->ruc}}</td>
                                      <td>{{$seller->descs_s}}</td>
                                      <td id="modules_td{{$seller->id}}">@foreach($seller->roles()->get() as $modules) 

                                  <span class="mdl-chip mdl-chip--deletable" id="m_{{$modules->id}}_{{$seller->id}}">
                                  <span class="mdl-chip__text" id="modules">{{$modules->name}}</span>
                                  <button type="button" class="mdl-chip__action" 
                                  value1="{{$modules->id}}" value2="{{$seller->id}}" name="module" id="x"><i class="material-icons">cancel</i>
                                  </button>
                                  </span>
                                  @endforeach
                                    <button class="mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored" data-toggle="modal" data-target="#ModalModules" value="{{$seller->id}}" id="add_module" @if($seller->estatus!= 'Aprobado') disabled @endif>
                                    <i class="material-icons">add</i>
                                    </button>
                                     </td>
                                      </tr>

                                    @endforeach
                               </tbody>
                       </table>
                       {!! $sellers->render() !!}          
            </div>

        
    </div>
</div>
</main>
 
 <div class="modal fade" id="ModalModules" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modificar Estatus</h4>
        </div>
        <div class="modal-body">
         <p>Modifique el estatus de la Revista</p>
        

             <form method="POST" id="AddModules">
                              {{ csrf_field() }}

               <div class="form-group">

                <label for="sel1">Modulos:</label>
               <select class="form-control" id="sel1" name="acces">
                  @foreach($acces_modules as $acces) <option value="{{$acces->id}}">{{$acces->name}}</option>  @endforeach                 
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
        

             <form method="POST" id="FormStatusSeller">
                              {{ csrf_field() }}

             <div class="radio-inline">
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                <input type="radio" id="option-1
                " class="mdl-radio__button"  onclick="javascript:yesnoCheck();" name="status" value="Aprobado">
                <span class="mdl-radio__label">Aprobar</span>
                </label>
             </div>

             <div class="radio-inline">
             <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                <input type="radio" id="option-2" class="mdl-radio__button" onclick="javascript:yesnoCheck();" name="status" value="Rechazado">
                <span class="mdl-radio__label">Rechazar</span>
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






@endsection

@section('js')
<script>

$(document).on('click', '#x', function() {
  
  var module = $(this).attr('value1'); ;
  var seller = $(this).attr('value2');;
  var url = 'delete_mod/'+seller+'/'+module;
       $.ajax({
         url: url,
         type:'get',
         data:"json",

         success: function(data)
         {
           alert("Se Ha Retirado el Permiso del Modulo con exito");
           $("#m_"+module+"_"+seller).fadeOut();
         },

         error: function(data)
         {
           alert("NO Permitido Por Favor Recargue la Pagina");
         },

       });
});


$(document).on('click', '#add_module', function() {    

          var x = $(this).val();

    $(document).ready(function (e){

        $( "#AddModules" ).on( 'submit', function(e){
          
          var module = $("#sel1").val();
          var url = 'add_module/'+x;
          
          var name = $( "#sel1 option:selected" ).text();
          var row = $("#modules_td"+x);
          var add = '<span class="mdl-chip mdl-chip--deletable" id="m_'+module+'_'+x+'">  <span class="mdl-chip__text" id="modules">'+name+'</span> <button type="button" class="mdl-chip__action" value1="'+module+'" value2="'+x+'" name="module" id="x"> <i class="material-icons">cancel</i> </button></span>';
          e.preventDefault();
            
            $.ajax({

              url: url,
              type:'POST',
              data:{
                    _token: $('input[name=_token]').val(),
                    acces: module,
                    }, 

                    success: function (result) {
                      alert('Acceso Concedido Con Exito');
                     
                     row.prepend(add);   
                    },

                    error: function (result) 
                    {
                      alert('Error en Su solicitud Por Favor Recargue la Pagina');
                      console.log(result);
                    }

            });
          
        });
    });
});

$(document).on('click','#ModifySellers', function() {
  
  var x = $(this).val();
   console.log(x);
   $( "#FormStatusSeller" ).on( 'submit', function(e){

        var s=$("input[type='radio'][name=status]:checked").val();
        var message=$('#razon').val();
        var url = 'update_status_seller/'+x;

        e.preventDefault(); 
        
                            $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                    _token: $('input[name=_token]').val(),
                                    status: s,
                                    message: message,
                                  }, 
                            success: function (result) {

                                                        $('#myModal').toggle();
                                                        $('.modal-backdrop').remove();
                                                        location.reload();
                                                        swal("Se ha "+s+" con exito","","success");
                                                        },

                            error: function (result) {
                            swal('Existe un Error en su Solicitud','','error');
                            
                            },
                            });  
                              
                
   });  


});

</script>

@endsection
                            
                                