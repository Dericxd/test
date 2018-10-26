@extends('seller.layouts')
<style type="text/css">
#image-preview {
  width: 300px;
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

</style>
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
       <form class="form-horizontal" role="form" method="POST" action="{{ url('megazine_save') }}" enctype="multipart/form-data">
         <input type="hidden" name="id" value="{{Auth::guard('web_seller')->user()->id }}">
                     {{ csrf_field() }}
 <div class="row" style="margin-left: 30px;">         
    <div class="col-sm-7"> 
        <div class="box box-primary">

        <div class="box-header with-border">
                     <h3 class="box-title">Revista</h3>
                </div>

            <div class="box-body">

        <div class="form-group">
                            <label for="art_name" class="col-md-4 control-label">Titulo De La Revista</label>
                            <div class="col-md-6">
                                <input id="titulo" type="text" class="form-control" name="title" required autofocus placeholder="Titulo de la revista">
                                <div id="mensajeTitulo"></div>
                            </div>
              </div>

        <div class="form-group">
               <label for="desc" class="col-md-4 control-label">Descripción</label>

                            <div class="col-md-6" id="sinopsis">
                                <textarea name="dsc"  class="form-control" placeholder="Descripción de la revista" rows="3" cols="2"   required ></textarea>
                                <div id="mensajeSinopsis"></div>
                            </div>
                            
              </div>

              <div class="form-group">
                <label for="type_authors" class="col-md-4 control-label">Cadena de Publicacion</label>
                  <div class="col-md-6">
                      <select class="form-control" name="type_megazine">
                        @foreach($sagas as $saga)
                        <option value="{{$saga->id}}">{{$saga->sag_name}}</option>
                         @endforeach
                        <option value="0" selected>Revista independiente</option>
                    </select>
                  </div>
              </div>

              <div class="form-group">
                            <label for="country" class="col-md-4 control-label">Pais</label>

                            <div class="col-md-6">
                <select  name="country" class="form-control js-example-basic-single">
                <option value="AF">Afganistán</option>                                         
                              <option value="AL">Albania</option>                                         
                              <option value="DE">Alemania</option>                                         
                              <option value="AD">Andorra</option>                                         
                              <option value="AO">Angola</option>                                         
                              <option value="AI">Anguilla</option>                                         
                              <option value="AQ">Antártida</option>                                         
                              <option value="AG">Antigua y Barbuda</option>                                         
                              <option value="AN">Antillas Holandesas</option>                                         
                              <option value="SA">Arabia Saudí</option>                                         
                              <option value="DZ">Argelia</option>                                         
                              <option value="AR">Argentina</option>                                         
                              <option value="AM">Armenia</option>                                         
                              <option value="AW">Aruba</option>                                         
                              <option value="AT">Austria</option>                                         
                              <option value="AZ">Azerbaiyán</option>                                         
                              <option value="AU">Australia</option>                                         
                              <option value="BS">Bahamas</option>                                         
                              <option value="BH">Bahrein</option>                                         
                              <option value="BD">Bangladesh</option>                                         
                              <option value="BB">Barbados</option>                                         
                              <option value="BE">Bélgica</option>                                         
                              <option value="BZ">Belice</option>                                         
                              <option value="BJ">Benin</option>                                         
                              <option value="BM">Bermudas</option>                                         
                              <option value="BY">Bielorrusia</option>                                         
                              <option value="MM">Birmania</option>                                         
                              <option value="BO">Bolivia</option>                                         
                              <option value="BA">Bosnia y Herzegovina</option>                                         
                              <option value="BW">Botswana</option>                                         
                              <option value="BR">Brasil</option>                                         
                              <option value="BN">Brunei</option>                                         
                              <option value="BG">Bulgaria</option>                                         
                              <option value="BF">Burkina Faso</option>                                         
                              <option value="BI">Burundi</option>                                         
                              <option value="BT">Bután</option>                                         
                              <option value="CV">Cabo Verde</option>                                         
                              <option value="KH">Camboya</option>                                         
                              <option value="CM">Camerún</option>                                         
                              <option value="CA">Canadá</option>                                         
                              <option value="TD">Chad</option>                                         
                              <option value="CL">Chile</option>                                         
                              <option value="CN">China</option>                                         
                              <option value="CY">Chipre</option>                                         
                              <option value="VA">Ciudad del Vaticano (Santa Sede)</option>                           
                              <option value="CO">Colombia</option>                                         
                              <option value="KM">Comores</option>                                         
                              <option value="CG">Congo</option>                                         
                              <option value="CD">Congo, República Democrática del</option>                           
                              <option value="KR">Corea</option>                                         
                              <option value="KP">Corea del Norte</option>                                         
                              <option value="CI">Costa de Marfíl</option>                                         
                              <option value="CR">Costa Rica</option>                                         
                              <option value="HR">Croacia (Hrvatska)</option>                                         
                              <option value="CU">Cuba</option>                                         
                              <option value="DK">Dinamarca</option>                                         
                              <option value="DJ">Djibouti</option>                                         
                              <option value="DM">Dominica</option>                                         
                              <option value="EC" selected>Ecuador</option>                                         
                              <option value="EG">Egipto</option>                                         
                              <option value="SV">El Salvador</option>                                         
                              <option value="AE">Emiratos Árabes Unidos</option>                                         
                              <option value="ER">Eritrea</option>                                         
                              <option value="SI">Eslovenia</option>                                         
                              <option value="ES">España</option>                                         
                              <option value="US">Estados Unidos</option>                                         
                              <option value="EE">Estonia</option>                                         
                              <option value="ET">Etiopía</option>                                         
                              <option value="FJ">Fiji</option>                                         
                              <option value="PH">Filipinas</option>                                         
                              <option value="FI">Finlandia</option>                                         
                              <option value="FR">Francia</option>                                         
                              <option value="GA">Gabón</option>                                         
                              <option value="GM">Gambia</option>                                         
                              <option value="GE">Georgia</option>                                         
                              <option value="GH">Ghana</option>                                         
                              <option value="GI">Gibraltar</option>                                         
                              <option value="GD">Granada</option>                                         
                              <option value="GR">Grecia</option>                                         
                              <option value="GL">Groenlandia</option>                                         
                              <option value="GP">Guadalupe</option>                                         
                              <option value="GU">Guam</option>                                         
                              <option value="GT">Guatemala</option>                                         
                              <option value="GY">Guayana</option>                                         
                              <option value="GF">Guayana Francesa</option>                                         
                              <option value="GN">Guinea</option>                                         
                              <option value="GQ">Guinea Ecuatorial</option>
                              <option value="GW">Guinea-Bissau</option>
                              <option value="HT">Haití</option>
                              <option value="HN">Honduras</option>
                              <option value="HU">Hungría</option>
                              <option value="IN">India</option>
                              <option value="ID">Indonesia</option>
                              <option value="IQ">Irak</option>
                              <option value="IR">Irán</option>
                              <option value="IE">Irlanda</option>
                              <option value="BV">Isla Bouvet</option>
                              <option value="CX">Isla de Christmas</option>
                              <option value="IS">Islandia</option>
                              <option value="KY">Islas Caimán</option>
                              <option value="CK">Islas Cook</option>
                              <option value="CC">Islas de Cocos o Keeling</option>
                              <option value="FO">Islas Faroe</option>
                              <option value="HM">Islas Heard y McDonald</option>
                              <option value="FK">Islas Malvinas</option>
                              <option value="MP">Islas Marianas del Norte</option>
                              <option value="MH">Islas Marshall</option>
                              <option value="UM">Islas menores de Estados Unidos</option>
                              <option value="PW">Islas Palau</option>
                              <option value="SB">Islas Salomón</option>
                              <option value="SJ">Islas Svalbard y Jan Mayen</option>
                              <option value="TK">Islas Tokelau</option>
                              <option value="TC">Islas Turks y Caicos</option>
                              <option value="VI">Islas Vírgenes (EEUU)</option>
                              <option value="VG">Islas Vírgenes (Reino Unido)</option>
                              <option value="WF">Islas Wallis y Futuna</option>
                              <option value="IL">Israel</option>
                              <option value="IT">Italia</option>
                              <option value="JM">Jamaica</option>
                              <option value="JP">Japón</option>
                              <option value="JO">Jordania</option>
                              <option value="KZ">Kazajistán</option>
                              <option value="KE">Kenia</option>
                              <option value="KG">Kirguizistán</option>
                              <option value="KI">Kiribati</option>
                              <option value="KW">Kuwait</option>
                              <option value="LA">Laos</option>
                              <option value="LS">Lesotho</option>
                              <option value="LV">Letonia</option>
                              <option value="LB">Líbano</option>
                              <option value="LR">Liberia</option>
                              <option value="LY">Libia</option>
                              <option value="LI">Liechtenstein</option>
                              <option value="LT">Lituania</option>
                              <option value="LU">Luxemburgo</option>
                              <option value="MK">Macedonia, Ex-República Yugoslava de</option>
                              <option value="MG">Madagascar</option>
                              <option value="MY">Malasia</option>
                              <option value="MW">Malawi</option>
                              <option value="MV">Maldivas</option>
                              <option value="ML">Malí</option>
                              <option value="MT">Malta</option>
                              <option value="MA">Marruecos</option>
                              <option value="MQ">Martinica</option>
                              <option value="MU">Mauricio</option>
                              <option value="MR">Mauritania</option>
                              <option value="YT">Mayotte</option>
                              <option value="MX">México</option>
                              <option value="FM">Micronesia</option>
                              <option value="MD">Moldavia</option>
                              <option value="MC">Mónaco</option>
                              <option value="MN">Mongolia</option>
                              <option value="MS">Montserrat</option>
                              <option value="MZ">Mozambique</option>
                              <option value="NA">Namibia</option>
                              <option value="NR">Nauru</option>
                              <option value="NP">Nepal</option>
                              <option value="NI">Nicaragua</option>
                              <option value="NE">Níger</option>
                              <option value="NG">Nigeria</option>
                              <option value="NU">Niue</option>
                              <option value="NF">Norfolk</option>
                              <option value="NO">Noruega</option>
                              <option value="NC">Nueva Caledonia</option>
                              <option value="NZ">Nueva Zelanda</option>
                              <option value="OM">Omán</option>
                              <option value="NL">Países Bajos</option>
                              <option value="PA">Panamá</option>
                              <option value="PG">Papúa Nueva Guinea</option>
                              <option value="PK">Paquistán</option>
                              <option value="PY">Paraguay</option>
                              <option value="PE">Perú</option>
                              <option value="PN">Pitcairn</option>
                              <option value="PF">Polinesia Francesa</option>
                              <option value="PL">Polonia</option>
                              <option value="PT">Portugal</option>
                              <option value="PR">Puerto Rico</option>
                              <option value="QA">Qatar</option>
                              <option value="UK">Reino Unido</option>
                              <option value="CF">República Centroafricana</option>
                              <option value="CZ">República Checa</option>
                              <option value="ZA">República de Sudáfrica</option>
                              <option value="DO">República Dominicana</option>
                              <option value="SK">República Eslovaca</option>
                              <option value="RE">Reunión</option>
                              <option value="RW">Ruanda</option>
                              <option value="RO">Rumania</option>
                              <option value="RU">Rusia</option>
                              <option value="EH">Sahara Occidental</option>
                              <option value="KN">Saint Kitts y Nevis</option>
                              <option value="WS">Samoa</option>
                              <option value="AS">Samoa Americana</option>
                              <option value="SM">San Marino</option>
                              <option value="VC">San Vicente y Granadinas</option>
                              <option value="SH">Santa Helena</option>
                              <option value="LC">Santa Lucía</option>
                              <option value="ST">Santo Tomé y Príncipe</option>
                              <option value="SN">Senegal</option>
                              <option value="SC">Seychelles</option>
                              <option value="SL">Sierra Leona</option>
                              <option value="SG">Singapur</option>
                              <option value="SY">Siria</option>
                              <option value="SO">Somalia</option>
                              <option value="LK">Sri Lanka</option>
                              <option value="PM">St Pierre y Miquelon</option>
                              <option value="SZ">Suazilandia</option>
                              <option value="SD">Sudán</option>
                              <option value="SE">Suecia</option>
                              <option value="CH">Suiza</option>
                              <option value="SR">Surinam</option>
                              <option value="TH">Tailandia</option>
                              <option value="TW">Taiwán</option>
                              <option value="TZ">Tanzania</option>
                              <option value="TJ">Tayikistán</option>
                              <option value="TF">Territorios franceses del Sur</option>
                              <option value="TP">Timor Oriental</option>
                              <option value="TG">Togo</option>
                              <option value="TO">Tonga</option>
                              <option value="TT">Trinidad y Tobago</option>
                              <option value="TN">Túnez</option>
                              <option value="TM">Turkmenistán</option>
                              <option value="TR">Turquía</option>
                              <option value="TV">Tuvalu</option>
                              <option value="UA">Ucrania</option>
                              <option value="UG">Uganda</option>
                              <option value="UY">Uruguay</option>
                              <option value="UZ">Uzbekistán</option>
                              <option value="VU">Vanuatu</option>
                              <option value="VE">Venezuela</option>
                              <option value="VN">Vietnam</option>
                              <option value="YE">Yemen</option>
                              <option value="YU">Yugoslavia</option>
                              <option value="ZM">Zambia</option>
                              <option value="ZW">Zimbabue</option>              
                              
                </select>
                            </div>
              </div>
              
              <div class="form-group">
                <label for="megazine_file" class="col-md-4 control-label">Archivo de la Revista</label>
                   <div class="col-md-6">
                     <input type="file" name="pdf_file" />
                   </div>
              </div>
              <div class="form-group col-md-6">         
                <label for="tags"> Generos</label>
                  <select name="tags[]" multiple="true" class="form-control" id="genders" required="required">
                  @foreach($tags as $genders)
                      @if($genders->type_tags=='Revistas')
                        <option value="{{$genders->id}}">{{$genders->tags_name}}</option>
                      @endif
                  @endforeach
                  </select>
                         
              </div>
              <div class="form-group">
               <label for="cost" class="col-md-4 control-label">Costo</label>
                   <div class="col-md-6">
                     <input type="number" name="cost" class="form-control" oninput="maxLengthCheck(this)" onkeypress="return controltagNum(event)" id="precio" placeholder="Costo en tickets" min="0"> 
                     <div id="mensajePrecio"></div>                            
                   </div>
                   
              </div>
           
             {{--seleccion de rating--}}
                
                {!! Form::select('rating_id',$ratin,null,['class'=>'form-control','placeholder'=>'Selecione una categoría','id'=>'exampleInputFile','required'=>'required','oninvalid'=>"this.setCustomValidity('Seleccione una categoría')",'oninput'=>"setCustomValidity('')"]) !!}
                            <br>
           
        <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary" id="guardarRevista">
                       Registrar
                    </button>
                </div>
              </div>
            </div>

        </div>
    </div>
    
    <div class="col-sm-4">
      <div class="box box-primary" style="margin-rigth: 30px;">
          <div class="box-header with-border">
            <h3 class="box-title">Portada</h3>
          </div>

          <div class="box-body">
            
            
             <div id="image-preview" style="border:#bdc3c7 1px solid ;" class="form-group col-md-1">
                  <label for="image-upload" id="image-label"> Portada del Libro </label>
                    {!! Form::file('photo',['class'=>'form-control control-label','id'=>'image-upload','accept'=>'image/*','required'=>'required','oninvalid'=>"this.setCustomValidity('Seleccione una imagen de portada')",'oninput'=>"setCustomValidity('')"]) !!}
                 <div id="list"></div>
            </div>
          </div>
      </div>
    </div>
 </div>

       </form>
