<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Referals;
use App\User;


class ReferalsController extends Controller
{
    public function ShowWebs()
    {	
    	$user= User::find(Auth::user()->id);
    	$referals1=$user->referals()->count();
    	$referals2=0;
    	$referals3=0;
    	
    	foreach ($user->referals()->get() as $key) 
    	{
    		$referals=User::find($key->refered);
    		$referals2=$referals->referals()->count()+$referals2;

    		foreach ($referals->referals()->get() as $key2) 
    		{
    			$referals=User::find($key2->refered);
    			$referals3=$referals->referals()->count()+$referals3;

    		}
    	}
    	

    	

    	return view('users.WebsUser')->with('referals1',$referals1)->with('referals2',$referals2)->with('referals3',$referals3);
    }

    public function ShowReferals()
    {
    	return view('users.Referals');
    }
}