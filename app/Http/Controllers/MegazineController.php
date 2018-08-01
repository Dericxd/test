<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sagas;
use App\Megazines;
use App\Tags;
use Auth;
use File;

//modulo encargado de gestionar las revistas y contenido afin

class MegazineController extends Controller
{
    


/*------------------------------------------------------------------------------
---------------------Funciones de Mostrar Vistas-------------------------------
-------------------------------------------------------------------------------
*/

     public function ShowMegazineForm()
     {
        $user= Auth::guard('web_seller')->user()->id;

        $sagas= Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->get();
          
          return view('seller.megazine_module.megazine_form')->with('sagas',$sagas);
     }

     public function ShowPTypeForm()
     {
         
        $tags = Tags::where('type_tags','=','Revistas')->get();
     	return view('seller.megazine_module.pub_type_form')->with('tags',$tags);
     }
     
     public function ShowSingleMegazineForm()
     {
        $tags = Tags::where('type_tags','=','Revistas')->get();
     	return view('seller.megazine_module.in_megazine')->with('tags',$tags);
     }
     
     public function ShowUpdateMegazineForm($id)
     {
          $user= Auth::guard('web_seller')->user()->id; 
          $megazine = Megazines::find($id);
          $sagas= Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->get();
          return view('seller.megazine_module.update_megazine_form')->with('sagas',$sagas)->with('megazine',$megazine);
     }

     public function ShowUpdatePTypeForm($id)
     {
        $saga = Sagas::find($id); 
        $tags = Tags::where('type_tags','=','Revistas')->get();
        $selected = $saga->tags_sagas()->get();

         return view('seller.megazine_module.update_type_form')->
         with('tags',$tags)->
         with('pub_type',$saga)->
         with('s_tags',$selected);
     }
     
     public function ShowUpdateSingleMegazineForm($id)
     {
        $smegazine = Megazines::find($id);
        $tags = Tags::where('type_tags','=','Revistas')->get();
        $selected = $smegazine->tags_megazines()->get();

         return view('seller.megazine_module.megazine_i_update')->
         with('tags',$tags)->
         with('i_megazine',$smegazine)->with('s_tags',$selected);
     }
     
    public function MyMegazine($id)
    {
     
        $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$id)->simplePaginate(10);

    	$single = Megazines::where('seller_id','=',$id)->where('saga_id','=',NULL)->simplePaginate(10);
    	
       return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);
        
    }
    
    public function ShowType($id)
    {
        $type= Sagas::find($id);
        return view('seller.megazine_module.show_type')->with('type', $type);
    }
    
    public function ShowMegazine($id)
    {
        $megazine= Megazines::find($id);
        return view('seller.megazine_module.show_megazine')->with('megazine', $megazine);
    }

/*------------------------------------------------------------------------------
--------------------Fin de funciones de Mostrar Vistas-------------------------
-------------------------------------------------------------------------------
*/




