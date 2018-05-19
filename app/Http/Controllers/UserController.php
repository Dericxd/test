<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.edit');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        dd($user);
        $user = User::find($id);

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->codigo_ref = $request->codigo_ref;
        $user->ci = $request->ci;
        $user->num_doc = $request->num_doc;
        $user->img_doc = $request->img_doc;
        $user->type= $request->type;
        $user->alias = $request->alias;
        
        if ($request->hasFile('img_perf'))
        {


         $store_path = public_path().'/user/'.$user->id.'/profile/';
         
         $name = 'userpic'.$request->name.time().'.'.$request->file('img_perf')->getClientOriginalExtension();

         $request->file('img_perf')->move($store_path,$name);

         $real_path='/user/'.$user->id.'/profile/'.$name;
         
         $user->img_perf = $real_path='/user/'.$user->id.'/profile/'.$name;             
        }
        else
        {
            $user->img_perf= NULL;
        }
        $user->credito = $request->credito;
        $user->fech_nac = $request->fech_nac;
     
        //dd($user);
        $user->save();
        Flash('Se Han Modificado Sus Datos Con Exito')->success();
        return view('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
