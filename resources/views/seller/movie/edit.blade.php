@extends('seller.layouts')
@section('css')
    <style>
        #image-preview {
            width: 100%;
            height: 400px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #2b81af;
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
            width: 50%;
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

        .example-modal .modal {
            position: relative;
            top: auto;
            bottom: auto;
            right: auto;
            left: auto;
            display: block;
            z-index: 1;
        }

        .example-modal .modal {
            background: transparent !important;
        }

        #imageAM-preview {
            width: 300px;
            height: 400px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #2b81af;
        }

        #imageAM-preview input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }

        #imageAM-preview label {
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

        #imageSM-preview {
            width: 300px;
            height: 400px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #2b81af;
        }

        #imageSM-preview input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }

        #imageSM-preview label {
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
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        @if (count($errors)>0)
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="box box-primary">
                    <div class="box-header with-border bg bg-black-gradient">
                        <h3 class="box-title">Editar película</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    {!! Form::open(['route'=>['movies.update',$movie], 'method'=>'PUT','files' => 'true' ]) !!}
                    {{ Form::token() }}
                    <div class="box-body ">

                        {{--Poster de la pelicula--}}
                        <div class="col-md-6">
                            <div id="mensajePortadaPelicula"></div>
                            @if($movie->status != 'Aprobado')
                            <label for="cargaPelicula" id="cargaPelicula" class="control-label" style="color: green;">
                                Si no selecciona una portada, se mantendrá la actual
                            </label>
                            @endif
                            <div id="image-preview" style="border:#bdc3c7 1px solid ;" class="form-group col-md-1">
                                <label for="image-upload" id="image-label"> Portada </label>
                                @if($movie->status != 'Aprobado')
                                {!! Form::file('img_poster',['class'=>'form-control-file', 'control-label', 'id'=>'image-upload', 'accept'=>'image/*']) !!}
                                @endif
                                {!! Form::hidden('img_posterOld',$movie->img_poster)!!}
                                <div id="list">
                                    <img style="width:100%; height:100%; border-top:50%;" src="{{asset('movie/poster')}}/{{$movie->img_poster}}">
                                </div>
                            </div>
                        </div>

                        {{--Selecion tipo de publico de la pelicula--}}
                        <div class="form-group col-md-6">
                            {{--titulo de la pelicula--}}
                            <label for="exampleInputFile" class="control-label">Título</label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::text('title',$movie->title,['class'=>'form-control','placeholder'=>'Título de la pelicula','required'=>'required','id'=>'titulo','oninvalid'=>"this.setCustomValidity('Seleccione un título')",'oninput'=>"setCustomValidity('')"]) !!}
                            @else
                            {!! Form::text('title',$movie->title,['class'=>'form-control','placeholder'=>'Título de la pelicula', 'readonly']) !!}
                            @endif
                            <div id="mensajeTitulo"></div>
                            <br>

                            {{--titulo original de la pelicula--}}
                            <label for="exampleInputFile" class="control-label">Título original </label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::text('original_title',$movie->original_title,['class'=>'form-control','placeholder'=>'Titulo original','id'=>'titulOriginal','placeholder'=>'Titulo de la película','required'=>'required','oninvalid'=>"this.setCustomValidity('Seleccione el título original')",'oninput'=>"setCustomValidity('')"]) !!}
                            @else
                            {!! Form::text('original_title',$movie->original_title,['class'=>'form-control','placeholder'=>'Titulo original','placeholder'=>'Titulo de la película', 'readonly']) !!}
                            @endif
                            <div id="mensajeTitulOriginal"></div>
                            <br>

                            {{--precio--}}
                            <label for="exampleInputPassword1" class="control-label">Costo en tickets</label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::number('cost',$movie->cost,['class'=>'form-control','placeholder'=>'Costo en tickets', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Escriba un Precio')", 'oninput'=>"setCustomValidity('')", 'id'=>'precio', 'min'=>'0','onkeypress' => 'return controltagNum(event)', 'oninput'=>"maxLengthCheck(this)"]) !!}
                            @else
                            {!! Form::number('cost',$movie->cost,['class'=>'form-control','placeholder'=>'Costo en tickets', 'required'=>'required','readonly', 'id'=>'precio', 'min'=>'0']) !!}
                            @endif
                            <div id="mensajePrecio"></div>
                            <br>

                            <label for="exampleInputFile" class="control-label">Categoría</label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::select('rating_id',$ratin,$movie->rating_id,['class'=>'form-control select-author','placeholder'=>'Selecione una opción','id'=>'categoria','required'=>'required','oninvalid'=>"this.setCustomValidity('Seleccione una categoría')",'oninput'=>"setCustomValidity('')"]) !!}
                            @else
                            {!! Form::select('rating_id',$ratin,$movie->rating_id,['class'=>'form-control select-author','placeholder'=>'Selecione una opción','id'=>'categoria','disabled'=>true ]) !!}
                            @endif
                            <br>

                            {{--Categoria--}}
                            <label for="tags"> Generos </label>
                            @if($movie->status != 'Aprobado')
                            <select name="tags[]" multiple="true" class="form-control" required>
                                @foreach($tags as $genders)
                                    <option value="{{$genders->id}}"
                                        @foreach($s_tags as $s) 
                                            @if($s->id == $genders->id) 
                                                selected 
                                            @endif 
                                        @endforeach
                                        >
                                        {{$genders->tags_name}}
                                    </option>
                                @endforeach
                            </select>
                            @else
                            <select name="tags[]" multiple="true" class="form-control" disabled="true">
                                @foreach($tags as $genders)
                                    <option value="{{$genders->id}}"
                                        @foreach($s_tags as $s) 
                                            @if($s->id == $genders->id) 
                                                selected 
                                            @endif 
                                        @endforeach
                                        >
                                        {{$genders->tags_name}}
                                    </option>
                                @endforeach
                            </select>
                            @endif
                            <br>

                        </div>

                        <div class="form-group col-md-6">

                            {{--archivo de la pelicula--}}
                            @if($movie->status != 'Aprobado')
                            <label for="exampleInputFile" class="control-label">Cargar película</label>
                            <div id='mensajeCargaPelicula'></div>
                            <label for="cargaPelicula" id="mensajePelicula" class="control-label" style="color: green;">
                                Si no selecciona una película, se mantendrá la actual
                            </label>
                            {!! Form::file('duration',['class'=>'form-control','accept'=>'.mp4','id'=>'pelicula']) !!}
                            <br>
                            {!! Form::hidden('durationOld',$movie->duration) !!}
                            @else
                            {!! Form::hidden('durationOld',$movie->duration) !!}
                            @endif
                            {{--año de salida de la pelicula --}}
                            <label for="exampleInputPassword1" class="control-label">Año de lanzamiento</label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::number('release_year',$movie->release_year,['class'=>'form-control','placeholder'=>'Año de lanzamiento', 'id'=>'fechaLanzamiento', 'min'=>'0', 'max'=>"@date('Y')", 'onkeypress' => 'return controltagNum(event)','oninput'=>"setCustomValidity('')", 'oninvalid'=>"this.setCustomValidity('Seleccione el año de lanzamiento')"]) !!}
                            @else
                            {!! Form::number('release_year',$movie->release_year,['class'=>'form-control','placeholder'=>'Año de lanzamiento', 'id'=>'fechaLanzamiento', 'min'=>'0', 'max'=>"@date('Y')", 'readonly']) !!}
                            @endif
                            <div id="mensajeFechaLanzamiento"></div>
                            <br>

                            {{--Basado en un libro o no --}}
                            <label for="exampleInputPassword1" class="control-label">Sinopsis</label>
                            {!! Form::textarea('based_on',$movie->based_on,['class'=>'form-control','rows'=>'3','cols'=>'2','placeholder'=>'Sinopsis de la película','required'=>'required', 'oninvalid'=>"this.setCustomValidity('Escriba una sinopsis de la película')", 'oninput'=>"setCustomValidity('')", 'id'=>'sinopsis']) !!}
                            <div id="mensajeSinopsis"></div>
                        </div>

                        <div class="form-group col-md-6">
                            {{--historia de la pelicula --}}
                            {{--
                            <label for="exampleInputPassword1" class="control-label">Historia</label>
                            {!!  Form::textarea('story', $movie->story, ['class'=>'form-control', 'rows'=>'3', 'cols'=>'2', 'placeholder'=>'Historia de la pelicula', 'id'=>'historia', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Escriba una historia de la película')", 'oninput'=>"setCustomValidity('')"]) !!}
                            <br>
                            --}}

                            {{--selecionar pais--}}
                            @if($movie->status != 'Aprobado')
                            <label class="control-label">Pais</label>
                            <label for="cargaPelicula" id="cargaPelicula" class="control-label" style="color: green;">
                                Si no selecciona un país, se mantendrá la actual
                            </label>
                            <br>
                            <select  name="country" id="paises" class="form-control" >
                                <option value="" selected>Seleccione una opción</option>
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
                                <option value="EC">Ecuador</option>
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
                            @endif
                            <br>
                        </div>

                        <div class="form-group col-md-6">
                            {{--link--}}
                            <label for="exampleInputPassword1" class="control-label">Link del trailer</label>
                            @if($movie->status != 'Aprobado')
                            {!! Form::url('trailer_url',$movie->trailer_url,['class'=>'form-control','placeholder'=>'Link del trailer', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Ingrese el link del trailer de la película')", 'oninput'=>"setCustomValidity('')", 'id'=>'link']) !!}
                            @else
                            {!! Form::url('trailer_url',$movie->trailer_url,['class'=>'form-control','placeholder'=>'Link del trailer', 'required'=>'required', 'readonly', 'id'=>'link']) !!}
                            @endif
                            <div id="mensajeLink"></div>
                            <br>
                            <input type="hidden" id="saga" value="{{$movie->saga_id}}">
                            @if($movie->status != 'Aprobado')
                            <label class="control-label"> ¿Pertenece a una saga? </label>
                            <br>
                            <div class="radio-inline">
                                <label class="control-label" for="option-1">
                                    <input type="radio" id="option-1" class="flat-red" onclick="javascript:yesnoCheck();" name="status" value="Aprobado">
                                    <span class="mdl-radio__label">Si</span>
                                </label>
                            </div>

                            <div class="radio-inline">
                                <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                                    <input type="radio" id="option-2" class="mdl-radio__button" onclick="javascript:yesnoCheck();" name="status" value="Denegado">
                                    <span class="mdl-radio__label">No</span>
                                </label>

                            </div>
                            <br>
                            @endif
                            <div class="" style="display:none" id="if_si">
                                {!! Form::select('saga_id',$saga,$movie->saga_id,['class'=>'form-control','id'=>'sagas', 'required'=>'required', 'oninvalid'=>"this.setCustomValidity('Ingrese el nombre de la saga de la película')", 'oninput'=>"setCustomValidity('')"]) !!}
                                <br>

                                {{--
                                <label for="exampleInputPassword1" class="control-label">Después</label>
                                <div id="mensajeDespues"></div>
                                {!! Form::number('after',$movie->after,['class'=>'form-control','placeholder'=>'Número del capítulo que va después','min'=>'0','id'=>'despues','required'=>'required']) !!}
                                --}}

                                {{--
                                <label for="exampleInputPassword1" class="control-label">Antes</label>
                                <div id="mensajeAntes"></div>
                                {!! Form::number('before',$movie->before,['class'=>'form-control','placeholder'=>'Número del capítulo que va antes','min'=>'0','id'=>'antes','required'=>'required']) !!}
                                --}}
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="form-group col-md-6">
                                <div align="right">
                                    <a href="{{ url('/movies') }}" class="btn btn-danger">Atrás</a>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div align="left">
                                    {!! Form::submit('Editar película', ['class' => 'btn btn-primary','id'=>'guardarCambios']) !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </section>

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
<script type="text/javascript">
    $("#titulo").change(function(){
        var nombre = $("#titulo").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeTitulo').show();
            $('#mensajeTitulo').text('El titulo no debe estar vacio');
            $('#mensajeTitulo').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajeTitulo').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
    $("#titulOriginal").change(function(){
        var nombre = $("#titulOriginal").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeTitulOriginal').show();
            $('#mensajeTitulOriginal').text('El titulo no debe estar vacio');
            $('#mensajeTitulOriginal').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajeTitulOriginal').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
    $("#precio").change(function(){
        var nombre = $("#precio").val().trim();
        if (nombre.length < 1 ){
            $('#mensajePrecio').show();
            $('#mensajePrecio').text('El precio no debe estar vacio');
            $('#mensajePrecio').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajePrecio').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
    $("#sinopsis").change(function(){
        var nombre = $("#sinopsis").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeSinopsis').show();
            $('#mensajeSinopsis').text('La sinopsis no debe estar vacia');
            $('#mensajeSinopsis').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajeSinopsis').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
    $("#fechaLanzamiento").change(function(){
        var nombre = $("#fechaLanzamiento").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeFechaLanzamiento').show();
            $('#mensajeFechaLanzamiento').text('La fecha no debe estar vacia');
            $('#mensajeFechaLanzamiento').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajeFechaLanzamiento').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
    $("#link").change(function(){
        var nombre = $("#link").val().trim();
        if (nombre.length < 1 ){
            $('#mensajeLink').show();
            $('#mensajeLink').text('El trailer no debe estar vacio');
            $('#mensajeLink').css('color','red');
            $('#registrarPelicula').attr('disabled',true);
        }
        else {
            $('#mensajeFechaLanzamiento').hide();
            $('#registrarPelicula').attr('disabled',false);
        
        }
    })
</script>
    <script>
//---------------------------------------------------------------------------------------------------
// Para que se vea la imagen en el formulario
    function archivo(evt) {
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
  document.getElementById('image-upload').addEventListener('change', archivo, false);
// Para que se vea la imagen en el formulario
//---------------------------------------------------------------------------------------------------
    // Para validar el tamaño maximo de las imagenes de la pelicula y la pelicula
        // Portada de la Pelicula
        $(document).ready(function(){
            $('#image-upload').change(function(){
                var tamaño = this.files[0].size;
                var tamañoKb = parseInt(tamaño/1024);
                if (tamañoKb>2048) {
                    $('#cargaPelicula').hide();
                    $('#mensajePortadaPelicula').show();
                    $('#mensajePortadaPelicula').text('La imagen es demasiado grande, el tamaño máximo permitido es de 2.048 KiloBytes');
                    $('#mensajePortadaPelicula').css('color','red');
                    $('#guardarCambios').attr('disabled',true);
                } else {
                    $('#cargaPelicula').show();
                    $('#mensajePortadaPelicula').hide();
                    $('#guardarCambios').attr('disabled',false);
                }
            });
        });
        // Portada de la Pelicula
        // Archivo de la Pelicula
        $(document).ready(function(){
            $('#pelicula').change(function(){
                var tamaño = this.files[0].size;
                var tamañoKb = parseInt(tamaño/1024);
                if (tamañoKb>2048) {
                    $('#mensajePelicula').hide();
                    $('#mensajeCargaPelicula').show();
                    $('#mensajeCargaPelicula').text('El archivo es demasiado grande, el tamaño máximo permitido es de 2.048 KiloBytes');
                    $('#mensajeCargaPelicula').css('color','red');
                    $('#guardarCambios').attr('disabled',true);
                } else {
                    $('#mensajeCargaPelicula').hide();
                    $('#guardarCambios').attr('disabled',false);
                }
            });
        });
        // Archivo de la Pelicula
    // Para validar el tamaño maximo de las imagenes de la pelicula y la pelicula
//---------------------------------------------------------------------------------------------------
// Para validar la Fecha de Lanzamiento
    $(document).ready(function(){
        $('#fechaLanzamiento').keyup(function(evento){
            var fechaActual = new Date();
            var año = $('#fechaLanzamiento').val();
            if (año > fechaActual.getFullYear()) {
                $('#mensajeFechaLanzamiento').show();
                $('#mensajeFechaLanzamiento').text('La Fecha de Lanzamiento no debe exceder el año actual');
                $('#mensajeFechaLanzamiento').css('color','red');
                $('#guardarCambios').attr('disabled',true);
            } else {
                $('#mensajeFechaLanzamiento').hide();
                $('#guardarCambios').attr('disabled',false);
            }
        });
    });
// Para validar la Fecha de Lanzamiento
//---------------------------------------------------------------------------------------------------
// Para validar el precio
    $(document).ready(function(){
        $('#precio').keyup(function(evento) {
            var precio = $('#precio').val();
            if (precio>999) {
                $('#mensajePrecio').show();
                $('#mensajePrecio').text('El costo de tickets no deben exceder los 999 Tickets');
                $('#mensajePrecio').css('color','red');
                $('#guardarCambios').attr('disabled',true);
            } else if (precio<0) {
                $('#mensajePrecio').show();
                $('#mensajePrecio').text('El costo de tickets debe ser mayor a 0');
                $('#mensajePrecio').css('color','red');
                $('#guardarCambios').attr('disabled',true);
            } else {
                $('#mensajePrecio').hide();
                $('#guardarCambios').attr('disabled',false);
            }
        });
    });
// Para validar el precio
//---------------------------------------------------------------------------------------------------
// Para validar los radio boton
    $(document).ready(function(){
        console.log($('#saga').val() );
        if($('#saga').val() != ''){
        $('#option-1').prop('checked','checked');
        $('#if_si').show();
        $('#sagas').attr('required','required');
        $('#despues').attr('required','required');
        $('#antes').attr('required','required');
        $('#sagas').val('');
        }else{
          $('#option-2').prop('checked','checked'); 
          $('#if_si').hide();
          $('#sagas').removeAttr('required');
          $('#despues').removeAttr('required');
          $('#antes').removeAttr('required');
          $('#sagas').val(''); 
        }
    });

    function yesnoCheck() {
        if (document.getElementById('option-1').checked) {
            $('#if_si').show();
            $('#sagas').attr('required','required');
            $('#despues').attr('required','required');
            $('#antes').attr('required','required');
            $('#sagas').val('');
        } else {
            $('#if_si').hide();
            $('#sagas').removeAttr('required');
            $('#despues').removeAttr('required');
            $('#antes').removeAttr('required');
            $('#sagas').val('');
        }
    }
// Para validar los radio boton
//---------------------------------------------------------------------------------------------------
// Para validar los capitulos de las sagas
    $(document).ready(function(){
        $('#despues').keyup(function(evento) {
            var despues = $('#despues').val();
            if (despues<0) {
                $('#mensajeDespues').show();
                $('#mensajeDespues').text('El Número de la Saga debe ser mayor a cero');
                $('#mensajeDespues').css('color','red');
                $('#guardarCambios').attr('disabled',true);
            } else {
                $('#mensajeDespues').hide();
                $('#guardarCambios').attr('disabled',false);
            }
        });
    });
    $(document).ready(function(){
        $('#antes').keyup(function(evento) {
            var antes = $('#antes').val();
            if (antes<0) {
                $('#mensajeAntes').show();
                $('#mensajeAntes').text('El Número de la Saga debe ser mayor a cero');
                $('#mensajeAntes').css('color','red');
                $('#guardarCambios').attr('disabled',true);
            } else {
                $('#mensajeAntes').hide();
                $('#guardarCambios').attr('disabled',false);
            }
        });
    });
// Para validar los capitulos de las sagas
//---------------------------------------------------------------------------------------------------
/*
        $('.select-author').chosen({
            allow_single_deselect: false,
            no_results_text: "Registra el autor ya que no se encuentra en la base de datos y registrar el libro se necesita el autor",
            width: "60%"
        });

        $('.select-saga').chosen({
            allow_single_deselect: true,
            no_results_text: "No se encuentra la saga",
            width: "60%"
        });

        $('#paises').chosen({
            allow_single_deselect: true,
            no_results_text: "No se encuentra la saga",
            width: "60%"
        });
*/
    </script>

    {{--manejo de la imager precargada--}}
    <script>
/*
        $(document).ready(function () {
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label"
            });
        });
*/
    </script>

    {{--la funcion de la saga--}}
    <script>
/*
        function yesnoCheck() {
            if (document.getElementById('option-1').checked) {
                $('#if_si').show();
                $('#sagas').val('');
            }
            // else if(document.getElementById('option-2').checked) {
            //     $('#if_no').hide();
            //     $('#sagas').val('3');
            // }
            else {
                $('#if_si').hide();
                $('#sagas').val('');
            }

        }
*/
    </script>

    {{--Date picker--}}
    <script>
/*
        $('#datepicker').datepicker({
            autoclose: true,
            language: 'es'
        })
*/
    </script>

    {{--imagen del model de autores --}}
    <script>
/*
        $(document).ready(function () {
            $.uploadPreview({
                input_field: "#imageAM-upload",
                preview_box: "#imageAM-preview",
                label_field: "#imageAM-label"
            });
        });
*/
    </script>

    {{--imagen del model de sagas --}}
    <script>
/*
        $(document).ready(function () {
            $.uploadPreview({
                input_field: "#imageSM-upload",
                preview_box: "#imageSM-preview",
                label_field: "#imageSM-label"
            });
        });
*/
    </script>

@endsection