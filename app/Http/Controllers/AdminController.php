<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusApplys;
use App\Mail\PromoterAssing;
use App\Mail\StatusMovies;
use App\Mail\StatusSeller;
use App\Events\ContentAprovalEvent;
use App\Events\ContentDenialEvent;
use App\Events\PayementAprovalEvent;
use App\Events\PaymentDenialEvent;
use App\Events\PasswordPromoter;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Collection;
use App\Events\AssingPointsEvents;
use App\Events\UserValidateEvent;
use File;

//-------------Modelos del sistema-----------------------
use App\Megazines;
use App\Tags;
use App\ApplysSellers;
use App\Albums;
use App\Serie;
use App\Songs;
use App\User;
use App\Seller;
use App\Radio;
use App\Sagas;
use App\BookAuthor;
use App\Book;
use App\Tv;
use App\music_authors;
use App\SellersRoles;
use App\Promoters;
use App\LoginControl;
use App\Salesman;
use App\PromotersRoles;
use App\TicketsPackage;
use App\Payments;
use App\Referals;
use App\PointsAssings;
use App\SistemBalance;
use App\Movie;
use App\Rating;

//--------------------------------------------------------

class AdminController extends Controller
{
	 

    public function SendEmails($status,$name,$seller,$reason)
    {
      if ($status =='Aprobado') 
        {
          event(new ContentAprovalEvent($name,$seller));
        }
        else
        {
          event(new ContentDenialEvent($name,$seller,$reason));
        }

        return true;
    }

/* 
-----------------------------------------------------------------
--------------------- FUNCIONES DE APROBAR ALBUM ----------------------
---------------------------------------------------------------
*/
    	public function ShowAlbums()
    	{	
    		  return view('promoter.ContentModules.MainContent.Albums');
   		}

      public function AlbumsDataTable()
      {
          
        $albums= Albums::where('status','=','En Revision');

          return Datatables::of($albums)
                    ->addColumn('Estatus',function($albums){
                      
                      return '<button type="button" class="btn btn-theme" value='.$albums->id.' data-toggle="modal" data-target="#myModal" id="Status">'.$albums->status.'</button>';
                    })

                    ->addColumn('Autors_name',function($albums){
                      
                      return $albums->Seller()->first()->name;
                    })

                    ->addColumn('songs',function($albums){
                      
                      return '<button type="button" class="btn btn-theme" value="'.$albums->id.'" id="songs" >'.$albums->songs()->count().'</button';
                    })                    

                    ->editColumn('autors_id',function($albums){

                      return $albums->Autors()->first()->name;
                    })

                    ->editColumn('cover',function($albums){
                      

                      return '<img class="img-rounded img-responsive av" src="'.$albums->cover.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="cover">';
                    })
                    ->rawColumns(['Estatus','cover','songs'])
                    ->toJson();        
      }

      public function ShowAllAlbums()
      {
        $albums= Albums::where('status','=','Aprobado')->paginate(10);
        return view('admin.AllAlbums')->with('albums',$albums);
      }

   		public function AlbumSongs($id)
   		{
   			$albums= Albums::find($id);
   			$data= $albums->songs()->get();
   			return response()->json($data);
   		}

   		public function AlbumStatus(Request $request,$id)
   		{
   			$albums = Albums::find($id);
        $albums->status = $request->status;
        
          foreach ($albums->songs as $track) 
          {
            $track->status = 'Aprobado';
            $track->save();
          }

       $this->SendEmails($request->status,$albums->name_alb,$albums->Seller->email,$request->reazon);
			  
        $albums->save();
   			return response()->json($albums);
   		}
/*------------------------------------------------------------------------------------ ---------------------FUNCIONES DE SINGLE------------------------------
-----------------------------------------------------------------------
*/
   		public function ShowSingles()
    	{	
        return view('promoter.ContentModules.MainContent.Single');
   		}

      public function SinglesDataTable()
      {
         $Single= Songs::whereNull('album')->where('status','=','En Revision')->get();

                 return Datatables::of($Single)
                    ->addColumn('Estatus',function($Single){
                      
                      return '<button type="button" class="btn btn-theme" value='.$Single->id.' data-toggle="modal" data-target="#myModal" id="Status">'.$Single->status.'</button';
                    })

                    ->addColumn('Autors_name',function($Single){
                      
                      return $Single->Seller()->first()->name;
                    })                    

                    ->editColumn('autors_id',function($Single){

                      return $Single->autors()->first()->name;
                    })

                    ->editColumn('song_file',function($Single){
                      

                      return '<audio controls="" src="'.$Single->song_file.'">
                                <source src="'.$Single->song_file.'" type="audio/mpeg">
                                </audio>';
                    })
                    ->rawColumns(['Estatus','photo','song_file'])
                    ->toJson();
      }

      public function ShowAllSingles()
      {
        $single= Songs::whereNull('album')->paginate(10);
        return view('admin.Single')->with('single',$single);
      }

   		public function SingleStatus(Request $request,$id)
   		{
   			$Single =Songs::find($id);
   			$Single->status = $request->status;

        $this->SendEmails($request->status,$Single->song_name,$Single->Seller->email,$request->reason);

			  $Single->save();
   			return response()->json($Single);
   		}

/*-------------------------------------------------------------------------
-----------------FUNCIONES DE ARTISTAS MUSICALES---------------------------
---------------------------------------------------------------------------
*/

   		public function ShowMusicianView()
    	{
    		return view('promoter.ContentModules.ExtraContent.Musician');
   		}

