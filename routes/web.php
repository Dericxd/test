<?php

use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


/* ------------------------------------------------------------------
---------------------------------------------------------------------
---------                                              --------------
---------              RUTAS DE USUARIOS               --------------
---------                     Y                        --------------
---------               ADMINISTRADORES                --------------
---------                                              --------------
---------------------------------------------------------------------
---------------------------------------------------------------------
*/

Auth::routes();
Route::get('/home', 'HomeController@index');

Route::get('/login/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/login/{provider}/callback', 'SocialAuthController@handleProviderCallback');

Route::resource('users', 'UserController');

Route::get('/admin','AdminController@index');

/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ RUTAS ADMIN CONTENIDO MUSICAL--------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/

Route::get('/admin_albums','AdminController@ShowAlbums');
Route::get('/AllAdminAlbum','AdminController@ShowAllAlbums');

Route::get('/admin_songs/{id}','AdminController@AlbumSongs');
Route::post('/admin_album/{id}','AdminController@AlbumStatus');

Route::get('/admin_single','AdminController@ShowSingles');
Route::get('/AllAdminSingles','AdminController@ShowAllSingles');
Route::post('/admin_single/{id}','AdminController@SingleStatus');

Route::get('/admin_musician','AdminController@ShowMusician');
Route::get('/AllAdminMusician','AdminController@ShowAllMusician');
Route::post('/admin_musician/{id}','AdminController@MusicianStatus');




/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ FIN DE LAS RUTAS ADMIN CONTENIDO MUSICAL---------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/



/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ RUTAS ADMIN RADIOS------------------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


Route::get('/admin_radio','AdminController@ShowRadios');
Route::get('/AllAdminRadio','AdminController@ShowAllRadios');
Route::post('/admin_radio/{id}','AdminController@RadioStatus');



/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ FIN DE LAS RUTAS ADMIN RADIOS-------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/



/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ RUTAS ADMIN TV----------------------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


Route::get('/admin_tv','AdminController@ShowTV');
Route::get('/AllAdminTv','AdminController@ShowAllTV');
Route::post('/admin_tv/{id}','AdminController@TvStatus');



/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ FIN DE LAS RUTAS ADMIN TV-------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ RUTAS DE REVISTAS---------------------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


Route::get('/admin_chain','AdminController@ShowPublicationChain');
Route::get('/AllAdminMegazinesChain','AdminController@ShowAllPublicationChain');

Route::post('/admin_chain/{id}','AdminController@PublicationChainStatus');

Route::get('/admin_megazine','AdminController@ShowMegazine');
Route::get('/AllAdminMegazines','AdminController@ShowAllMegazine');

Route::post('/admin_megazine/{id}','AdminController@MegazineStatus');



