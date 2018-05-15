<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\StatusApplys;
use App\Mail\PromoterAssing;


//-------------Modelos del sistema-----------------------
use App\Megazines;
use App\Tags;
use App\ApplysSellers;
use App\Albums;
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
//--------------------------------------------------------

class AdminController extends Controller
{
	 public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$user= User::find(Auth::user()->id);      
    	
      if($user['status']=='admin')
        {

            $albums= Albums::where('status','=','En Revision')->get();
            $singles= Songs::where('status','=','En Revision')->whereNull('album')->get();
            $radios= Radio::where('status','=','En Revision')->get();
            $tv= Radio::where('status','=','En Revision')->get();
            $books= Book::where('status','=','En Revision')->get();
            $megazines= Megazines::where('status','=','En Revision')->get();
            $tags= Tags::all();

            $sellers=ApplysSellers::all();
            
            return view('admin.Dashboard')->with('tags', $tags)->with('megazines', $megazines)->with('books', $books)->with('tv', $tv)->with('radios', $radios)->with('singles', $singles)->with('albums', $albums);
         }
         else
        {
            Auth::logout();
            return redirect('/login');
        }
    	
    }

/*-------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
--------------------                             .............................................
--------------------- FUNCIONES DE APROBAR ALBUM --------------------------------------------
----------------------                            ------------------------------------------
--------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------
*/
    	public function ShowAlbums()
    	{	
    		$albums= Albums::where('status','=','En Revision')->paginate(10);
    		return view('admin.Albums')->with('albums',$albums);
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
			  $albums->save();
   			return response()->json($albums);
   		}
/*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE SINGLE -------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/
   		public function ShowSingles()
    	{
    		$single= Songs::where('status','=','En Revision')->whereNull('album')->paginate(10);
    		return view('admin.Single')->with('single',$single);
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
			  $Single->save();
   			return response()->json($Single);
   		}

/*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE ARTISTAS MUSICALES -------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/

   		public function ShowMusician()
    	{
    		$musician= music_authors::where('status','=','En Proceso')->paginate(10);
    		return view('admin.Musician')->with('musician',$musician);
   		}

      public function ShowAllMusician()
      {
        $musician= music_authors::paginate(10);
        return view('admin.Musician')->with('musician',$musician);
      }

   		public function MusicianStatus(Request $request,$id)
   		{
   			$musician =music_authors::find($id);
   			$musician->status = $request->status; 
			  $musician->save();
   			return response()->json($musician);
   		}

/*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE RADIOS ----------- -------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/   		
  
   		public function ShowRadios()
    	{
    		$radios= Radio::where('status','=','En Proceso')->paginate(10);
    		return view('admin.Radio')->with('radios',$radios);
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
			  $radios->save();
   			return response()->json($radios);
   		}

/*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE REVISTAS ----------- -------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/
   		public function ShowMegazine()
    	{
			  $megazines= Megazines::where('status','=','En Revision')->paginate(10);
    		return view('admin.Megazine')->with('megazines',$megazines);
   		}

      public function ShowAllMegazine()
      {
        $megazines= Megazines::paginate(10);
        return view('admin.Megazine')->with('megazines',$megazines);
      }      

   		public function ShowPublicationChain()
    	{
    		$saga = Sagas::where('status','=','En Proceso')->where('type_saga','=','Revistas')->paginate(10);
    		return view('admin.PubChain')->with('sagas',$saga);
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
			  $saga->save();
   			return response()->json($saga);
   		}

   		public function MegazineStatus(Request $request,$id)
    	{
			  $megazines = Megazines::find($id);
	   		$megazines->status = $request->status; 
			  $megazines->save();
   			return response()->json($megazines);
   		}
 
 /*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE TV---- ----------- -------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/ 		
   		
	   	public function ShowTV()
    	{
    		$tv= TV::where('status','=','En Proceso')->paginate(10);
    		return view('admin.TV')->with('TVS',$tv);
   		}

      public function ShowAllTV()
      {
        $tv= TV::paginate(10);
        return view('admin.TV')->with('TVS',$tv);
      }

   		public function TvStatus(Request $request,$id)
   		{
   			$tv =Radio::find($id);
   			$tv->status = $request->status; 
			  $tv->save();
   			return response()->json($tv);
   		}




   		public function Books()
    	{
    	
   		}



 /*---------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------   FUNCIONES DE PROVEEDORES------ -------------------------------------
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
*/


	   	public function ShowSellers()
    	{
    		$sellers= Seller::paginate(10);
    		
    		$acces_modules=SellersRoles::all();

        $promoters= Promoters::all();

    		return view('admin.Sellers')->with('promoters',$promoters)->with('sellers',$sellers)->with('acces_modules',$acces_modules);
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

      public function AproveOrDenialSeller(Request $request,$id)
      {
        if ($request->status=='Rechazado') 
        {
          $seller= Seller::find($id);
          
          $data=$seller->delete();          
        }
        else
        {
          $seller= Seller::find($id);
          $seller->estatus=$request->status;          
          $data=$seller->save();
        }
          return response()->json($data);          
      }
//-------------Mostrar Promotores y Solicitudes  ---------------------------------
   		public function ShowApplys()
    	{
    		$applys= ApplysSellers::paginate(10);
    		
    		$promoters = Promoters::paginate(10);
    		
    		return view('admin.Applys')->with('applys',$applys)->with('promoters',$promoters);
   		}
//-------------------------------------------------------------------------------

//-----------------------CRUD PROMOTORES------------------------------------

   		public function CreatePromoter(Request $request)
   		{
   			$promoter = new Promoters;
   			$promoter->name_c =$request->name_c;
   			$promoter->phone_s =$request->phone_s;
   			$promoter->email= $request->email_c;

          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
        
              for ($i = 0; $i < 6; $i++) 
                  {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }


   			$promoter->password=$randomString;



        $promoter->save();
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

		public function AddPromoterToApllys(Request $request, $id)
		{
			$applys = ApplysSellers::find($id);

			$applys->promoter_id = $request->promoter_id;

			$applys->assing_at = $current = Carbon::now();

      $applys->save();
        
      $mail=Mail::to($applys->email_c)->send(new PromoterAssing($applys));

      			
      return response()->json($applys); 
		}

		public function DeletePromoterFromApllys($id_apply,$id_promoter)
		{
			$applys= ApplysSellers::find($id_apply);
			$applys->promoter_id= NULL;
			$applys->save();
			return response()->json($applys);	
		}

		public function StatusApllys($id,Request $request )
		{
			$applys= ApplysSellers::find($id);
			$applys->status = $request->status;
			$applys->save();
      
			if ($request->status == 'Aprobado') 
			{
			
				  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    			$charactersLength = strlen($characters);
    			$randomString = '';
    		
    					for ($i = 0; $i < 10; $i++) 
       						{
        						$randomString .= $characters[rand(0, $charactersLength - 1)];
   					 		  }
	
				$applys->token= $randomString;
			
				$current = Carbon::now();
	
				$applys->expires_at= $current->addDays(7);
				
				
				
				Mail::to($applys->email_c)->send(new StatusApplys($applys,$request->message));

				return response()->json($applys);	
			}
      else
      {
        Mail::to($applys->email_c)->send(new StatusApplys($applys,$request->message));
          
      }
			
	
			
		
			return response()->json($applys);
		}

    public function DeleteApplysFromPromoter($promoter,$applys)
    {
      $Applys = ApplysSellers::find($applys);
      $Applys->promoter_id = NULL;
      $Applys->save();
      return response()->json($Applys);
    }

}
