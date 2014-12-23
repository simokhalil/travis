<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/12/2014
 * Time: 11:11
 */
class UserController extends BaseController  {



        public function getInfo()
    {
        return View::make('user');
    }

        public function postInfo()
    {
        $u=Input::get('nom');

        $attributs = DB::table('transition')->where('Utilisateur','LIKE',$u )->get(['attribut']);

        $forums = array();
        $msgs = array();
        foreach($attributs as $attribut){
            $attr = parse_attribut($attribut->attribut);
            if(!empty($attr['IDForum'])) $forums[] = $attr['IDForum'];
            if(!empty($attr['IDMsg'])) $msgs[] = $attr['IDMsg'];
        }
        $forums = array_unique($forums);
        $msgs = array_unique($msgs);

        $nbMsgForums = array();
        $nbSujetsForums = array();
        $nbVisitesForum = array();
        $nbReponsesForum = array();

        foreach($forums as $forum){
            $nbForumMsg = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('Utilisateur','LIKE',$u )
                ->where(function($query){
                    $query->where('titre', 'Poster un nouveau message')
                        ->orWhere('titre', 'Répondre à un message');

                })->count();
            $nbMsgForums[$forum] = $nbForumMsg;

            $nbSujetsForums[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('Utilisateur','LIKE',$u )
                ->where('titre', 'Poster un nouveau message')
                ->count();

            $nbVisitesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('Utilisateur','LIKE',$u )
                ->where('titre', 'Afficher une structure (cours/forum)')
                ->count();

            $nbReponsesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('Utilisateur','LIKE',$u )
                ->where('titre', 'Répondre à un message')
                ->count();
        }

        $nbForums = count($forums);
        $nbMsg = count($msgs);

        $nbUsers = DB::table('transition')->distinct()->get(['utilisateur']);
        $nbUsers = count($nbUsers);


        //print_r('nb forums = '.$nbForums.', nb messages = '.$nbMsg);
        return View::make('forums')->with('data',array(
            'nbForums'=>$nbForums,
            'nbMsg'=>$nbMsg,
            'forums'=>$forums,
            'nbForumMsg'=>$nbMsgForums,
            'nbSujetsForum'=>$nbSujetsForums,
            'nbVisitesForum'=>$nbVisitesForum,
            'nbReponsesForum'=>$nbReponsesForum,
            'nbUsers'=>$nbUsers
        ));

    }

    function parse_attribut($attribut){
        $attribut = str_replace(',','&',$attribut);
        parse_str($attribut, $attrs);
        return $attrs;
    }




}