/*------------------------------------------------------------------
-------------------------------------------------------------------
------------ FIN DE LAS DE REVISTAS-------------------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


/*------------------------------------------------------------------
--------------------------------------------------------------------
------------------ RUTAS DE MANEJO DE PROMOTORES  ------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


Route::post('/promoter_c','AdminController@CreatePromoter');

Route::get('/promoter_delete/{id}','AdminController@DeletePromoter');
Route::post('/add_promoter_to/{id}','AdminController@AddPromoterToApllys');

Route::get('/delete_promoter_from/{id_apply}/{id_promoter}','AdminController@DeletePromoterFromApllys');
Route::post('AdminAproveOrDenialApplys/{id}','AdminController@StatusApllys');

Route::get('/delete_applys_from/{promoter}/{applys}','AdminController@DeleteApplysFromPromoter');
Route::get('seller_complete_f/{id}/{code}', 'SellerController@CompleteRegistrationForm');



/*------------------------------------------------------------------
--------------------------------------------------------------------
--------------- FIN RUTAS DE MANEJO DE PROMOTORES  -----------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/



/*------------------------------------------------------------------
--------------------------------------------------------------------
--------------- FIN RUTAS DE MANEJO DE SOLICITUDES -----------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/

Route::get('/admin_sellers','AdminController@ShowSellers');

Route::get('/admin_modules/{id_seller}/{id_module}','AdminController@DeleteModule');

Route::post('admin_add_module/{id}','AdminController@AddModule');

Route::post('SellerAddPromoter/{id}','AdminController@AddPromoterToSeller');

Route::get('RemovePromoterFromSeller/{id_seller}/{id_promoter}','AdminController@RemovePromoterFromSeller');

Route::post('AproveOrDenialSeller/{id_seller}','AdminController@AproveOrDenialSeller');

Route::get('/admin_applys','AdminController@ShowApplys');




/*------------------------------------------------------------------
--------------------------------------------------------------------
--------------- FIN RUTAS DE MANEJO DE SOLICITUDES -----------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/




/*------------------------------------------------------------------
--------------------------------------------------------------------
------------ FIN DE LAS RUTAS DE USUARIOS O ADMIN ------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/






/* ------------------------------------------------------------------
---------------------------------------------------------------------
---------                                              --------------
---------              RUTAS DE PROMOTORES             --------------
---------                                              --------------
---------                                              --------------
---------                                              --------------
---------------------------------------------------------------------
---------------------------------------------------------------------
*/
Route::group(['middleware' => 'promoter_guest'], function() {



Route::get('promoter_login', 'PromoterAuth\LoginController@showLoginForm');

Route::post('promoter_login', 'PromoterAuth\LoginController@login');

});

Route::group(['middleware' => 'promoter_auth'], function(){

    Route::post('promoter_logout', 'PromoterAuth\LoginController@logout');

    Route::get('/promoter_home','PromoterController@index');

    Route::get('/promoter_seller','PromoterController@ShowSellers');


    Route::get('/delete_mod/{id_seller}/{id_module}','PromoterController@DeleteModule');
    
    Route::post('/add_module/{id}','PromoterController@AddModule');

    Route::post('/update_status_seller/{id}','PromoterController@UpadteStatusSeller');

    Route::post('/modify_applys/{id}','PromoterController@StatusApllys');

    Route::get('/promoter_applys','PromoterController@ShowApplys');

});

/*------------------------------------------------------------------
--------------------------------------------------------------------
------------ FIN DE LAS RUTAS DE PROMOTORES------ ------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/
















/* ------------------------------------------------------------------
---------------------------------------------------------------------
---------                                              --------------
---------              RUTAS DE SELLERS                --------------
---------                     O                        --------------
---------                PRODUCTORAS                   --------------
---------                                              --------------
---------------------------------------------------------------------
---------------------------------------------------------------------
*/


