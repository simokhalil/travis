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
        $maxMsgs =0;
        $maxMsgForum=0;
        $maxSujets =0;
        $maxSujetsForum=0;
        $maxVisites =0;
        $maxVisitesForum=0;
        $maxReponses =0;
        $maxReponsesForum=0;

        foreach($forums as $forum){
            $nbForumMsg = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where(function($query){
                    $query->where('titre', 'Poster un nouveau message')
                        ->orWhere('titre', 'Répondre à un message');
                })->count();
            $nbMsgForums[$forum] = $nbForumMsg;
            if($maxMsgs<$nbForumMsg)
            {
                $maxMsgs=$nbForumMsg;
                $maxMsgForum=$forum;
            }
            $nbSujetsForums[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Poster un nouveau message')
                ->count();
            if($maxSujets<$nbSujetsForums[$forum])
            {
                $maxSujets=$nbSujetsForums[$forum];
                $maxSujetsForum=$forum;
            }
            $nbVisitesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Afficher une structure (cours/forum)')
                ->count();
            if($maxVisites<$nbVisitesForum[$forum])
            {
                $maxVisites=$nbVisitesForum[$forum];
                $maxVisitesForum=$forum;
            }
            $nbReponsesForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Répondre à un message')
                ->count();
            if($maxReponses<$nbReponsesForum[$forum])
            {
                $maxReponses=$nbReponsesForum[$forum];
                $maxReponsesForum=$forum;
            }
        }

        $nbForums = count($forums);
        $nbMsg = count($msgs);

        $nbUsers = DB::table('transition')->distinct()->get(['utilisateur']);
        $nbUsers = count($nbUsers);

        $dates = DB::table('transition')
            ->select(DB::raw('Date, count(*) as count'))
            ->groupBy('Date')
            ->get();
        $activitesParDate =  array();


        foreach($dates as $date)
        {
            $activitesParDate[]=array(DateTime::createFromFormat('Y-m-d',$date->Date), $date->count);
        }
        //print_r('nb forums = '.$nbForums.', nb messages = '.$nbMsg);
        return View::make('forums')->with('data',array(
            'nbForums'=>$nbForums,
            'nbMsg'=>$nbMsg,
            'forums'=>$forums,
            'nbForumMsg'=>$nbMsgForums,
            'nbSujetsForum'=>$nbSujetsForums,
            'nbVisitesForum'=>$nbVisitesForum,
            'nbReponsesForum'=>$nbReponsesForum,
            'nbUsers'=>$nbUsers,
            'dates' => $dates,
            'activites' => $activitesParDate,
            'maxMsgs' =>$maxMsgForum,
            'maxSujets' =>$maxSujetsForum,
            'maxVisites' =>$maxVisitesForum,
            'maxReponses' =>$maxReponsesForum
        ));
	}

}