@endsection

@section('js')
<script type="text/javascript">
    /*Para maxlength del costo*/
function maxLengthCheck(object) {
    if (object.value.length > 3)
      object.value = object.value.slice(0, 3)
  }
</script>
<script type="text/javascript">
  $("#precio").change(function(){
        var nombre = $("#precio").val().trim();
        if (nombre.length < 1 ){
            $('#mensajePrecio').show();
            $('#mensajePrecio').text('El precio no debe estar vacio');
            $('#mensajePrecio').css('color','red');
            $('#guardarRevista').attr('disabled',true);
        }
        else {
            $('#mensajePrecio').hide();
            $('#guardarRevista').attr('disabled',false);
        
        }
    })
  $("#titulo").change(function(){
        var nombre = $("#titulo").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeTitulo').show();
            $('#mensajeTitulo').text('El titulo no debe estar vacio');
            $('#mensajeTitulo').css('color','red');
            $('#guardarRevista').attr('disabled',true);
        }
        else {
            $('#mensajeTitulo').hide();
            $('#guardarRevista').attr('disabled',false);
        
        }
    })
  $("#sinopsis").change(function(){
        var nombre = $("#sinopsis").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeSinopsis').show();
            $('#mensajeSinopsis').text('La descripción no debe estar vacia');
            $('#mensajeSinopsis').css('color','red');
            $('#guardarRevista').attr('disabled',true);
        }
        else {
            $('#mensajeSinopsis').hide();
            $('#guardarRevista').attr('disabled',false);
        
        }
    })
