 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Modificar estado del cliente</h4>
        </div>
        <div class="modal-body text-center">
          <h5>Modifique el estatus del cliente</h5>
          <form method="POST" id="formStatus">
            {{ csrf_field() }}
            <div class="radio-inline">
              <label for="option-1">
                <input type="radio" id="option-1" onclick="javascript:yesnoCheck();" name="status" value="Aprobado">
                <span>Aprobar</span>
              </label>
            </div>

            <div class="radio-inline">
              <label for="option-2">
                <input type="radio" id="option-2" onclick="javascript:yesnoCheck();" name="status" value="Rechazado">
                <span>Negar</span>
              </label>
            </div>

            <div style="display:none" id="if_no">
              <label for="razon">Explique la razón</label>
              <textarea name="message" class="form-control" type="text" id="razon"></textarea>
              <div id="mensajeMaximoRazon"></div>
            </div>
            <br>

            <button class="btn btn-primary" type="submit">
              Enviar
            </button>
          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ciModal" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center">Imagen del documento</h4>
        </div>
        <div class="modal-body text-center">
          <img src="" id="ci_photo" data-big="" data-overlay="" data-big2x="">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


 <div class="modal fade" id="webModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Redes</h4>
        </div>
        <div class="modal-body">      
            <table class="table table-bordered table-striped table-condensed" id="WebsTable">            
            <thead>
                <tr>
                  <th class="non-numeric">Nombre</th>
                  <th class="non-numeric">Correo</th>
                  <th class="non-numeric">Nivel</th>
                </tr>
              </thead>
          
          </table>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>

   <div class="modal fade" id="PayModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Validar Deposito</h4>
        </div>
        <div class="modal-body">
         <p>Verificar</p>
        

             <form method="POST" id="formPayment">
                              {{ csrf_field() }}

              <div class="radio-inline">
                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                <input type="radio" id="option-1" class="mdl-radio__button"  onclick="javascript:yesnoCheck();" name="status_p" value="Aprobado">
                <span class="mdl-radio__label">Aprobar</span>
                </label>
             </div>

             <div class="radio-inline">
             <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                <input type="radio" id="option-2" class="mdl-radio__button" onclick="javascript:yesnoCheck();" name="status_p" value="Rechazado">
                <span class="mdl-radio__label">Negar</span>
             </label>

             </div>

             <div class="radio-inline" style="display:none" id="if_no">
              <div class="mdl-textfield mdl-js-textfield">
               <textarea name="message" class="mdl-textfield__input" type="text" rows= "6" id="razon" ></textarea>
               <label class="mdl-textfield__label" for="razon_p">Explique La Razon</label>
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