/*------------------------------------------------------------------
--------------------------------------------------------------------
---------------                                    -----------------
---------------       MIDDLEWARE DE INVITADO       -----------------
---------------                                    -----------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/

Route::group(['middleware' => 'seller_guest'], function () {

    Route::get('seller_register', 'SellerAuth\RegisterController@showRegistrationForm');

    Route::post('seller_register', 'SellerAuth\RegisterController@register');

    Route::get('applys', 'ApplysController@ShowApplysForm');

    Route::post('ApplysSubmit', 'ApplysController@SubmitApp');

    Route::get('seller_login', 'SellerAuth\LoginController@showLoginForm');

    Route::post('seller_login', 'SellerAuth\LoginController@login');

//------------------RUTAS DE OLVIDO SU CONTRASEÑA-------------------

    Route::get('seller_password/reset', 'SellerAuth\ForgotPasswordController@showLinkRequestForm');
    Route::post('seller_password/email', 'SellerAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('seller_password/reset/{token}', 'SellerAuth\ResetPasswordController@showResetForm');
    Route::post('seller_password/reset', 'SellerAuth\ResetPasswordController@reset');

//-------------FIN DE LAS RUTAS DE OLVIDO SU CONTRASEÑA-------------

});


/*------------------------------------------------------------------
-------------------------------------------------------------------
-------------  FIN DEL MIDDLEWARE DE INVITADO  ---------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


/*------------------------------------------------------------------
--------------------------------------------------------------------
---------------                                    -----------------
---------------       MIDDLEWARE DE LOGGEADO       -----------------
---------------                                    -----------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/


//Solo Productoras Logueadas pueden acceder a las siguientes rutas

Route::group(['middleware' => 'seller_auth'], function () {

    Route::post('seller_logout', 'SellerAuth\LoginController@logout');



    Route::post('/seller_complete', 'SellerController@CompleteRegistration');


    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                   -----------------------
    -----------------               DEL                    -----------------------
    -----------------          MODULO DE MUSICA            ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/


    /*---------- Registrar Artistas o Grupos Musicales ------------*/
    Route::post('/save_artist', 'ArtistController@CreateArtist');
    Route::get('/artist_form', 'ArtistController@ShowArtistForms');
    /*------------------------------------------------------------*/

    /*---------- Registrar Albums -------------------------------*/
    Route::post('/albums', 'AlbumsController@CreateAlbum');
    Route::get('/albums', 'AlbumsController@ShowAlbumstForms');
    /*------------------------------------------------------------*/

    /*------------------Modificar Albums -------------------------- */
    Route::get('/modify_album/{id}', 'AlbumsController@ModifyAlbum');
    Route::post('/modify_album/{id}', 'AlbumsController@UpdateAlbum');
    /*--------------------------------------------------------------*/

    /*------------------Borrar Albums-------------------------------*/
    Route::get('/delete_album/{id}', 'AlbumsController@DeleteAlbum');
    /*--------------------------------------------------------------*/

    /*------------------Mostrar Albums- ----------------------------*/
    Route::get('/show_album/{id}', 'AlbumsController@ShowAlbum');
    /*--------------------------------------------------------------*/


    /*---------- Registrar Singles -------------------------------*/
    Route::post('/single_registration', 'AlbumsController@SongConfig');
    Route::get('/single_registration', 'AlbumsController@ShowSingleForms');
    /*--------------------------------------------------------*/

    /*------------------Borrar Single-------------------------------*/
    Route::get('/delete_song/{id}', 'AlbumsController@DeleteSong');
    /*--------------------------------------------------------------*/

    /*------------------Modificar Single -------------------------- */
    Route::get('/modify_single/{id}', 'AlbumsController@ModifySong');
    Route::post('/modify_single/{id}', 'AlbumsController@UpdateSong');
    /*--------------------------------------------------------------*/

    /*--------------Panel de "Mi Contenido Musical"---------------- */
    Route::get('/my_music_panel/{id}', 'MusicController@ShowMusicPanel');
    /*--------------------------------------------------------------*/

    /*--------------AJAX de Guardar Etiquetas---------------------- */
    Route::post('/tagMusic', 'AlbumsController@SaveTag');
    /*--------------------------------------------------------------*/


    /*-------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    --------------------                                -----------------------
    --------------------           FIN                  -----------------------
    --------------------        DEL MODULO              -----------------------
    --------------------          MUSICA                -----------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------*/


    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                   -----------------------
    -----------------               DEL                    -----------------------
    -----------------          MODULO DE RADIOS            ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/


    Route::resource('radios', 'RadiosController');

    Route::get('radios/{id}/destroy', [
        'uses' => 'RadiosController@destroy',
        'as' => 'radios.destroy'
    ]);

    /*-------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    --------------------                                -----------------------
    --------------------           FIN                  -----------------------
    --------------------        DEL MODULO              -----------------------
    --------------------          RADIOS                -----------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------*/


    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                   -----------------------
    -----------------               DEL                    -----------------------
    -----------------          MODULO DE TVS                ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/

    Route::resource('tvs', 'TVController');

    Route::get('tvs/{id}/destroy', [
        'uses' => 'TVController@destroy',
        'as' => 'tvs.destroy'
    ]);

    /*-------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    --------------------                                -----------------------
    --------------------           FIN                  -----------------------
    --------------------        DEL MODULO              -----------------------
    --------------------          TVS                   -----------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------*/


    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                   -----------------------
    -----------------               DEL                    -----------------------
    -----------------          MODULO DE REVISTAS          ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/


