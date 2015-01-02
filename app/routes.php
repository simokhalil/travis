<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/* Afficher le dashboard */
Route::get('/', 'HomeController@showDashboard');

Route::get('forums', 'ForumController@postInfoForum');
Route::get('users', 'UserController@getInfo');
Route::post('users', 'UserController@postInfo');


Route::get('test2', function(){
    return View::make('test');
});

/* Test */
Route::get('test1', function(){
    $test = DB::table('transition')->where('idTran', 24)->get(['attribut']);

    $attrs = parse_attribut($test[0]->attribut);

    print("Login : ".$attrs['login']);
});


/**
 * Fonction qui parse un attribut de la base de données en un tableau associatif
 * avec chaque attribut séparé.
 * @param Attribut mixte tel qu'il est dans la base de données
 * @return Tableau associatif avec tous les attributs
 */
function parse_attribut($attribut){
    $attribut = str_replace(',','&',$attribut);
    parse_str($attribut, $attrs);
    return $attrs;
}