      public function MusicianDataTable()
      {
      
        $Musician = music_authors::where('status','=','En Proceso')
                              ->with('Seller')
                              ->get();



        return Datatables::of($Musician)
                    ->addColumn('Estatus',function($Musician){
                      
                      return '<button type="button" class="btn btn-theme" value='.$Musician->id.' data-toggle="modal" data-target="#MusicianModal" id="Status">'.$Musician->status.'</button';
                    })
                    
                    ->addColumn('SocialMedia',function($Musician){
                      
                      return 
                      '<a target="_blank" href="http://'.$Musician->facebook.'>
                       <i class="fa fa-facebook-official" style="font-size:24px"></i>
                       </a>
                       <a target="_blank" href="http://'.$Musician->google.'">
                        <i class="fa fa-youtube-play" style="font-size:36px"></i>
                       </a>
                       <a target="_blank" href="http://'.$Musician->instagram.'">
                         <i class="fa fa-instagram" style="font-size:36px"></i>
                       </a>
                       <a target="_blank" href="http://'.$Musician->twitter.'">
                        <i class="fa fa-twitter" style="font-size:36px"></i>
                       </a>';
                    })
                    
                    ->editColumn('photo',function($Musician){

                      return '<img class="img-rounded img-responsive av" src="'.asset($Musician->photo).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->rawColumns(['Estatus','photo','SocialMedia'])
                    ->toJson();
      }

      public function ShowAllMusician()
      {
       
       $Musician = music_authors::where('status','=','Aprobado')
                              ->with('Seller')
                              ->get();



        return Datatables::of($Musician)
                    ->addColumn('Estatus',function($Musician){
                      
                      return '<button type="button" class="btn btn-theme" value='.$Musician->id.' data-toggle="modal" data-target="#MusicianModal" id="Status">'.$Musician->status.'</button';
                    })
                    
                    ->addColumn('SocialMedia',function($Musician){
                      
                      return 
                      '<a target="_blank" href="http://'.$Musician->facebook.'>
                        <i class="fas fa-facebook-square fa-3x">
                       </a>
                       <a target="_blank" href="http://'.$Musician->google.'">
                        <i class="fas fa-youtube fa-3x"></i>
                       </a>
                       <a target="_blank" href="http://'.$Musician->instagram.'">
                         <i class="fas fa-instagram fa-3x"></i>
                       </a>
                       <a target="_blank" href="http://'.$Musician->twitter.'">
                        <i class="fas fa-twitter fa-3x"></i>
                       </a>';
                    })
                    
                    ->editColumn('photo',function($Musician){

                      return '<img class="img-rounded img-responsive av" src="'.asset($Musician->photo).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->rawColumns(['Estatus','photo','SocialMedia'])
                    ->toJson();
      }

   		public function MusicianStatus(Request $request,$id)
   		{
   			$musician =music_authors::find($id);
   			$musician->status = $request->status; 

        $this->SendEmails($request->status,$musician->name,$musician->Seller->email,$request->reaon);

			  $musician->save();
   			return response()->json($musician);
   		}

/*---------------------------------------------------------------------
---------------------------FUNCIONES DE RADIOS--------------------------
-----------------------------------------------------------------------
*/   		
  
   		public function ShowRadios()
    	{
        return view('promoter.ContentModules.MainContent.Radio');
   		}

      public function RadioDataTable()
      {
        $radios= Radio::where('status','=','En Proceso')->with('Seller')->get();

         return Datatables::of($radios)

                          ->addColumn('Estatus',function($radios){

                            return '<button type="button" class="btn btn-theme" value='.$radios->id.' data-toggle="modal" data-target="#myModal" id="status">'.$radios->status.'</button';
                          })
                          ->editColumn('logo',function($radios){

                          return '<img class="img-rounded img-responsive av" src="'.asset($radios->logo).'"
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                          })
                          ->editColumn('streaming',function($radios){
                      

                          return '<audio controls="" src="'.$radios->streaming.'">
                                    <source src="'.$radios->streaming.'" type="audio/mpeg">
                                    </audio>';
                         })
                          ->addColumn('SocialMedia',function($radios){
                      
                            return 
                            '
                             <a target="_blank" href="http://'.$radios->facebook.'>
                              <i class="fa fa-facebook-official" style="font-size:24px"><i class="fa fa-facebook" style="font-size:24px"></i></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->google.'">
                              <i class="fa fa-youtube-play" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->instagram.'">
                               <i class="fa fa-instagram" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->twitter.'">
                              <i class="fa fa-twitter" style="font-size:36px"></i>
                             </a>';
                    })
                          ->rawColumns(['Estatus','logo','streaming','SocialMedia'])
                          ->toJson();
      }

      public function BackendRadioData()
      {
        $radios= Radio::where('seller_id','=',0)->get();

         return Datatables::of($radios)

                          ->addColumn('Actions',function($radios){

                            return '<button type="button" class="btn-danger" value='.$radios->id.' data-toggle="modal" data-target="#DeleteRadio" id="delete">Eliminar</button>

                            <button type="button" class="btn btn-theme" value='.$radios->id.' data-toggle="modal" data-target="#UpadeRadio" id="edit">Modificar</button';
                          })
                          ->editColumn('logo',function($radios){

                          return '<img class="img-rounded img-responsive av" src="'.asset($radios->logo).'"
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                          })
                          ->editColumn('streaming',function($radios){
                      

                          return '<audio controls="" src="'.$radios->streaming.'">
                                    <source src="'.$radios->streaming.'" type="audio/mpeg">
                                    </audio>';
                         })
                          ->addColumn('SocialMedia',function($radios){
                      
                            return 
                            '<a target="_blank" href="http://'.$radios->facebook.'>
                              <i class="fa fa-facebook-official" style="font-size:24px"><i class="fa fa-facebook" style="font-size:24px"></i></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->google.'">
                              <i class="fa fa-youtube-play" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->instagram.'">
                               <i class="fa fa-instagram" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$radios->twitter.'">
                              <i class="fa fa-twitter" style="font-size:36px"></i>
                             </a>';
                    })
                          ->rawColumns(['Actions','logo','streaming','SocialMedia'])
                          ->toJson();

      }

      public function NewBackendRadios(Request $request)
      {
        $Radio = new Radio;
        
            $file = $request->file('logo');
            $name = 'radiologo_' . time() . '.'. $file->getClientOriginalExtension();
            $path = public_path(). '/images/radio/';
            $file->move($path, $name);
            $logos = '/images/radio/'.$name;

        $Radio->seller_id = 0;

        $Radio->name_r = $request->name_r;
        
        $Radio->streaming = $request->streaming;
        
        $Radio->email_c = $request->email_c;
        
        $Radio->google = $request->youtube;
        
        $Radio->instagram = $request->instagram;
        
        $Radio->facebook = $request->facebook;
        
        $Radio->twitter = $request->twitter;
        
        $Radio->logo = $logos;

        $Radio->status ='Aprobado';
        
        $Radio->save();

        return redirect()->action('AdminController@ShowRadios');

      }

      public function DeleteBackendRadio($id)
      {
        $radios = Radio::destroy($id);
        return response()->json($radios);
      }

      public function GetBackendRadio($id)
      {
        $radios = Radio::find($id);
        $radios->logo = asset($radios->logo);
        return response()->json($radios);
      }

      public function UpdateBackendRadio(Request $request,$id)
      {
        $Radio= Radio::find($id);
        //dd($request->all());
        if($request->logo_u != null)
        {
            
            $file = $request->file('logo_u');
            $name = 'radiologo_' . time() . '.'. $file->getClientOriginalExtension();
            $path = public_path(). '/images/radio/';
            $file->move($path, $name);
          
            $Radio->logo = '/images/radio/'.$name;
         }         

        $Radio->name_r = $request->name_r_u;
        
        $Radio->streaming = $request->streaming_u;
        
        $Radio->email_c = $request->email_c_u;
        
        $Radio->google = $request->youtube_u;
        
        $Radio->instagram = $request->instagram_u;
        
        $Radio->facebook = $request->facebook_u;
        
        $Radio->twitter = $request->twitter_u;
        
        $Radio->save();

        return redirect()->action('AdminController@ShowRadios');
      }

      public function ShowAllRadios()
      {
        $radios= Radio::paginate(10);
        return view('admin.Radio')->with('radios',$radios);
      }

   		public function RadioStatus(Request $request,$id)
   		{
   			$radios =Radio::find($id);
   			$radios->status = $request->status; 
          
          $this->SendEmails($request->status,$radios->name,$radios->Seller->email);

			  $radios->save();
   			return response()->json($radios);
   		}

/*--------------------------------------------------------------------------
-----------------------------FUNCIONES DE REVISTAS----------- --------------
----------------------------------------------------------------------------
*/
   		public function ShowMegazine()
    	{
        return view('promoter.ContentModules.MainContent.Megazine');
   		}

      public function MegazineDataTable()
      {
        $megazines= Megazines::where('status','=','En Revision')->get();

        return Datatables::of($megazines)
                    ->addColumn('Estatus',function($megazines){
                      
                      return '<button type="button" class="btn btn-theme" value='.$megazines->id.' data-toggle="modal" data-target="#myModal" id="status">'.$megazines->status.'</button';
                    })
                    ->editColumn('megazine_file',function($megazines){

                      return '<button type="button" class="btn btn-theme" value='.$megazines->megazine_file.' data-toggle="modal" data-target="#file" id="file_b"></button';
                    })
                    ->editColumn('cover',function($megazines){

                      return '<img class="img-rounded img-responsive av" src="'.asset($megazines->cover).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->editColumn('saga_id',function($megazines){
                      
                      if($megazines->saga_id == 0 or $megazines->saga_id == 'NULL')
                          {
                            return 'No';
                          }
                          else
                          {
                            return $megazines->sagas()->first()->sag_name;
                          }
    
                    
                    })
                    ->editColumn('rating_id',function($megazines){

                    return $megazines->Rating()->first()->r_name;

                    })
                    ->editColumn('seller_id',function($megazines){

                    return $megazines->Seller()->first()->name;

                    })
                    ->rawColumns(['Estatus','megazine_file','cover'])
                    ->toJson();

      }

      public function ShowAllMegazine()
      {
        $megazines= Megazines::paginate(10);
        return view('admin.Megazine')->with('megazines',$megazines);
      }      

   		public function ShowPublicationChain()
    	{
    		
        $saga = Sagas::where('status','=','En Proceso')->where('type_saga','=','Revistas')->get();

        return Datatables::of($saga)
                    ->addColumn('Estatus',function($saga){
                      
                      return '<button type="button" class="btn btn-theme" value='.$saga->id.' data-toggle="modal" data-target="#PubModal" id="Status">'.$saga->status.'</button';
                    })
                    ->editColumn('img_saga',function($saga){

                      return '<img class="img-rounded img-responsive av" src="'.asset($saga->img_saga).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->editColumn('seller_id',function($saga){

                      return $saga->Seller()->first()->name;
                    })
                    ->editColumn('rating_id',function($saga){

                      return $saga->Rating()->first()->r_name;
                    })
                    ->rawColumns(['Estatus','img_saga'])
                    ->toJson();

    		
   		}

      public function ShowAllPublicationChain()
      {
        $saga = Sagas::where('type_saga','=','Revistas')->paginate(10);
        return view('admin.PubChain')->with('sagas',$saga);
      }

   		public function PublicationChainStatus(Request $request,$id)
    	{
    		$saga = Sagas::find($id);
	   		$saga->status = $request->status;

        $this->SendEmails($request->status,$saga->sag_name,$saga->seller->email,$request->message);

			  $saga->save();
   			return response()->json($saga);
   		}

   		public function MegazineStatus(Request $request,$id)
    	{
			  $megazines = Megazines::find($id);
	   		$megazines->status = $request->status; 

        $this->SendEmails($request->status,$megazines->title,$megazines->Seller->email,$request->message);        

			  $megazines->save();
   			return response()->json($megazines);
   		}
 
 /*-----------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE TV---- ----------- ----------
------------------------------------------------------------------------
*/ 		
   		
	   	public function ShowTV()
    	{
    		return view('promoter.ContentModules.MainContent.Tv');
   		}

      public function DataTableTv()
      {
        $tv= Tv::where('status','=','En Proceso')->get();

        return Datatables::of($tv)

                          ->addColumn('Estatus',function($tv){

                            return '<button type="button" class="btn btn-theme" value='.$tv->id.' data-toggle="modal" data-target="#myModal" id="status">'.$tv->status.'</button';
                          })
                          ->editColumn('logo',function($tv){
                            /* solucion en produccion
                            $ruta  = "leipel.com".$tv->logo;
                            dd($ruta);

                          return '<img class="img-rounded img-responsive av" src='.$ruta.'
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                          })
                          */
                          return '<img class="img-rounded img-responsive av" src='.asset($tv->logo).'
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                          })
                          ->editColumn('streaming',function($tv){
                      

                          return '<button type="button" class="btn btn-theme" value='.$tv->streaming.' data-toggle="modal" data-target="#ShowStreaming" id="view">Ver</button';
                         })
                          ->addColumn('SocialMedia',function($tv){
                      
                            return 
                            '<a target="_blank" href="http://'.$tv->facebook.'>
                             <i class="fa fa-facebook-official" style="font-size:24px"></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->google.'">
                              <i class="fa fa-youtube-play" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->instagram.'">
                               <i class="fa fa-instagram" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->twitter.'">
                              <i class="fa fa-twitter" style="font-size:36px"></i>
                             </a>';
                    })
                          ->rawColumns(['Estatus','logo','streaming','SocialMedia'])
                          ->toJson();
      }

      public function BackendTvData()
      {
        $tv= Tv::where('seller_id','=',0)->get();

         return Datatables::of($tv)

                          ->addColumn('Actions',function($tv){

                            return '<button type="button" class="btn-danger" value='.$tv->id.' data-toggle="modal" data-target="#DeleteRadio" id="delete">Eliminar</button>

                            <button type="button" class="btn btn-theme" value='.$tv->id.' data-toggle="modal" data-target="#UpadeRadio" id="edit">Modificar</button';
                          })
                          ->editColumn('logo',function($tv){
                            /*
                            produccion
                            $ruta  = "https://leipel.com/".$tv->logo;
                            return '<img class="img-rounded img-responsive av" src='.$ruta.'
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                            })
                            */

                          return '<img class="img-rounded img-responsive av" src="'.asset($tv->logo).'"
                                     style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                          })
                          ->editColumn('streaming',function($tv){
                      

                          return '<button type="button" class="btn btn-theme" value='.$tv->streaming.' data-toggle="modal" data-target="#ShowStreaming" id="view">Ver</button';
                          
                         })
                          ->addColumn('SocialMedia',function($tv){
                      
                            return 
                            '<a target="_blank" href="http://'.$tv->facebook.'>
                              <i class="fa fa-facebook-official" style="font-size:24px"><i class="fa fa-facebook" style="font-size:24px"></i></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->google.'">
                              <i class="fa fa-youtube-play" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->instagram.'">
                               <i class="fa fa-instagram" style="font-size:36px"></i>
                             </a>
                             <a target="_blank" href="http://'.$tv->twitter.'">
                              <i class="fa fa-twitter" style="font-size:36px"></i>
                             </a>';
                    })
                          ->rawColumns(['Actions','logo','streaming','SocialMedia'])
                          ->toJson();

      }

       public function NewBackendTv(Request $request)
      {
        $Tv = new Tv;
        
            $file = $request->file('logo');
            $name = 'Tvlogo_' . time() . '.'. $file->getClientOriginalExtension();
            $path = public_path(). '/images/Tv/';
            $file->move($path, $name);
            $logos = '/images/Tv/'.$name;

        $Tv->seller_id = 0;

        $Tv->name_r = $request->name_r;
        
        $Tv->streaming = $request->streaming;
        
        $Tv->email_c = $request->email_c;
        
        $Tv->google = $request->youtube;
        
        $Tv->instagram = $request->instagram;
        
        $Tv->facebook = $request->facebook;
        
        $Tv->twitter = $request->twitter;
        
        $Tv->logo = $logos;

        $Tv->status ='Aprobado';
        
        $Tv->save();

        return redirect()->action('AdminController@ShowTV');

      }

      public function DeleteBackendTv($id)
      {
        $Tv = Tv::destroy($id);
        return response()->json($Tv);
      }

      public function GetBackendTv($id)
      {
        $Tv = Tv::find($id);
        $Tv->logo = asset($Tv->logo);
        return response()->json($Tv);
      }

      public function UpdateBackendTv(Request $request,$id)
      {
        $Tv= Tv::find($id);
        //dd($request->all());
        if($request->logo_u != null)
        {
            
            $file = $request->file('logo_u');
            $name = 'radiologo_' . time() . '.'. $file->getClientOriginalExtension();
            $path = public_path(). '/images/Tv/';
            $file->move($path, $name);
          
            $Tv->logo = '/images/Tv/'.$name;
         }         

        $Tv->name_r = $request->name_r_u;
        
        $Tv->streaming = $request->streaming_u;
        
        $Tv->email_c = $request->email_c_u;
        
        $Tv->google = $request->youtube_u;
        
        $Tv->instagram = $request->instagram_u;
        
        $Tv->facebook = $request->facebook_u;
        
        $Tv->twitter = $request->twitter_u;
        
        $Tv->save();

        return redirect()->action('AdminController@ShowTV');
      }


      public function ShowAllTV()
      {
        $tv= TV::paginate(10);
        return view('admin.TV')->with('TVS',$tv);
      }

   		public function TvStatus(Request $request,$id)
   		{
   			$tv =TV::find($id);
   			$tv->status = $request->status;

        $this->SendEmails($request->status,$tv->name_r,$tv->Seller->email);

			  $tv->save();
   			return response()->json($tv);
   		}

/*--------------------------------------------------------------------------------
-----------------------FUNCIONES DE LIBROS-----------------------------------
-----------------------------------------------------------------------
*/   		
  public function ShowBooks()
  {
        return view('promoter.ContentModules.MainContent.Books');
  }

  public function BooksDataTable()
  {
    $Books= Book::where('status','=','En Revision')->get();
    return Datatables::of($Books)
                    ->addColumn('Estatus',function($Books){
                      
                      return '<button type="button" class="btn btn-theme" value='.$Books->id.' data-toggle="modal" data-target="#myModal" id="status">'.$Books->status.'</button';
                    })
                    ->editColumn('books_file',function($Books){

                      return '<button type="button" class="btn btn-theme" value='.$Books->books_file.' data-toggle="modal" data-target="#file" id="file_b"></button';
                    })
                    ->editColumn('cover',function($Books){

                      return '<img class="img-rounded img-responsive av" src="'.asset($Books->cover).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->editColumn('saga_id',function($Books){
                      
                      if($Books->saga_id == 0 or $Books->saga_id == 'NULL')
                          {
                            return 'No';
                          }
                          else
                          {
                            return $Books->sagas->sag_name;
                          }
    
                    
                    })
                    ->editColumn('author_id',function($Books){
                      
                        return $Books->author()->first()->full_name;

                    })
                    ->editColumn('rating_id',function($Books){

                    return $Books->rating->r_name;

                    })
                    ->editColumn('seller_id',function($Books){

                    return $Books->seller->name;

                    })
                    ->rawColumns(['Estatus','books_file','cover'])
                    ->toJson();
         
  }

  public function BooksSagasDataTable()
  {
    $saga = Sagas::where('status','=','En Proceso')->where('type_saga','=','Libros')->get();

        return Datatables::of($saga)
                    ->addColumn('Estatus',function($saga){
                      
                      return '<button type="button" class="btn btn-theme" value='.$saga->id.' data-toggle="modal" data-target="#PubModal" id="Status">'.$saga->status.'</button';
                    })
                    ->editColumn('img_saga',function($saga){

                      return '<img class="img-rounded img-responsive av" src="'.asset($saga->img_saga).'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo">';
                    })
                    ->editColumn('seller_id',function($saga){

                      return $saga->Seller()->first()->name;
                    })
                    ->editColumn('rating_id',function($saga){

                      return $saga->Rating()->first()->r_name;
                    })
                    ->rawColumns(['Estatus','img_saga'])
                    ->toJson();
  }

  public function EstatusBooks(Request $request,$id)
  {
        $Book = Book::find($id);
        $Book->status = $request->status; 

        $this->SendEmails($request->status,$Book->title,$Book->seller->email,$request->message);        

        $Book->save();
        return response()->json($Book);
  }

/* 
  ---------------------------------------------------------------
  --------------------- FUNCIONES DE PELICULA -------------------
  ---------------------------------------------------------------
*/
    public function ShowMovies() {
      return view('promoter.ContentModules.MainContent.Movies');
    }

    public function MoviesDataTable($status) {

      $movies = Movie::where('status',$status);
      //$movies = Movie::all();
      return Datatables::of($movies)
        ->editColumn('img_poster',function($movies){
          return "<button href='' data-toggle='modal' data-target='#movieView' value=".$movies->id." id='viewMovie'><img class='img-rounded img-responsive av' src=".asset('movie/poster/').'/'.$movies->img_poster." style='width:70px;height:70px;' alt='Portada'></button>";
        })
        ->addColumn('autor',function($movies){
          return $movies->Seller()->first()->name;
        })
        ->addColumn('title',function($movies){
          return $movies->title;
        })
        ->addColumn('original_title',function($movies){
          return $movies->original_title;
        })
        ->addColumn('sinopsis',function($movies){
          return $movies->based_on;
        })
        ->addColumn('categoria',function($movies){
          return $movies->rating->r_descr;
        })
        ->addColumn('genero',function($movies){
          foreach ($movies->tags_movie as $key) {
            $tags[] = $key->tags_name;
          }
          return $tags;
        })
        ->addColumn('release_year',function($movies){
          return $movies->release_year;
        })
        ->addColumn('created_at',function($movies){
          return $movies->created_at;
        })
        ->addColumn('cost',function($movies){
          return $movies->cost;
        })
        ->addColumn('Estatus',function($movies){
          if ($movies->status=="Aprobado") { $colorBoton = "btn-primary"; }
          else if ($movies->status=="En Proceso") { $colorBoton = "btn-warning"; }
          else if ($movies->status=="Denegado") { $colorBoton = "btn-danger"; }
          return "<button type='button' class='btn ".$colorBoton."' value=".$movies->id." data-toggle='modal' data-target='#myModal' id='status'>".$movies->status."</button>";
        })
        ->rawColumns(['Estatus','img_poster'])
        ->toJson();
    }

    public function MovieStatus(Request $request,$id) {
      $movie = Movie::find($id);
      $email = $movie->seller->email;
      $message = $request->message;
      if ($request->status == 'Aprobado') {
        $movie->status = 1;
      } else {
        $movie->status = 3;
      }
      $movie->save();
      Mail::to($email)->send(new StatusMovies($movie->title,$request->status,$message));
      return response()->json($movie);
    }

    public function viewMovie($id) {
      $movie = Movie::find($id);
      $seller = $movie->seller;
      return response()->json($movie);
    }

/* 
  ---------------------------------------------------------------
  --------------------- FUNCIONES DE PELICULA -------------------
  ---------------------------------------------------------------
*/
/* 
  ---------------------------------------------------------------
  --------------------- FUNCIONES DE SERIE -------------------
  ---------------------------------------------------------------
*/
  public function ShowSeries() {
    return view('promoter.ContentModules.MainContent.Series');
  }

  public function SeriesDataTable() {

      $serie = Serie::all();
      return Datatables::of($serie)
        ->editColumn('img_poster',function($serie){
          return "<img class='img-rounded img-responsive av' src='".asset($serie->img_poster)."' style='width:70px;height:70px;' alt='Portada' id='img_poster'>";
        })
        ->addColumn('autor',function($serie){
          return $serie->Seller()->first()->name;
        })
        ->addColumn('title',function($serie){
          return $serie->title;
        })
        ->addColumn('historia',function($serie){
          return $serie->story;
        })
        ->addColumn('release_year',function($serie){
          return $serie->release_year;
        })
        ->addColumn('trailer',function($serie){
          return "<a href=$serie->trailer target='_blank'>".$serie->trailer."</a>";
        })
        ->addColumn('cost',function($serie){
          return $serie->cost;
        })
        ->addColumn('saga',function($serie){
          if ($serie->saga!=null) {
            $saga = "<button href='' value='".$serie->id."' data-toggle='modal' data-target='#ModalSaga' id='saga' style='display:inline; text-decoration:underline; background:none; background:none;border:0; padding:0; margin:0;'>".$serie->saga->sag_name."</button>";
            //$saga = $serie->saga->sag_name;
          } else {
            $saga = "No tiene saga";
          }
          return $saga;
        })
        ->addColumn('estatusSerie',function($serie){
          return $serie->status_series;
        })
        ->addColumn('Estatus',function($serie){
          return "<button type='button' class='btn btn-theme' value=".$serie->id." data-toggle='modal' data-target='#myModal' id='status'>".$serie->status."</button>";
        })
        ->rawColumns(['Estatus','img_poster','trailer','saga'])
        ->toJson();
  }

  public function sagaSerie($idSerie) {
    $serie = Serie::find($idSerie);
    $saga = $serie->saga;
    return response()->json($saga);
  }
/* 
  ---------------------------------------------------------------
  --------------------- FUNCIONES DE SERIE -------------------
  ---------------------------------------------------------------
*/
 /*---------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------------------------FUNCIONES DE PROVEEDORES----------------------------------
--------------------------------------------------------------------------------------
*/


	   	public function ShowSellers()
    	{
    		$sellers= Seller::paginate(10);
    		
    		$acces_modules=SellersRoles::all();


    		return view('promoter.AdminModules.Sellers')->with('sellers',$sellers)->with('acces_modules',$acces_modules);
   		}

   		public function DeleteModule($id_seller,$id_module)
   		{
   			$seller= Seller::find($id_seller);
 
   			$data = $seller->roles()->detach($id_module);

   		return response()->json($data);
   		
   		}

   		public function AddModule(Request $request,$id)
   		{
   			$seller= Seller::find($id);
   			$data = $seller->roles()->attach($request->acces);

   		 return response()->json($data);
   		
   		}

      public function AddPromoterToSeller(Request $request,$id)
      {
        $seller= Seller::find($id);

        if ($seller->promoter_id == 0) 
        {
            $seller->estatus='Pre-Aprobado';
        }

        $seller->promoter_id=$request->promoter_id;

        $data = $seller->save();

        return response()->json($data);
      }

      public function RemovePromoterFromSeller($id_seller,$id_promoter)
      {
        $seller= Seller::find($id_seller);
        $seller->promoter_id=0;
        $data = $seller->save();
        return response()->json($data); 
      }

      public function AproveOrDenialSeller(Request $request,$id) {
        $seller= Seller::find($id);
        if ($request->status=='Rechazado') {
          //$data=$seller->delete();
          $seller->estatus = 3; // rechazado
        } else {
          $seller->estatus = 2; // aprobado
        }
        $seller->save();
        Mail::to($seller->email)->send(new StatusSeller($request->status,$request->message));
        return response()->json($request->all());
      }
//------------------------- Mostrar Proveedores ---------------------------------
   		
      public function ShowApplys() {
    		//$applys= ApplysSellers::paginate(10);
    		$salesmans = Salesman::all();
    		//return view('promoter.AdminModules.Applys')->with('applys',$applys)->with('salesmans',$Salesmans);
        return view('promoter.AdminModules.Applys')->with('salesmans',$salesmans);
   		}

      public function SellerDataTable($status) {
        $ApplysSellers = ApplysSellers::where('status',$status);
        return Datatables::of($ApplysSellers)
          ->addColumn('nombreComercial',function($ApplysSellers){
            return $ApplysSellers->name_c;
          })
          ->addColumn('nombreContacto',function($ApplysSellers){
            return $ApplysSellers->contact_s;
          })
          ->addColumn('telefono',function($ApplysSellers){
            return $ApplysSellers->phone_s;
          })
          ->addColumn('email',function($ApplysSellers){
            return $ApplysSellers->email;
          })
          ->addColumn('tipo',function($ApplysSellers){
            return $ApplysSellers->desired_m;
          })
          ->addColumn('subTipo',function($ApplysSellers){
            if ($ApplysSellers->sub_desired_m!=NULL) {
              $subTipo = $ApplysSellers->sub_desired_m;
            } else {
              $subTipo = "No aplica";
            }
            return $subTipo;
          })
          ->addColumn('vendedor',function($ApplysSellers){
            if ($ApplysSellers->salesman_id != NULL) {
              return 
              "<span class='mdl-chip mdl-chip--deletable' id='a_".$ApplysSellers->salesman_id."_".$ApplysSellers->id."'>
                <span class='mdl-chip__text' id='promoter_assing'>".$ApplysSellers->Salesman->name."</span> 
                <button type='button' class='mdl-chip__action' value1='".$ApplysSellers->id."' value2='".$ApplysSellers->salesman_id."' name='apply' id='x'> 
                  <i class='material-icons'>cancel</i> 
                </button>
              </span>";
            } else {
              return
              "<button class='mdl-button mdl-js-button mdl-button--fab mdl-button--mini-fab mdl-button--colored' id='add_promoter_to' value='".$ApplysSellers->id."' data-toggle='modal' data-target='#AssingPromoter'>
                <i class='material-icons'>add</i>
              </button>";
            }
          })
          ->addColumn('created_at',function($ApplysSellers){
            return $ApplysSellers->created_at;
          })
          ->addColumn('solicitud',function($ApplysSellers){
            if ($ApplysSellers->status=="Aprobado") { $colorBoton = "btn-primary"; }
            else if ($ApplysSellers->status=="En Proceso") { $colorBoton = "btn-warning"; }
            else if ($ApplysSellers->status=="Denegado") { $colorBoton = "btn-danger"; }
            return "<button type='button' class='mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent btn ".$colorBoton."' value=".$ApplysSellers->id." data-toggle='modal' data-target='#myModal' id='statusApplys'>".$ApplysSellers->status."</button>";
          })
          ->rawColumns(['solicitud','vendedor'])
          ->toJson();
      }

      public function AddSalesMan($idApplySeller, $idSalesman) {
        $applys = ApplysSellers::find($idApplySeller);
        $applys->salesman_id = $idSalesman;
        $applys->save();
        return response()->json($applys); 
      }
//-------------------------------------------------------------------------------

//-----------------------CRUD PROMOTORES------------------------------------

   		public function CreatePromoter(Request $request)
   		{
   			$promoter = new Promoters;
   			
        $promoter->name_c =$request->name_c;
   			
        $promoter->phone_s =$request->phone_s;
   			
        $promoter->email= $request->email_c;

        $promoter->priority = $request->priority;
          
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          
          $charactersLength = strlen($characters);
          
          $randomString = '';
        
              for ($i = 0; $i < 6; $i++) 
                  {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                  }


   			$promoter->password=bcrypt($randomString);

        event( new PasswordPromoter($promoter->email,$randomString));

        $promoter->save();

        $promoter->Roles()->attach($request->priority);   

        return response()->json($promoter);
   		}

   		public function UpdatePromoter(Request $request, $id)
   		{
   			$promoter = Promoters::find($id);
   			$promoter->name_c =$request->name_c;
   			$promoter->phone_s =$request->phone_s;
   			$promoter->email= $request->email_c;
   			$promoter->save();
   			return response()->json($promoter);
   		}

   		public function DeletePromoter($id)
   		{
   			$promoter = Promoters::destroy($id);
   			return response()->json($promoter);
   		}
//-----------------------------------------------------------------------------

  		public function AddSalesmanToApllys(Request $request, $id)
  		{
  			$applys = ApplysSellers::find($id);

        $Salesman = Salesman::find($request->promoter_n);


  			$applys->salesman_id = $Salesman->id;

        $applys->promoter_id = Auth::guard('Promoter')->user()->id;

  			$applys->assing_at = $current = Carbon::now();
       
        Mail::to($applys->email)->subject('Estamos Procesando su Solicitud')->send(new PromoterAssing($applys));

        $applys->save(); 
        
          
        
        			
        return response()->json($applys); 
  		}

  		public function DeleteSalesmanFromApllys($id_apply,$id_promoter)
  		{
  			$applys= ApplysSellers::find($id_apply);
  			$applys->salesman_id= NULL;
  			$applys->save();
  			return response()->json($applys);	
  		}

  		public function StatusApllys($id,Request $request ) {
  			$applys= ApplysSellers::find($id);
  			$applys->status = $request->status;
        if ($request->status == 'Aprobado') {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
  	
  				$applys->token= $randomString;
  			
  				$current = Carbon::now();
  	
  				$applys->expires_at= $current->addDays(7);

          Mail::to($applys->email)->send(new StatusApplys($applys,$request->message));

  				$applys->save();
  				return response()->json($applys);	
  			} else {   
            Mail::to($applys->email)->send(new StatusApplys($applys,$request->message));
            $applys->save();
            return response()->json($applys);
          }	
  		}

      public function DeleteApplysFromPromoter($promoter,$applys)
      {
        $Applys = ApplysSellers::find($applys);
        $Applys->promoter_id = NULL;
        $Applys->save();
        return response()->json($Applys);
      }

      public function ShowBackendUsers()
      {
        

        $promoters= Promoters::paginate()->where('priority','>',Auth::guard('Promoter')->user()->priority);


        $priority= PromotersRoles::all();

        $Salesmans = Salesman::all();
        

        return view('promoter.AdminModules.BackendUsers')
                                            ->with('promoters',$promoters)
                                            ->with('salesmans',$Salesmans)
                                            ->with('priority',$priority);
      }
//------------------SALESMAN CRUD--------------------------------------------
      
      public function RegisterSalesman(Request $request)
      {
        $salesman = new Salesman;
        $salesman->name = $request->name;
        $salesman->adress = $request->adress;
        $salesman->phone = $request->phone;
        $salesman->email = $request->email;
        $salesman->promoter_id =Auth::guard('Promoter')->user()->id;
        $salesman->save();
        
        return response()->json($salesman->with('CreatedBy')->findOrFail(1));
      }

      public function DeleteSalesman($id)
      {
        $salesman= Salesman::destroy($id);        

        return response()->json($salesman); 
      }

      public function FindSalesman($id)
      {
        $salesman= Salesman::find($id);

        return response()->json($salesman);

      }

      public function UpadateSalesman(Request $request, $id)
      {
        $salesman= Salesman::find($id);
        $salesman->name = $request->name;
        $salesman->adress = $request->adress;
        $salesman->phone = $request->phone;
        $salesman->email = $request->email;
        $salesman->save();

        return response()->json($salesman);
      }

//-----------------------------------------------------------------------

//-----------------------Users Acctions-------------------------

      public function ShowPendingClients()
      {
        return view('promoter.AdminModules.Clients');
      }

      public function ClientsData()
      {
          $user=User::where('verify','=','0')
                                             ->where('img_doc','<>','NULL')
                                             ->where('num_doc','<>','NULL')
                                             ->where('type','<>','Indefinido')
                                             ->where('fech_nac','<>','NULL')
                                             ->get();
             return Datatables::of($user)
                    ->addColumn('Estatus',function($user){
                      
                      return '<button type="button" class="btn btn-theme" value='.$user->id.' data-toggle="modal" data-target="#myModal" id="Status">En Proceso</button';
                    })

                    ->addColumn('webs',function($user){
                      
                      return '<button type="button" class="btn btn-theme" value='.$user->id.' data-toggle="modal" data-target="#webModal" id="webs">Ver Redes</button';
                    })                                        
                    
                    ->editColumn('img_doc',function($user){
                      /* solucion para produccion
                      $ruta = "https://leipel.com/";
                      return '<button value='.$user->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="'.$ruta.$user->img_doc.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$user->id.'">
                                 </button>';
                      })
                      */
                      return '<button value='.$user->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" style="width:70px;height:70px;" src="'.asset($user->img_doc).'"
                                  alt="User Avatar" id="photo'.$user->id.'"> 
                                 </button>';
                    })
                    ->editColumn('name',function($user){
                       return $user->name.' '.$user->last_name; 
                    })
                    ->rawColumns(['Estatus','img_doc','webs'])
                    ->toJson();                                           
      }

      public function AllClientsData()
      {
          $user=User::where('verify','=','1')
                                             ->get(); 
             return Datatables::of($user)
                    ->addColumn('Estatus',function($user){
                      
                      return '<button type="button" class="btn btn-theme" disabled >Aprobado</button';
                    })

                    ->addColumn('webs',function($user){
                      
                      return '<button type="button" class="btn btn-theme" value='.$user->id.' data-toggle="modal" data-target="#webModal" id="webs">Ver Redes</button';
                    })                                        
                    
                    ->editColumn('img_doc',function($user){

                      return '<button value='.$user->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="https://leipel.com/'.$user->img_doc.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$user->id.'"> 
                                 </button>';
                    })
                    ->editColumn('name',function($user){
                       return $user->name.' '.$user->last_name;
                    })
                    ->rawColumns(['Estatus','img_doc','webs'])
                    ->toJson();
      }

     public function RejectedClientsData()
      {
          $user=User::where('verify','=','2')
                                             ->get();
             return Datatables::of($user)
                    ->addColumn('Estatus',function($user){

                      return '<button type="button" class="btn btn-theme" disabled >Rechazado</button';
                    })

                    ->addColumn('webs',function($user){

                      return '<button type="button" class="btn btn-theme" value='.$user->id.' data-toggle="modal" data-target="#webModal" id="webs">Ver Redes</button';
                    })

                    ->editColumn('img_doc',function($user){

                      return '<button value='.$user->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="https://leipel.com/'.$user->img_doc.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$user->id.'"> 
                                 </button>';
                    })
                    ->editColumn('name',function($user){
                       return $user->name.' '.$user->last_name; 
                    })
                    ->rawColumns(['Estatus','img_doc','webs'])
                    ->toJson();                                           
      }


      public function ValidateUser(Request $request,$id)
      {
        $User= User::find($id);
        
        if ($request->status == 'Aprobado')
          {
            $User->verify=1;
            
            event(new UserValidateEvent($User->email,1,0));
          }
           else
          {
            $User->verify=2;

            event(new UserValidateEvent($User->email,2,$request->message));
          }

        $User->save();

        return response()->json($User);
      }

      public function WebsDataTable($id)
      {
          $user= User::find($id);
          $x=$user->Referals()->get();
          $referals1 = [];
          $referals2= [];
          $referals3= [];
          $WholeReferals = new Collection; 
          
          if ($user->Referals()->get()->isEmpty()) 
          {
            return Datatables::of($WholeReferals)->toJson();
          }
          foreach ($user->Referals()->get() as $key) 
          {
              $referals1[]=$key->refered;
              $WholeReferals->prepend(User::find($key->refered));
          }

          if (count($referals1)>0) 
              { 
                
                foreach ($referals1 as $key2) 
                 {  
                    $joker = User::find($key2);
                    
                    foreach($joker->Referals()->get() as $key2)
                     {
                       $referals2[]=$key2->refered;
                       $WholeReferals->prepend(User::find($key2->refered));
                     }                  
                 }
              }
          else
              {
                $referals2=0;
              }   


                               
          if (count($referals2)>0) 
              {
                foreach ($referals2 as $key3) 
                {
                  $joker = User::find($key3);
                    
                    foreach($joker->Referals()->get() as $key3)
                     {
                       $referals3[]=$key3->refered;
                       $WholeReferals->prepend(User::find($key3->refered));                       
                     }         
                }
              }

          else
              {
                $referals3=0;
              }   

                        
                          
            $WholeReferals->map(function ($item) use($referals1,$referals2,$referals3){
                        
              if (in_array($item->id, $referals1)) { return $item->level=1;}
              if (in_array($item->id, $referals2)) { return $item->level=2;}
              if (in_array($item->id, $referals3)) { return $item->level=3;}
                      });         
              
        return Datatables::of($WholeReferals)->toJson();              
      }

//------------------------------------------------------------------

//---------Pauetes de Tiques
      
      public function UpdatePackage($id, Request $request)
      {
        $Pack=TicketsPackage::find($id);
        $Pack->name= $request->name;
        $Pack->points_cost=$request->pointsCost;
        $Pack->points=$request->points;
        $Pack->cost= $request->cost;
        $Pack->amount= $request->ammount; 
        $Pack->save();

        return response()->json($Pack);
      }

      public function GetPackage($id)
      {        
        $Pack=TicketsPackage::find($id);

          return response()->json($Pack); 
      }

      public function SavePackage(Request $request)
      {
        
        $NPack= new TicketsPackage;
        $NPack->name= $request->name;
        $NPack->points_cost=$request->pointsCost;
        $NPack->points=$request->points;
        $NPack->cost= $request->cost;
        $NPack->amount= $request->ammount; 
        $NPack->save();
        
        return response()->json($NPack);
      }

      public function DeletePackage($id)
      {
        $Pack=TicketsPackage::destroy($id);
        return response()->json($Pack);
      }

//--------------------------------

//-----------------Validacion de Pagos----------------------
      public function DepsitDataTable()
      {
        $deposit = Payments::where('status','=','En Revision')->with('TicketsUser')->with('Tickets');
        /* solucion para produccion
                      $ruta = "http://leipel.com";
                      return ' <button value='.$deposit->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="'.$ruta.$deposit->voucher.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$deposit->id.'">
                                 </button> ';
                      })
                      */

        return Datatables::of($deposit)
                                    ->editColumn('voucher',function($deposit){
                                      /*
                                      $ruta = "http://leipel";
                      return ' <button value='.$deposit->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="'.$ruta.$deposit->voucher.'"
                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$deposit->id.'"> 
                                 </button> ';
                    })
                    return '<img class="img-rounded img-responsive av" src="'.asset($Musician->photo).'"
<img class="img-rounded img-responsive av" src="'.asset($deposit->vouch).'"
                                      */
                    return ' <button value='.$deposit->id.' data-toggle="modal" data-target="#ciModal" id="file_b">
                      <img class="img-rounded img-responsive av" src="'.asset($deposit->voucher).'"                                 style="width:70px;height:70px;" alt="User Avatar" id="photo'.$deposit->id.'"> 
                                 </button> ';
                    })
                    ->editColumn('user_id',function($deposit){

                      return $deposit->TicketsUser->name;
                    })
                    ->addColumn('Estatus',function($deposit){
                      
                      return '<button type="button" class="btn btn-theme" value='.$deposit->id.' data-toggle="modal" data-target="#PayModal" id="payval">En Proceso
                      </button';
                    })
                     ->addColumn('total',function($deposit){
                      
                      return $deposit->value*$deposit->Tickets->cost.'$';
                    })
                      ->rawColumns(['Estatus','voucher'])
                      ->toJson();
      }

      public function DepositStatus($id,Request $request)
      {
        
        $deposit = Payments::find($id);
        
        
        if($request->status_p == 'Aprobado')
        {

          $user = User::find($deposit->user_id);
         
          $tickets =  $deposit->value*$deposit->Tickets->amount;

          $user->credito =$user->credito + $tickets;
         
          $user->save();
         
          $deposit->status = 'Aprobado';
         
          $deposit->save();
        
          $Condition=Carbon::now()->firstOfMonth()->toDateString();

          $revenueMonth = Payments::where('user_id','=',$deposit->user_id)
            ->where('created_at', '>=',$Condition)
            ->where('status', '=','Aprobado')
            ->get();
          
          $balance=  SistemBalance::find(1);

          $balance->tickets_solds = $balance->tickets_solds + $deposit->Tickets->amount;

          $balance->save();

          if ($revenueMonth->count()<=1) 
          {
           event(new AssingPointsEvents($user->id,$deposit->package_id));
          }

          event(new PayementAprovalEvent($user->email));
          
          return response()->json($user);
        }
        else
        {
           $user = User::find($deposit->user_id);
           $deposit->status = 'Denegado';
           $deposit->save();
           event(new PaymentDenialEvent($user->email,$request->message));
           return response()->json($deposit);

        }
      }

      public function facturaDeposito($idTickets,$medio,$idUser) {
        //dd($idTickets,$medio,$idUser);
        $secuencial = rand(0,100000000);
        $Buy = Payments::find($idTickets);
        $paquete = TicketsPackage::find($Buy->package_id);
        $user = User::find($idUser);
        $nombrePaquete = $paquete->name;
        $iva = 0.12;
        $costoPaquete = $Buy->cost;
        $cantidadPaquetes = $Buy->value;
        $valor = ($costoPaquete*$iva)*$cantidadPaquetes;
        $base_imponible =  ($costoPaquete*$cantidadPaquetes)-$valor;
        $total = $costoPaquete*$cantidadPaquetes;
        $data = [
        "ambiente" => 1, // 1: prueba; 2: produccion
        "tipo_emision" => 1, // normal
        "secuencial" => $secuencial, // Id de tickets_sales
        "fecha_emision" => date("c"), //"2018-08-27T22:02:41Z", //Z
        "emisor" => [
            "ruc" => "0992897171001",
            "obligado_contabilidad" => true,
            "contribuyente_especial" => " ",
            "nombre_comercial" => "LEIPEL / MuligHed",
            "razon_social" => "Informeret S.A.",
            "direccion" => "Torres del Mall del Sol, Torre B, Piso 4 (Av. Joaquín Orrantia y Juan Tanca Marengo)",
            "establecimiento" => [
                "punto_emision" => "002",
                "codigo" => "001",
                "direccion" => "Torres del Mall del Sol, Torre B, Piso 4 (Av. Joaquín Orrantia y Juan Tanca Marengo)"
            ]
        ],
        "moneda" =>"USD",
        "totales" => [
            "impuestos" => [[
                "base_imponible" => $base_imponible, // 8.8, // precio base sin el %
                "valor" => $valor, //1.2, // 12% del precio del paquete
                "codigo" => "2", // IVA
                "codigo_porcentaje" => "2" // 12%
            ]],
            "total_sin_impuestos" => $base_imponible, // 8.8,
            "importe_total" => $total, // 10.0, // precio del paquete de tickets
            "propina" => 0.0,
            "descuento" => 0.0
        ],
        "comprador" => [ // datos del usuario
            "email" => $user->email,
            "identificacion" => $user->num_doc,
            "tipo_identificacion" => "04", // 04: RUC; 05: Cedula
            "razon_social" => $user->name." ".$user->last_name,
            "direccion" => $user->direccion
        ],
        "items" => [[
            "cantidad" => $cantidadPaquetes, // 1.0, // cantidad de paquetes comprados
            "precio_unitario" => $costoPaquete, // 10.0, // precio del paquete de tickets
            "descripcion" => "Compra de Paquete de Tickets Leipel. ".$nombrePaquete, // "Compra de Paquete de Tickets Leipel", // nombre del paquete
            "precio_total_sin_impuestos" => $total, // 10.0, // cantidad*precio_unitario //cambiado
            "impuestos" => [[
                "base_imponible" => $base_imponible, // 8.8, // precio base sin el %
                "valor" => $valor, // 1.2, // 12% del precio del paquete
                "tarifa" => 12.0, // 12%
                "codigo" => "2", // IVA
                "codigo_porcentaje" => "2" // 12%
                ]],
            "descuento" => 0.0
            ]],
        "pagos" => [[
            "medio" => $medio, // "deposito_cuenta_bancaria", // deposito_cuenta_bancaria/dinero_electronico_ec
            "total" => $total // 10.0 // precio del paquete de tickets
            ]]
        ];
        $urlEmision = "https://link.datil.co/invoices/issue";
        $headers    = array("Content-Type: application/json", "X-Key: e884359eb97147fa8a1fd77ffe6e308b", "X-Password: DTleipel8892");
        $datapost   = json_encode($data);
        $ch         = curl_init();
        curl_setopt($ch,CURLOPT_URL,$urlEmision);
        curl_setopt($ch,CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$datapost);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch,CURLOPT_TIMEOUT, 20);
        curl_setopt($ch,CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close ($ch);
        $respuesta = json_decode($response);
        return Response()->json($respuesta);
      }

      public function setFactura($idTicketSales,$idFactura) {
        $ticketSale = Payments::find($idTicketSales);
        $ticketSale->factura_id = $idFactura;
        $ticketSale->save();
        return Response()->json($ticketSale);
      }


//------------------------------------------------------------

//--------------------------Funcion de Pruueba----------------
    public function test()
      {
      }
//-------------------------------------------------------------


}
 