//------------Rutas de "Agregar Revista a Cadena de Publicaciones"------------
    Route::get('/megazine_form', 'MegazineController@ShowMegazineForm');
    Route::post('/megazine_save', 'MegazineController@AddMegazine');
//-------------Fin de las Rutas-----------------------------------------------

//------------Rutas de "Crear Cadena de Publicaciones"------------
    Route::get('/type', 'MegazineController@ShowPTypeForm');
    Route::post('/type', 'MegazineController@AddPType');
//-------------Fin de las Rutas-----------------------------------------------

//------------Rutas de Registrar Revista Independiente----------------------
    Route::get('/megazine_i', 'MegazineController@ShowSingleMegazineForm');
    Route::post('/megazine_i', 'MegazineController@AddMegazineI');
//-----------Fin de las Rutas-----------------------------------------------

//------------Rutas de Modificar "Revista a Cadena de Publicaciones"------------
    Route::get('/megazine_update/{id}', 'MegazineController@ShowUpdateMegazineForm');
    Route::post('/megazine_update/{id}', 'MegazineController@UpdateMegazine');
//-------------Fin de las Rutas-----------------------------------------------

//------------Rutas de Modificar "Cadena de Publicaciones"------------
    Route::get('/type_update/{id}', 'MegazineController@ShowUpdatePTypeForm');
    Route::post('/type_update/{id}', 'MegazineController@UpdatePType');
//-------------Fin de las Rutas-----------------------------------------------

//------------Rutas de Modificar Revista Independiente----------------------------
    Route::get('/megazine_i_update/{id}', 'MegazineController@ShowUpdateSingleMegazineForm');
    Route::post('/megazine_i_update/{id}', 'MegazineController@UpdateIdMegazine');
//-----------Fin de las Rutas-----------------------------------------------------

//------------Rutas de Borrar Revistas ----------------------------
    Route::get('/delete_megazine/{id}', 'MegazineController@DeleteMegazine');
//-----------Fin de las Rutas-----------------------------------------------------


//------------Rutas de Borrar Cadenas de Publicacion ----------------------------
    Route::get('/type_delete/{id}', 'MegazineController@DeleteType');
//-----------Fin de las Rutas-----------------------------------------------------

//-----------Mostrar Cadenas de Publicaion-----------------------------------------
    Route::get('/show_pub/{id}', 'MegazineController@ShowType');
//------------------------------------------------------------------------------

//-----------Mostrar Revista-----------------------------------------
    Route::get('/show_megazine/{id}', 'MegazineController@ShowMegazine');
//-------------------------------------------------------------------------------

//-----------Panel de Mis Revistas ------------------------------------------------------------
    Route::get('/my_megazine/{id}', 'MegazineController@MyMegazine');
//-------------------------------------------------------------------------------

    /*-------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    --------------------                                -----------------------
    --------------------           FIN                  -----------------------
    --------------------        DEL MODULO              -----------------------
    --------------------          REVISTAS              -----------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------*/


    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                   -----------------------
    -----------------               DEL                    -----------------------
    -----------------          MODULO DE LIBROS            ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/


    Route::resource('tbook', 'BooksController');
    Route::get('tbook/{id}/destroy',[
        'uses' => 'BooksController@destroy',
        'as' => 'tbook.destroy'
    ]);

    /*-------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------
    --------------------                                -----------------------
    --------------------           FIN                  -----------------------
    --------------------        DEL MODULO              -----------------------
    --------------------          LIBROS                -----------------------
    ---------------------------------------------------------------------------
    ---------------------------------------------------------------------------*/

    /*----------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    ------------------------------------------------------------------------------
    -----------------              RUTAS                  -----------------------
    -----------------               DEL                   -----------------------
    -----------------          MODULO DE AUTORES           ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/
    Route::resource('authors_books', 'BooksAuthorsController');
    Route::get('authors_books/{id}/destroy', [
        'uses' => 'BooksAuthorsController@destroy',
        'as' => 'authors_books.destroy'
    ]);

    /*---------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    -----------------              RUTAS                  -----------------------
    -----------------               DEL                   -----------------------
    -----------------               FIN                   -----------------------
    -----------------          MODULO DE AUTORES           ----------------------
    -----------------------------------------------------------------------------
    -----------------------------------------------------------------------------
    ----------------------------------------------------------------------------*/


    Route::get('/Series', 'SellerController@CompleteRegistrationForm');


