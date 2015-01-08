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
Route::get('listforums', 'ForumController@showListForums');
Route::get('users', 'UserController@showusers');
Route::get('listusers', 'UserController@listusers');
Route::get('forum/{id}', 'ForumController@getInfoByForum');
Route::get('user/{id}', 'UserController@getInfoByUser');


Route::get('report/forums', function () {
    $transitions = DB::table('transition')
        ->where('Attribut', 'LIKE', 'IDForum=%')
        //->where('Titre', 'Poster un nouveau message')
        ->orderBy('Date', 'desc')
        ->orderBy('Heure')
        //->limit(1000)
        ->get();
    $forums = array();
    foreach ($transitions as $transition) {
        $attr = parse_attribut($transition->Attribut);
        if (!empty($attr['IDForum'])) $forums[] = $attr['IDForum'];

    }
    $forums = array_unique($forums);
    $tabSujets = array();
    $tabSujetsForum = array();
    $tabSujetSujet = array();
    $tabSujetsUser = array();
    $tabSujetsDate = array();
    $tabSujetsHeure = array();
    $tabMsgMsg = array();
    $tabMsgSujet = array();
    $tabMsgUser = array();
    $tabMsgDate = array();
    $tabMsgHeure = array();
    $tabMsgTitre = array();
    $i = 0;
    foreach ($forums as $forum) {


        $sujets = DB::table('transition')
            ->where('Attribut', 'LIKE', 'IDForum=' . $forum . '%')
            ->where('Titre', 'Poster un nouveau message')
            ->get();

        foreach ($sujets as $sujet) {
            $attrsujet = parse_attribut($sujet->Attribut);

            $tabSujetsForum[] = $forum;
            $tabSujetSujet[] = $attrsujet['IDMsg'];
            $tabSujetsUser[] = $sujet->Utilisateur;
            $tabSujetsDate[] = $sujet->Date;
            $tabSujetsHeure[] = $sujet->Heure;
            $msgs = array();
            $msgstmp = DB::table('transition')
                ->Where('Attribut', 'LIKE', '%IDMsg=' . $attrsujet['IDMsg'] . "%")
                ->orWhere('Attribut', 'LIKE', '%IDParent=' . $attrsujet['IDMsg'] . "%")
                ->get();
            foreach ($msgstmp as $msgtmp) {
                if ($msgtmp->Titre == 'Répondre à un message' || $msgtmp->Titre == 'Citer un message' || $msgtmp->Titre == 'Upload un ficher avec le message') {
                    $msgs[] = $msgtmp;
                }
            }

            foreach ($msgs as $msg) {

                $attrMsg = parse_attribut($msg->Attribut);
                $tabMsgSujet[] = $attrsujet['IDMsg'];
                $tabMsgMsg[] = $attrMsg['IDMsg'];
                $tabMsgUser[] = $msg->Utilisateur;
                $tabMsgDate[] = $msg->Date;
                $tabMsgHeure[] = $msg->Heure;
                $tabMsgTitre[] = $msg->Titre;
            }
        }
    }


    return View::make('report_forums')->with('data', array(
        'forums' => $forums,
        'sujetsForum' => $tabSujetsForum,
        'sujetSujet' => $tabSujetSujet,
        'sujetUser' => $tabSujetsUser,
        'sujetDate' => $tabSujetsDate,
        'sujetHeure' => $tabSujetsHeure,
        'msgSujet' => $tabMsgSujet,
        'msgMsg' => $tabMsgMsg,
        'msgUser' => $tabMsgUser,
        'msgDate' => $tabMsgDate,
        'msgHeure' => $tabMsgHeure,
        'msgTitre' => $tabMsgTitre
    ));
});

Route::get('report/date', function () {
    $events = DB::table('transition')
        ->select(DB::raw('Utilisateur, Titre, Attribut, Date, Heure'))
        ->orderBy('Date')
        ->orderBy('Heure')
        ->get();
    //print_r($events);
    return View::make('report_date')->with('data', array(
        'events' => $events
    ));
});


/**
 * Fonction qui parse un attribut de la base de données en un tableau associatif
 * avec chaque attribut séparé.
 * @param Attribut mixte tel qu'il est dans la base de données
 * @return Tableau associatif avec tous les attributs
 */
function parse_attribut($attribut)
{
    $attribut = str_replace(',', '&', $attribut);
    parse_str($attribut, $attrs);
    return $attrs;
}