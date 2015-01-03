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
        $Visites=0;
        $Reponses=0;
        $Sujets=0;
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
            $Visites=$Visites+$nbVisitesForum[$forum];
            $Reponses=$Reponses+$nbReponsesForum[$forum];
            $Sujets=$Sujets+$nbSujetsForums[$forum];
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
            'maxReponses' =>$maxReponsesForum,
            'nbVisites' => $Visites,
            'nbReponses' => $Reponses,
            'nbSujets' => $Sujets
        ));
	}
    public function getInfoByForum($id)
    {
        $nbVisitesForum = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('titre', 'Afficher une structure (cours/forum)')
            ->count();

        $nbUtilisateursForum = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->distinct()
            ->get(['utilisateur']);
        foreach ($nbUtilisateursForum as $u) {
            if(!empty($u)) $Users[] = $u;

        }
        $nbReponsesForum = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('titre', 'Répondre à un message')
            ->count();

        $nbSujetsForums = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('titre', 'Poster un nouveau message')
            ->count();
        $nbUsers=count($nbUtilisateursForum);
        $nbForumMsg = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where(function($query){
                $query->where('titre', 'Poster un nouveau message')
                    ->orWhere('titre', 'Répondre à un message');
            })->count();

       // $results = DB::select('select DISTINCT Date from transition where attribut LIKE "IDForum='.$id.'%"', array());
        $dates = DB::table('transition')
            ->select(DB::raw('Date, count(*) as count'))
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->groupBy('Date')
            ->get();
        $totalActivite=0;
        $ActiviteMax=0;
        $DateActiviteMax=0;
        foreach ($dates as $date) {

            if($date->count>$ActiviteMax)
            {
                $ActiviteMax=$date->count;
                $DateActiviteMax= DateTime::createFromFormat('Y-m-d',$date->Date);

            }
            $totalActivite=$totalActivite+$date->count;

        }
        $sujets = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('titre', 'Poster un nouveau message')
            ->get(['Attribut']);
        $maxActivite=0;
        $maxActiviteSujet=0;
        foreach ($sujets as $s) {
            $attrs = parse_attribut($s->Attribut);

            $nbActiviteSujet= DB::table('transition')
                             ->where('Attribut','LIKE', '%IDMsg='.$attrs['IDMsg'].'%')
                             ->orWhere('Attribut','LIKE', '%IDParent='.$attrs['IDMsg'])
                             ->count();

            if($maxActivite<$nbActiviteSujet)
            {
                $maxActivite=$nbActiviteSujet;
                $maxActiviteSujet=$attrs['IDMsg'];
            }

        }
        $MaxNbUserActivite=0;
        $MaxUserActivite=0;
        $users = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->distinct()
            ->get(['utilisateur']);
        foreach ($users as $u) {
            $activiteUser= DB::table('transition')
                           ->where('Attribut','LIKE', '%IDForum='.$id.'%')
                           ->where('utilisateur', 'LIKE' , $u->utilisateur)
                           ->count();
            echo $u->utilisateur.' = '.$activiteUser.' ';
            if($MaxNbUserActivite<$activiteUser)
            {
                $MaxNbUserActivite=$activiteUser;
                $MaxUserActivite=$u->utilisateur;
            }


        }

        return View::make('infoforum')->with('data',array(
            'nbVisites'=>$nbVisitesForum,
            'nbUtilisateurs' => $nbUsers,
            'nbReponses' => $nbReponsesForum,
            'nbSujets' => $nbSujetsForums,
            'nbMsgs' => $nbForumMsg,
            'ActivitesMax' => $ActiviteMax,
            'DateActiviteMax' => date_format($DateActiviteMax,'Y-m-d'),
            'TotalActivite' => $totalActivite,
            'MaxActivite' => $maxActivite,
            'MaxActiviteSujet' => $maxActiviteSujet,
            'MaxUserActivite' =>$MaxUserActivite,
            'MaxNbUserActivite' => $MaxNbUserActivite



        ));
    }

}