/*------------------------------------------------------------------------------
--------------------Funciones de Guardar Contenido------------------------------
-------------------------------------------------------------------------------
*/

    public function AddPType(Request $request)
    {
        $store_path = '/megazine/'.$request->seller_id.'/sagas/'.$request->title;
	
    	$file = $request->file('image');
    
        $name1 = 'saga_'.$request->title. time() . '.'. $file->getClientOriginalExtension();
    
        $file->move(public_path().$store_path,$name1);
    
        $path = $store_path.$name1;

        $saga = new Sagas;
        $saga->seller_id = $request->seller_id;
        $saga->sag_name = $request->title;
        $saga->type_saga = 'Revistas';
        $saga->sag_description = $request->dsc;
        $saga->status = 'En Proceso';
        $saga->img_saga = $path;
        $saga->save();
        
        $saga->tags_sagas()->attach($request->tags);
        
        Flash('Se ha registrado '.$saga->sag_name)->success();

        $tags = Tags::where('type_tags','=','Revistas')->get();
     	return view('seller.megazine_module.pub_type_form')->with('tags',$tags);
    }
    
        public function AddMegazine(Request $request)
    {
        $saga= Sagas::find($request->type_megazine);
        
        $store_path = '/megazine/'.$request->seller_id.'/sagas/'.$saga->sag_name;
    	
    	$file1 = $request->file('pdf_file');
    	$file2 = $request->file('photo');
    	
        $name1 = 'megazine_'.$request->title. time() . '.'. $file1->getClientOriginalExtension();
        
        $name2 = 'cover_'.$request->title. time() . '.'. $file2->getClientOriginalExtension();
        
        $file1->move(public_path().'/'.$store_path,$name1);
        
        $file2->move(public_path().'/'.$store_path,$name2);
        
        $path1 = $store_path.$name1;
        
        $path2 = $store_path.$name1;
      
      
      $megazine = new Megazines;
      $megazine->seller_id=Auth::guard('web_seller')->user()->id;
      $megazine->title=$request->title; 
      $megazine->cover=$path2;
      $megazine->num_pages=0;
      $megazine->descripcion=$request->dsc;
      $megazine->megazine_file=$path1;
      $megazine->saga_id=$request->type_megazine;
      $megazine->cost=$request->cost;
      $megazine->status=2;
      $megazine->country=$request->country;
      $megazine->save();
        
        
        Flash('Se ha registrado '.$request->title)->success();
        $user= Auth::guard('web_seller')->user()->id;
        $sagas= Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->get();
     	return view('seller.megazine_module.megazine_form')->with('sagas',$sagas);
    }
    
    
        public function AddMegazineI(Request $request)
    {
        
        
        $store_path = '/megazine/'.$request->seller_id.'/one_shot';
    	
    	$file1 = $request->file('pdf_file');
    	$file2 = $request->file('photo');
    	
        $name1 = 'megazine_'.$request->title. time() . '.'. $file1->getClientOriginalExtension();
        
        $name2 = 'cover_'.$request->title. time() . '.'. $file2->getClientOriginalExtension();
        
        $file1->move(public_path().$store_path,$name1);
        
        $file2->move(public_path().$store_path,$name2);
        
        $path1 = $store_path.'/'.$name1;
        
        $path2 = $store_path.'/'.$name2;
      
      
      $megazine = new Megazines;
      $megazine->seller_id=$request->seller_id;
      $megazine->title=$request->title; 
      $megazine->cover=$path2;
      $megazine->num_pages=0;
      $megazine->descripcion=$request->dsc;
      $megazine->megazine_file=$path1;
      $megazine->saga_id=NULL;
      $megazine->cost=$request->cost;
      $megazine->status=2;
      $megazine->country=$request->country;
      $megazine->save();
      $megazine->tags_megazines()->attach($request->tags);
        
        Flash('Se ha registrado '.$request->title)->success();
        
        $tags = Tags::where('type_tags','=','Revistas')->get();
     	return view('seller.megazine_module.in_megazine')->with('tags',$tags);
    }
    
/*------------------------------------------------------------------------------
------------------Fin de Funciones de Guardar Contenido-------------------------
--------------------------------------------------------------------------------
*/




