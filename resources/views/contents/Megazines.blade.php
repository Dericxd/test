@extends('layouts.app')

@section('css')
<style class="cp-pen-styles">
    @import url("https://fonts.googleapis.com/css?family=Arimo:400,700");
    * {
      -webkit-transition: 300ms;
      transition: 300ms;
    }

    /*.btn-circle {*/
      /*width: 30px;*/
      /*height: 30px;*/
      /*text-align: center;*/
      /*padding: 6px 0;*/
      /*font-size: 12px;*/
      /*line-height: 1.428571429;*/
      /*border-radius: 15px;*/
    /*}*/
    /*.btn-circle.btn-lg {*/
      /*width: 50px;*/
      /*height: 50px;*/
      /*padding: 10px 16px;*/
      /*font-size: 18px;*/
      /*line-height: 1.33;*/
      /*border-radius: 25px;*/
    /*}*/
    /*.btn-circle.btn-xl {*/
      /*width: 70px;*/
      /*height: 70px;*/
      /*padding: 10px 16px;*/
      /*font-size: 24px;*/
      /*line-height: 1.33;*/
      /*border-radius: 35px;*/
    /*}*/


    ul {
      list-style-type: none;
    }

    h1, h2, h3, h4, h5, p {
      font-weight: 400;
    }

    a {
      text-decoration: none;
      color: inherit;
    }

    a:hover {
      color: #6ABCEA;
    }

    .movie-card {
      background: #ffffff;
      box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 315px;
      margin: 2em;
      border-radius: 10px;
      display: inline-block;
    }

    .movie-header {
      padding: 0;
      margin: 0;
      height: 100%;
      width: 100%;
      display: block;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
    }

    .header-icon-container {
      position: relative;
    }

    .movie-card:hover {
      -webkit-transform: scale(1.03);
      transform: scale(1.03);
      box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.08);
    }

    .movie-content {
      padding: 18px 18px 24px 18px;
      margin: 0;
    }

    .movie-content-header, .movie-info {
      display: table;
      width: 100%;
    }

    .movie-title {
      font-size: 15px;
      margin: 0;
      display: table-cell;
      word-break: break-all;
    }

    .info-section label {
      display: block;
      color: rgba(0, 0, 0, 0.5);
      margin-bottom: .5em;
      font-size: 9px;
    }

    .info-section span {
      font-weight: 700;
      font-size: 11px;
    }

    @media screen and (max-width: 500px) {
      .movie-card {
        width: 100%;
        max-width: 100%;
        margin: 1em;
        display: block;
      }
    }
    .colorbadge{
            background-color:#428bca;
        }
  </style>
@endsection

@section('main')  