</script>
<script>

function portada(evt) {
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                document.getElementById("list").innerHTML = ['<img style= width:100%; height:100%; border-top:50%; src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
    document.getElementById('image-upload').addEventListener('change', portada, false);
</script>
<script type="text/javascript">
    // Validacion de solo letas
        function controltagLet(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==8) return true; // para la tecla de retroseso
            else if (tecla==0||tecla==9)  return true; //<-- PARA EL TABULADOR-> su keyCode es 9 pero en tecla se esta transformando a 0 asi que porsiacaso los dos
            else if (tecla==13) return true;
            patron =/[AaÁáBbCcDdEeÉéFfGgHhIiÍíJjKkLlMmNnÑñOoÓóPpQqRrSsTtUuÚúVvWwXxYyZz+\s]/;// -> solo letras
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }
        // Validacion de solo letas
        //---------------------------------------------------------------------------------------------------
        // Validacion de solo numeros
        function controltagNum(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla==8) return true; // para la tecla de retroseso
            else if (tecla==0||tecla==9)  return true; //<-- PARA EL TABULADOR-> su keyCode es 9 pero en tecla se esta transformando a 0 asi que porsiacaso los dos
            else if (tecla==13) return true;
            patron =/[0-9]/;// -> solo numeros
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }
</script>
@endsection