/*------------------------------------------------------------------------------
------------------Funciones de Modificar Contenido------------------------------
--------------------------------------------------------------------------------
*/

     public function UpdateMegazine(Request $request,$id)
    {
        $megazine =  Megazines::find($id);
        $saga= Sagas::find($request->type_megazine);

        if ($request->hasFile('photo')) 
        {
        
        $file2=$request->file('photo');
        
        $store_path = '/megazine/'.$request->seller_id.'/sagas/'.$saga->sag_name;

        File::delete(public_path().$megazine->cover);

        $name2 = 'cover_'.$request->title. time() . '.'. $file2->getClientOriginalExtension();

        $file2->move(public_path().$store_path,$name2);
        
        $path2 = $store_path.'/'.$name2;

        $megazine->cover =$path2;
        }
        $megazine->title=$request->title;
        $megazine->descripcion=$request->dsc;
        $megazine->cost=$request->cost;
        $megazine->status=2;
        $megazine->country=$request->country;
        $megazine->save();
        
        $user= Auth::guard('web_seller')->user()->id;

        $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->simplePaginate(10);

    	$single = Megazines::where('seller_id','=',$id)->where('saga_id','=',NULL)->simplePaginate(10);
        
        Flash('Se ha Modificado '.$request->title)->success();
        
       return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);

    }

    public function UpdateIdMegazine(Request $request,$id)
    {
        $megazine =  Megazines::find($id);
        
        if ($request->hasFile('photo')) 
        {
        
        $file2=$request->file('photo');
        
        $store_path = '/megazine/'.$megazine->seller_id.'/one_shot';

        File::delete(public_path().$megazine->cover);

        $name2 = 'cover_'.$request->title. time() . '.'. $file2->getClientOriginalExtension();

        $file2->move(public_path().$store_path,$name2);
        
        $path2 = $store_path.'/'.$name2;

        $megazine->cover =$path2;
        }
        $megazine->title=$request->title;
        $megazine->descripcion=$request->dsc;
        $megazine->saga_id=NULL;
        $megazine->cost=$request->cost;
        $megazine->status=2;
        $megazine->country=$request->country;
        $megazine->save();
        
        
        foreach($request->tags as $tags)
        {
            foreach($megazine->tags_megazines()->get() as $old)
            {
                if($tags =! $old->id)
                {
                $megazine->tags_music()->attach($tags); 
                }
            }
        }



        $user= Auth::guard('web_seller')->user()->id;

        $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->simplePaginate(10);

    	$single = Megazines::where('seller_id','=',$id)->where('saga_id','=',NULL)->simplePaginate(10);
        
        Flash('Se ha Modificado '.$request->title)->success();
        
       return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);

    }

    public function UpdatePType(Request $request,$id)
    {






        $user= Auth::guard('web_seller')->user()->id;
        $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->simplePaginate(10);
    	$single = Megazines::where('seller_id','=',$id)->where('saga_id','=',NULL)->simplePaginate(10);
        
        Flash('Se ha Modificado '.$request->title)->success();
        
       return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);
    }

/*------------------------------------------------------------------------------
------------------Fin de Funciones de Modificar Contenido-----------------------
--------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------------
------------------Funciones de Eliminar Contenido------------------------------
--------------------------------------------------------------------------------
*/

    public function DeleteMegazine($id)
    {
        $delete = Megazines::find($id);
        $saga_id= $delete->saga_id;
        $title= $delete->title;
        $user= Auth::guard('web_seller')->user()->id;
        File::delete(public_path().$delete->megazine_file);
        File::delete(public_path().$delete->cover);
        $delete->delete();
        
        if($saga_id==NULL or $saga_id==0)
        {
            $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->simplePaginate(10);

            $single = Megazines::where('seller_id','=',$user)->where('saga_id','=',NULL)->simplePaginate(10);

           Flash('Se ha eliminado '.$title)->error();
           return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);            
        }
        else
        {
        $type= Sagas::find($saga_id);
        Flash('Se ha eliminado '.$title.'de la cadena de publicacion '.$type->sag_name)->error();
        return view('seller.megazine_module.show_type')->with('type', $type);

        }
        
    }
    
    public function DeleteType($id)
    {
        $delete = Sagas::find($id);
        $user= Auth::guard('web_seller')->user()->id;
        File::delete(public_path().$delete->img_saga);

        $delete->delete();
        
        $collection = Sagas::where('type_saga','=','Revistas')->where('seller_id','=',$user)->simplePaginate(10);
        $single = Megazines::where('seller_id','=',$user)->where('saga_id','=',NULL)->simplePaginate(10);

       Flash('Se ha eliminado '.$title)->error();
       return view('seller.megazine_module.megazine_panel')->with('collection', $collection)->with('single', $single);
        
    }

/*------------------------------------------------------------------------------
------------------Fin de Funciones de Eliminar Contenido-----------------------
--------------------------------------------------------------------------------
*/
    
}
