<?php

class ForumController extends BaseController {

	public function showforums()
	{
        $attributs = DB::table('transition')->get(['attribut']);

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
                ->where(function($query){
                    $query->where('titre', 'Poster un nouveau message')
                        ->orWhere('titre', 'Répondre à un message');
                })->count();
            $nbMsgForums[$forum] = $nbForumMsg;

            $nbSujetsForums[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Poster un nouveau message')
                ->count();

            $nbVisitesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Afficher une structure (cours/forum)')
                ->count();

            $nbReponsesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
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
    public function postInfoForum()
    {
        //$f=Input::get('forum');
        $dates = DB::table('transition')->distinct()->get(['Date']);
        $activitesParDate =  array();


        foreach($dates as $date)
        {
            $activitesParDate[]=DB::table('transition')->where('date','=',$date->Date)->count();
        }
        return View::make('forums')->with('data',$activitesParDate);
       /* return View::make('forums')->with('data',array(
            'dates' => $dates,
            'activites' => $activitesParDate
        ));*/

    }
}
