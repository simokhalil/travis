<?php

class ForumController extends BaseController {

    public $ActivitesForum;
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
        $nbUploadForum=array();
        $nbCitationForum=array();
        $maxMsgs =0;
        $maxMsgForum=0;
        $maxSujets =0;
        $maxSujetsForum=0;
        $maxVisites =0;
        $maxVisitesForum=0;
        $maxReponses =0;
        $maxReponsesForum=0;
        $maxUpload=0;
        $maxUploadForum=0;
        $maxCitation=0;
        $maxCitationForum=0;
        $Visites=0;
        $Reponses=0;
        $Sujets=0;
        $Uploads=0;
        $citations=0;
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

            $nbUploadForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Upload un ficher avec le message')
                ->count();

            if($maxUpload<$nbUploadForum[$forum])
            {

                $maxUpload=$nbUploadForum[$forum];
                $maxUploadForum=$forum;
            }

            $nbCitationForum[$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Citer un message')
                ->count();

            if($maxCitation<$nbCitationForum[$forum])
            {

                $maxCitation=$nbCitationForum[$forum];
                $maxCitationForum=$forum;
            }


            $Visites=$Visites+$nbVisitesForum[$forum];
            $Reponses=$Reponses+$nbReponsesForum[$forum];
            $Sujets=$Sujets+$nbSujetsForums[$forum];
            $Uploads=$Uploads+$nbUploadForum[$forum];
            $citations=$citations+$nbCitationForum[$forum];

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

        //Stacked column chart
        /*contient :
            Afficher une structure (cours/forum)
            Répondre à un message
            Afficher le fil de discussion
            Poster un nouveau message
            Afficher le contenu d'un message
            Bouger la scrollbar en bas - afficher la fin du message
            Citer un message
            Bouger la scrollbar en bas
            Download un fichier dans le message
        */
        $ActivitesForum = array(

            "AfficherStructure" => array(),
            "RepondreMessage" => array(),
            "AfficherFilDiscussion" => array(),
            "PosterNouveauMessage" => array(),
            "AfficherContenuMessage" => array(),
            "BougerScrollbarEnBasEtAfficherFinMessage" => array(),
            "CiterMessage" => array(),
            "BougerScrollbarBas" => array(),
            "DownloaFichierMessage" => array(),
        );
        foreach($forums as $forum){
            $ActivitesForum["AfficherStructure"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Afficher une structure (cours/forum)')
                ->count();

            $ActivitesForum["RepondreMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Répondre à un message')
                ->count();

            $ActivitesForum["AfficherFilDiscussion"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Afficher le fil de discussion')
                ->count();

            $ActivitesForum["PosterNouveauMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Poster un nouveau message')
                ->count();

            $ActivitesForum["AfficherContenuMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Afficher le contenu d\'un message')
                ->count();

            $ActivitesForum["BougerScrollbarEnBasEtAfficherFinMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Bouger la scrollbar en bas - afficher la fin du message')
                ->count();

            $ActivitesForum["CiterMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Citer un message')
                ->count();

            $ActivitesForum["BougerScrollbarBas"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Bouger la scrollbar en bas')
                ->count();

            $ActivitesForum["DownloaFichierMessage"][$forum] = DB::table('transition')
                ->where('attribut', 'LIKE', 'IDForum='.$forum.'%')
                ->where('titre', 'Download un fichier dans le message')
                ->count();
            //echo $forum.":".$ActivitesForum["DownloaFichierMessage"][$forum].",";
        }


        return View::make('forums')->with('data',array(
            'nbForums'=>$nbForums,
            'nbMsg'=>$nbMsg,
            'forums'=>$forums,
            'nbForumMsg'=>$nbMsgForums,
            'nbSujetsForum'=>$nbSujetsForums,
            'nbVisitesForum'=>$nbVisitesForum,
            'nbReponsesForum'=>$nbReponsesForum,
            'nbUploadsForum' =>$nbUploadForum,
            'nbCitationsForum' => $nbCitationForum,
            'nbUsers'=>$nbUsers,
            'dates' => $dates,
            'activites' => $activitesParDate,
            'maxMsgs' =>$maxMsgForum,
            'maxUploads'=>$maxUploadForum,
            'maxCitations' => $maxCitationForum,
            'maxSujets' =>$maxSujetsForum,
            'maxVisites' =>$maxVisitesForum,
            'maxReponses' =>$maxReponsesForum,
            'nbVisites' => $Visites,
            'nbReponses' => $Reponses,
            'nbSujets' => $Sujets,
            'nbUploads' => $Uploads,
            'nbCitation' => $citations,
            'ActivitesForum' => $ActivitesForum
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
            ->orderBy('count','dsc')
            ->get();

        $totalActivite=0;
        $ActiviteMax=array();
        $DateActiviteMax=array();
        $ActiviteMin=array();
        $DateActiviteMin=array();
        $size=0;
        $i=0;
        foreach($dates as $date)
        {
            $size++;
        }

       while($i<5) {

                $ActiviteMin[]=$dates[$size-$i-1]->count;
                $DateActiviteMin[]=$dates[$size-$i-1]->Date;
                $ActiviteMax[]=$dates[$i]->count;
                $DateActiviteMax[]= $dates[$i]->Date;
                    //DateTime::createFromFormat('Y-m-d',$date->Date);
                $i++;

        }
        foreach($dates as $date)
        {

            $totalActivite=$totalActivite+$date->count;
        }

        $sujets = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('titre', 'Poster un nouveau message')
            ->get(['Attribut']);

        $maxNbActiviteSujet=array();
        $maxActiviteSujet=array();
        $minNbActiviteSujet=array();
        $minActiviteSujet=array();
        $max1=0;
        $max2=0;
        $max3=0;
        $max4=0;
        $max5=0;

        $min1= PHP_INT_MAX;
        $min2= PHP_INT_MAX;
        $min3= PHP_INT_MAX;
        $min4= PHP_INT_MAX;
        $min5= PHP_INT_MAX;



        foreach ($sujets as $s) {
            $attrs = parse_attribut($s->Attribut);

            $nbActiviteSujet= DB::table('transition')
                             ->where('Attribut','LIKE', '%IDMsg='.$attrs['IDMsg'].'%')
                             ->orWhere('Attribut','LIKE', '%IDParent='.$attrs['IDMsg'])
                             ->count();
            if($nbActiviteSujet>=$max5)
            {
                if($nbActiviteSujet>=$max4)
                {
                       if($nbActiviteSujet>=$max3) {

                               if($nbActiviteSujet>=$max2) {
                                  if($nbActiviteSujet>=$max1) {
                                      $max1=$nbActiviteSujet;
                                      $maxs1=$attrs['IDMsg'];
                                  }
                                  else
                                  {
                                       $max2=$nbActiviteSujet;
                                       $maxs2=$attrs['IDMsg'];
                                  }
                               }
                               else
                               {
                                 $max3=$nbActiviteSujet;
                                 $maxs3=$attrs['IDMsg'];
                               }

                       }
                        else
                        {
                             $max4=$nbActiviteSujet;
                             $maxs4=$attrs['IDMsg'];
                        }
                }
                else
                {
                    $max5=$nbActiviteSujet;
                    $maxs5=$attrs['IDMsg'];
                }

            }


            if($nbActiviteSujet<=$min5)
            {
                if($nbActiviteSujet<=$min4)
                {
                    if($nbActiviteSujet<=$min3) {

                        if($nbActiviteSujet<=$min2) {
                            if($nbActiviteSujet<=$min1) {
                                $min1=$nbActiviteSujet;
                                $mins1=$attrs['IDMsg'];
                            }
                            else
                            {
                                $min2=$nbActiviteSujet;
                                $mins2=$attrs['IDMsg'];
                            }
                        }
                        else
                        {
                            $min3=$nbActiviteSujet;
                            $mins3=$attrs['IDMsg'];
                        }

                    }
                    else
                    {
                        $min4=$nbActiviteSujet;
                        $mins4=$attrs['IDMsg'];
                    }
                }
                else
                {
                    $min5=$nbActiviteSujet;
                    $mins5=$attrs['IDMsg'];
                }

            }


        }
        $maxNbActiviteSujet[]=$max1;
        $maxActiviteSujet[]=$maxs1;
        $maxNbActiviteSujet[]=$max2;
        $maxActiviteSujet[]=$maxs2;
        $maxNbActiviteSujet[]=$max3;
        $maxActiviteSujet[]=$maxs3;
        $maxNbActiviteSujet[]=$max4;
        $maxActiviteSujet[]=$maxs4;
        $maxNbActiviteSujet[]=$max5;
        $maxActiviteSujet[]=$maxs5;

        $minNbActiviteSujet[]=$min1;
        $minActiviteSujet[]=$mins1;
        $minNbActiviteSujet[]=$min2;
        $minActiviteSujet[]=$mins2;
        $minNbActiviteSujet[]=$min3;
        $minActiviteSujet[]=$mins3;
        $minNbActiviteSujet[]=$min4;
        $minActiviteSujet[]=$mins4;
        $minNbActiviteSujet[]=$min5;
        $minActiviteSujet[]=$mins5;

        $MinNbUserActivite=array();
        $MinUserActivite=array();
        $MaxNbUserActivite=array();
        $MaxUserActivite=array();

        $i=0;
        $users = DB::table('transition')
            ->select(DB::raw('Utilisateur, count(*) as count'))
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->groupBy('utilisateur')
            ->orderBy('count','dsc')
            ->get();
        $size=0;
        foreach($users as $u)
        {
            $size++;
        }
        $i=0;
        while($i<5) {

            $MinNbUserActivite[]=$users[$size-$i-1]->count;
            $MinUserActivite[]=$users[$size-$i-1]->Utilisateur;
            $MaxNbUserActivite[]=$users[$i]->count;
            $MaxUserActivite[]= $users[$i]->Utilisateur;

            $i++;

        }
        /*foreach ($users as $u) {
            $activiteUser= DB::table('transition')
                           ->where('Attribut','LIKE', '%IDForum='.$id.'%')
                           ->where('utilisateur', 'LIKE' , $u->utilisateur)
                         ->count();

            if($MaxNbUserActivite<$activiteUser)
            {
                $MaxNbUserActivite=$activiteUser;
                $MaxUserActivite=$u->utilisateur;
            }


        }*/

        // Camembert Répartition des activités utilisateurs
        $nbActiviteForum = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->count();

        $nbActiviteTotal = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum=%')
            ->count();

        //echo $nbActiviteForum/$nbActiviteTotal*100;
        $activities = DB::table('transition')->where('attribut', 'LIKE', 'IDForum='.$id.'%')->distinct()->get(['titre']);

        $nbActivities = array();
        foreach($activities as $activity){
            $activityName = $activity->titre;
            $nbActivities[$activity->titre] = round((DB::table('transition')->where('attribut', 'LIKE', 'IDForum='.$id.'%')->where('titre', 'LIKE', $activity->titre)->count())*100/$nbActiviteTotal, 2);
        }

        /*foreach ($users as $u) {
            $ReponseUser= DB::table('transition')
                ->where('Attribut','LIKE', '%IDForum='.$id.'%')
                ->where('utilisateur', 'LIKE' , $u->utilisateur)
                ->where('titre','')
                ->count();

            if($MaxNbUserActivite<$activiteUser)
            {
                $MaxNbUserActivite=$activiteUser;
                $MaxUserActivite=$u->utilisateur;
            }
        }*/

        $historique = DB::table('transition')
            ->where('attribut', 'LIKE', 'IDForum='.$id.'%')
            ->where('date','=','2009-02-23')
            ->get();

        $historiqueUser=array();
        $historiqueTitre=array();
        $historiqueDate=array();
        $historiqueTime=array();
        foreach($historique as $h){
            $historiqueUser[]=$h->Utilisateur;
            $historiqueTitre[]=$h->Titre;
            $historiqueDate[]=$h->Date;
            $historiqueTime[]=$h->Heure;

        }
        $nbSujetsTotal = DB::table('transition')->where('titre','Poster un nouveau message')->count();

        $nbReponsesTotal = DB::table('transition')->where('titre','Poster un nouveau message')->count();
        $nbusersTotal = DB::table('transition')
            ->select(DB::raw('Utilisateur, count(*) as count'))

            ->distinct()

            ->count();
        $nbVistes=DB::table('transition')->where('titre','Afficher une structure (cours/forum)')->count();
        $nbMsgTotal= $nbSujetsTotal+$nbReponsesTotal;
        //echo $nbSujetsForums;

        //echo $nbSujetsTotal;
        return View::make('infoforum')->with('data',array(
            'nbVisites'=>$nbVisitesForum,
            'nbUtilisateurs' => $nbUsers,
            'nbReponses' => $nbReponsesForum,
            'nbSujets' => $nbSujetsForums,
            'nbMsgs' => $nbForumMsg,
            'ActivitesMax' => $ActiviteMax,
            'DateActiviteMax' => $DateActiviteMax,
            'ActivitesMin' => $ActiviteMin,
            'DateActiviteMin' => $DateActiviteMin,
            'TotalActivite' => $totalActivite,
            'MaxNbActiviteSujet' => $maxNbActiviteSujet,
            'MaxActiviteSujet' => $maxActiviteSujet,
            'MinNbActiviteSujet' => $minNbActiviteSujet,
            'MinActiviteSujet' => $minActiviteSujet,
            'MaxUserActivite' =>$MaxUserActivite,
            'MaxNbUserActivite' => $MaxNbUserActivite,
            'MinUserActivite' =>$MinUserActivite,
            'MinNbUserActivite' => $MinNbUserActivite,
            'nbActiviteForum' => $nbActiviteForum,
            'nbActiviteTotal' => $nbActiviteTotal,
            'idForum' => $id,
            'activities'=>$activities,
            'activitiesPercentage'=>$nbActivities,
            'historiqueUser'=>$historiqueUser,
            'historiqueTitre'=>$historiqueTitre,
            'historiqueDate'=>$historiqueDate,
            'historiqueTime'=>$historiqueTime,
            'nbSujetTotal'=>$nbSujetsTotal,
            'nbMsgTotal' => $nbMsgTotal,
            'nbReponseTotal' => $nbReponsesTotal,
            'nbUserTotal' =>$nbusersTotal,
            'nbVisiteTotal' => $nbVistes

        ));
    }

}