//----------------------------------------------------------------------
//-----------Funcion encargada de determinar ---------------------------
//-----------el acceso a los modulos del sistema----------------------- 
//-----------y Setear Las variabels en la Vista------------------------
//----------------------------------------------------------------------


    Route::get('/seller_home', function () {
        $id = Auth::guard('web_seller')->user()->id;

        $seller = App\Seller::find($id);
        
        $tv_content=0;
        $radios_content=0;
        $Megazine_content=0;
        $series_content=0;
        $Books_content=0;
        $Movies_content=0;
        $musical_content=0;

        $aproved_radio=0;
        $aproved_megazines=0;
        $aproved_song=0;
        $aproved_books=0;
        $aproved_musica=0;
        $aproved_tv=0;
        
        if($seller->roles())
        {
            $seller_modules;
        }

        

        foreach ($seller->roles as $role) 
        {
            $seller_modules[] = $role;

            switch ($role->name) 
            {
                
                case 'Musica':
                    $Musica = count($seller->albums()->get());
                    $aproved_musica=count($seller->albums()->where('status','=','Aprobado')->get());
                    
                    $songs=0;
                    $aproved_song=0;

                    foreach ($seller->songs()->get() as $key) 
                    {
                        if ($key->album =! NULL or $key->album =! 0) 
                        {
                            $songs++;

                            if ($key->status == 'Aprobado') 
                            {
                                $aproved_song++;   
                            }
                        }  
                    }
                    
                    $musical_content=$Musica+$songs;
                    

                    break;

                case 'Peliculas':
                    $Movies_content=0;
                    break;
                
                case 'Libros':
                    $Books_content=count($seller->Books()->get());

                    $aproved_books=count($seller->Books()->where('status','=','Aprobado')->get());
                    break;
                
                case 'Series':
                    $series_content=0;
                    break;

                case 'Revistas':
                    $Megazine_content=count($seller->Megazines()->get());
                    
                    $aproved_megazines=count($seller->Megazines()->where('status','=','Aprobado')->get());
                    break;

                case 'Radios':
                    $radios_content=count($seller->Radio()->get());
                    
                    $aproved_radio=count($seller->Radio()->where('status','=','Aprobado')->get());
                    break;

                case 'TV':
                    $tv_content=count($seller->Tv()->get());
                    $aproved_tv=count($seller->Tv()->where('status','=','Aprobado')->get());
                    break;
                
                default:
                    # code...
                    break;
            };

        };
        
        $total_content= $tv_content+$radios_content+$Megazine_content+$series_content+$Books_content+$Movies_content+$musical_content;
        
        $aproved_content= $aproved_radio+$aproved_megazines+$aproved_song+$aproved_books+$aproved_musica+$aproved_tv;

        $followers=count($seller->followers()->get());
        
        return view('seller.home')->with('total_content', $total_content)->with('aproved_content', $aproved_content)->with('followers', $followers);
    
    });





});

/*------------------------------------------------------------------
--------------------------------------------------------------------
-------------  FIN DEL MIDDLEWARE DE LOGGEADO  ---------------------
--------------------------------------------------------------------
--------------------------------------------------------------------
*/