<div class="row">
    <div class="form-group"> 
        <div class="row-edit">
            <div class="col-md-12 col-sm-12 mb">
            	<div class="control-label">
            		<div class="white-header">
            			<div class="col-sm-12 col-xs-12 col-md-12">
            				<h3><span class="card-title"><i class="fa fa-angle-right"> Revistas</i></span></h3> 
            				<form method="POST"  id="SaveSong" action="{{url('SearchProfileMegazine')}}">{{ csrf_field() }}
                    			<input id="seach" name="seach" type="text" placeholder="Buscar" class="form-control" style="margin-bottom: 2%;">
                    			<button class="btn btn-primary active" type="submit" name="buscar" id="buscar">Buscar...</button>
       						</form>
       						<div  class="col-sm-12 col-xs-12 col-md-12" id="principal">
       						{{  $Megazines->links() }}
       						</div>
       						@if($Megazines != null)
                			<!-- PROFILE 01 PANEL -->
                			
                			@foreach($Megazines as $megazines)

                			<div class="col-lg-3 col-md-3 col-sm-3 mb" style="margin-top: 2%">
                    			<div class="movie-card" style="  border-radius: 10px;">
                        			<div id="movie-header" style="">
                                <a href="#" data-toggle="modal" data-target="#myModal-{{$megazines->id}}" style="color: #ffff">
                            		@if($megazines->cover)
                                		<img src="{{asset($megazines->cover)}}" width="100%" height="220" style="">
                            		@else
                                		<img src="#" width="100%" height="220" style="">
                            		@endif
                                </a>  
                        			</div>
                        			<!-- <div class="profile-01 centered">
                            			<p><a href="#" data-toggle="modal" data-target="#myModal-{{$megazines->id}}" style="color: #ffff">Ver mas</p></a>
                        			</div> -->
                        			<div class="movie-content">
                            			<center><h3>{{$megazines->title}}</h3></center>
                                  <h6> <b>Géneros:</b>
                                        @foreach($megazines->tags_megazines as $t)
                                            <span class="badge badge-light colorbadge"> {{ $t->tags_name }} </span>
                                        @endforeach
                                  </h6>
                                  <h6><b>Costo:</b> {{$megazines->cost}} tickets</h6>
                            			<center><a href="#" class=""  id="modal-confir.{{$megazines->id}}" onclick="fnOpenNormalDialog('{!!$megazines->cost!!}','{!!$megazines->title!!}','{!!$megazines->id!!}')"><b>Adquirir</b></a></p></center>
                            		<!-- <p class="sinopsis"><b>Sinopsis:</b>{{$megazines->sinopsis}}</p> -->
                        			</div>
                    			</div><!--/content-panel -->
                			</div><!--/col-md-4 -->
                			<!--MODAL-->
								 <div id="myModal-{{$megazines->id}}" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">{{$megazines->title}}</h4>
                                        </div>
                                        <div class="modal-body">
                                        	<div id="panel" class="img-rounded img-responsive av text-center col-lg-12 col-md-12 col-sm-12 mb" style="-webkit-box-shadow: 8px 8px 15px #999;
            									-moz-box-shadow: 8px 8px 15px #999;
            									filter: shadow(color=#999999, direction=135, strength=8);
            									/*Para la Sombra*/
            									background-image: url('{{asset($megazines->cover)}}');
            									margin-top: 5%;
            									background-position: center center;
            									width: 100%;
            									min-height: 150px;
            									-webkit-background-size: 100%;
            									-moz-background-size: 100%;
            									-o-background-size: 100%;
            									background-size: 100%;
            									-webkit-background-size: cover;
            									-moz-background-size: cover;
            									-o-background-size: cover;
            									background-size: cover;">
            									<button type="button" class="btn btn-primary" data-dismiss="modal"   id="modal-confir" style="margin-left: 87%" onclick="fnOpenNormalDialog('{!!$megazines->cost!!}','{!!$megazines->title!!}','{!!$megazines->id!!}')">Adquirir</button>
                    						</div>
                    						<div class="col-lg-12 col-md-12 col-sm-12 mb">
                    							<p class="sinopsis"><h5><b>Descripción:</b></h5>
                    							{{ $megazines->descripcion }}</p>
                                
                    							
                    						</div>

                    						<div class="box-footer no-padding">
                    							<div class="col-md-8 col-sm-8 col-lg-12">
                    							<h5><b>Costo:</b> {{$megazines->cost}}</h5>
                        						<h5><b> Categoría:</b> <span class="label label-success"> {{ $megazines->rating->r_name }} </span> </h5>
                                    <h5> <b>Géneros:</b>
                                        @foreach($megazines->tags_megazines as $t)
                                            <span class="badge badge-light colorbadge"> {{ $t->tags_name }} </span>
                                        @endforeach
                                    </h5>
                            
                        						@if($megazines->sagas!=null)
                                        			<h5><b>Tipo de publicación:</b> {{ $megazines->sagas->sag_name }}</h5>
                                   			 	@else
                                        			<h5><b>Tipo de publicación:</b> Independiente</span></h5>
                                    			@endif
                        						<hr>
                    						</div>
                    							</div>
                    						<div class="">
                                            	<div class="modal-footer">
                                            	
                                              		<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
                                            	</div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <!--Fin modal-->
                			
                			@endforeach
                			 <div  class="col-sm-12 col-xs-12 col-md-12">
       						{{  $Megazines->links() }}
       						</div>
                			@else
                    			<h1>No Posee Revistas</h1>
               				@endif
            			</div>
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>
<div id="modal-confirmation"></div>
@endsection

@section('js')
<script type="text/javascript">

$(document).ready(function(){
	$('#seach').keyup(function(evento){
		$('#buscar').attr('disabled',true);
	});
	$('#buscar').attr('disabled',true);
      $('#seach').autocomplete({
      	source: "SearchMegazine",
      	minLength: 2,
      	select: function(event, ui){		
      		$('#seach').val(ui.item.value);
      		var valor = ui.item.value;
          console.log(ui.item.type);
      		if (valor=='No se encuentra...'){
      			$('#buscar').attr('disabled',true);
      			swal('Autor no se encuentra regitrado','','error');
      		}else{
      			$('#buscar').attr('disabled',false);
      		}
      	}

   });
  });
</script>

<script>
function fnOpenNormalDialog(cost,name,id) {
  
   swal({
            title: "Estas seguro?",
            text: '¿Desea comprar '+name+' con un valor de '+cost+' tickets?', 
            icon: "warning",
            buttons:  ["Cancelar", "Adquirir"],
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            callback(true,id);
           
          } else {
            callback(false,id);
          }
        });
    };

function callback(value,id) {
    if (value) {
      swal({
                title: 'Procesando..!',
                text: 'Por favor espere..',
                buttons: false,
                closeOnEsc: false,
                onOpen: () => {
                    swal.showLoading()
                }
            })
         $.ajax({
                    
            url:'BuyMagazines/'+id,
            type: 'POST',
            data: {
            _token: $('input[name=_token]').val()
             },
                    
             success: function (result) 
                {


                   if (result==0) 
                    { 
                       swal('No posee suficientes creditos, por favor recargue','','error');  
                       console.log(result);
                    }
                    else if (result==1) 
                    {
                      swal('La revista ya forma parte de su colección','','error');
                    }
                    else
                    {	
                    var idUser={!!Auth::user()->id!!};
                    $.ajax({ 
                
                      url     : 'MyTickets/'+idUser,
                      type    : 'GET',
                      dataType: "json",
                      success: function (respuesta){
                      console.log(respuesta);
                        $('#Tickets').html(respuesta);
                  
                      },
                    });
                    	swal('Revista comprada con exito','','success');
                  		 console.log(result);
                  	}	 
                },
              error: function (result) 
                {
                      
                }

            });
    } else {
        return false;
    }
}
</script>
@endsection