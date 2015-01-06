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

Route::get('forums', 'ForumController@showforums');
Route::get('users', 'UserController@showusers');
Route::get('forum/{id}', 'ForumController@getInfoByForum');
Route::get('user/{id}', 'UserController@getInfoByUser');


Route::get('report/forums', function(){
    $transitions = DB::table('transition')
        //->where('Attribut', 'LIKE', 'IDForum=%')
        ->where('Titre', 'Poster un nouveau message')
        ->orWhere('Titre', 'Repondre a un message')
        ->orderBy('Date', 'desc')
        ->orderBy('Heure')
        //->limit(1000)
        ->get();
    $previous_forum = '';
    $previous_date = '';
    $events = array();
    foreach($transitions as $transition){
        $attrs = parse_attribut($transition->Attribut);

        $events[$attrs['IDForum']]['forum'] = $attrs['IDForum'];

        if($transition->Titre == 'Poster un nouveau message'){
            $events[$attrs['IDForum']]['sujets'][$attrs['IDMsg']]['sujet'] = $attrs['IDMsg'];
            $events[$attrs['IDForum']]['sujets'][$attrs['IDMsg']] = array(
                'sujet' => $attrs['IDMsg'],
                'date' => $transition->Date,
                'heure' => $transition->Heure,
                'user' =>$transition->Utilisateur
            );
        }
        else{
            $events[$attrs['IDForum']]['sujets'][$attrs['IDParent']]['reponses'][$attrs['IDMsg']] = array(
                'message' => $attrs['IDMsg'],
                'date' => $transition->Date,
                'heure' => $transition->Heure,
                'user' =>$transition->Utilisateur
            );
        }

        /*$events[$attrs['IDForum']]['sujets'][$transition->Date]['date'] = $transition->Date;
        $events[$attrs['IDForum']]['sujets'][$transition->Date]['events'][] = array(
            'heure' => $transition->Heure,
            'action' => $transition->Titre,
            'user' =>$transition->Utilisateur
        );*/

    }

    return View::make('report_forums')->with(array('events'=> $events));
});

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