<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/12/2014
 * Time: 11:11
 */
class UserController extends BaseController  {


    private $users = array();
    private $mostActiveUser = "Undefined";
    private $nbMostActiveUser = 0;
    private $maxActivities = 0;
    private $mostMessageUser = "Undefined";
    private $nbMostMessageUser = 0;
    private $maxMessage = 0;
    private $mostSujetUser = "Undefined";
    private $nbMostSujetUser = 0;
    private $maxSujet = 0;
    private $mostDelaiUser = "Undefined";
    private $nbMostDelaiUser = 0;
    private $maxDelai = 0;
    private $ActivitesUser;
    private $nbMsg = 0;

    public function __construct(){
        //$attributs = DB::table('transition')->get(['attribut']);


        //Déclarations



        //Récupérations de la liste des utilisateurs dans $users
        $usersTemp = DB::table('transition')
            ->distinct()
            ->get(['utilisateur']);
        foreach($usersTemp as $u){
            $this->users[]= $u->utilisateur;

        }
        //Recherche de l'utilisateur le plus actif
        $this->mostActiveUser = DB::table('transition')
            ->select(DB::raw('Utilisateur, count(*) as count'))
            ->groupBy('Utilisateur')
            ->orderBy('count','dsc')
            ->first();
        //print_r($this->mostActiveUser);
        $this->nbMostActiveUser = $this->mostActiveUser->count;
        $this->mostActiveUser = $this->mostActiveUser->Utilisateur;
        //echo $this->nbMostActiveUser;

        $this->maxActivities = DB::table('transition')
            ->count();
        //echo $this->maxActivities;

        //Recherche de l'utilisateur répondant au plus de message
        $this->mostMessageUser = DB::table('transition')
            ->select(DB::raw('Utilisateur, count(*) as count'))
            ->where('Attribut','LIKE','%IDMsg%')
            ->where('titre','LIKE','Répondre à un message')
            ->groupBy('Utilisateur')
            ->orderBy('count','dsc')
            ->first();
        //print_r($this->mostActiveUser);
        $this->nbMostMessageUser = $this->mostMessageUser->count;
        $this->mostMessageUser = $this->mostMessageUser->Utilisateur;

        $this->maxMessage = DB::table('transition')
            ->where('Attribut', 'LIKE', '%IDMsg%')
            ->where('titre','LIKE','Répondre à un message')
            ->count();
        //echo $this->maxMessage;

        //Recherche de l'utilisateur Postant le plus de sujets
        $this->mostSujetUser = DB::table('transition')
            ->select(DB::raw('Utilisateur, count(*) as count'))
            ->where('Attribut','LIKE','%IDMsg%')
            ->where('titre','LIKE','Poster un nouveau message')
            ->groupBy('Utilisateur')
            ->orderBy('count','dsc')
            ->first();
        //print_r($this->mostActiveUser);
        $this->nbMostSujetUser = $this->mostSujetUser->count;
        $this->mostSujetUser = $this->mostSujetUser->Utilisateur;
        //echo $this->mostSujetUser;

        $this->maxSujet = DB::table('transition')
            ->where('Attribut', 'LIKE', '%IDMsg%')
            ->where('titre','LIKE','Poster un nouveau message')
            ->count();
        //echo $this->maxSujet;

        //Recherche de l'utilisateur Postant le plus de sujets
        $this->mostDelaiUser = DB::table('transition')
            ->select(DB::raw('Utilisateur, sum(TIME_TO_SEC(Delai)) as TotalTime'))
            ->groupBy('Utilisateur')
            ->orderBy('TotalTime','dsc')
            ->distinct('Utilisateur')
            ->first();
        //print_r($this->mostDelaiUser);
        $this->nbMostDelaiUser = $this->mostDelaiUser->TotalTime;
        //echo date('z/h:i:s', $this->nbMostDelaiUser);
        $this->mostDelaiUser = $this->mostDelaiUser->Utilisateur;
        //echo $this->mostDelaiUser;
        $this->maxDelai = DB::table('transition')
            ->select(DB::raw('sum(TIME_TO_SEC(Delai)) as TotalTime'))
            ->orderBy('TotalTime','dsc')
            ->first();
        //print_r($this->maxDelai);
        $this->maxDelai = $this->maxDelai->TotalTime;
        //echo $this->maxDelai;

        //Graph : Activites pour chaque utilisateur
        $ActivitesUser = array(

            "AfficherStructure" => array(),
            "RepondreMessage" => array(),
            "AfficherFilDiscussion" => array(),
            "PosterNouveauMessage" => array(),
            "AfficherContenuMessage" => array(),
            "BougerScrollbarEnBasEtAfficherFinMessage" => array(),
            "CiterMessage" => array(),
            "BougerScrollbarBas" => array(),
            "DownloaFichierMessage" => array(),
            "nbUserMsg" => array()
        );
        foreach($this->users as $u){
            $this->ActivitesUser["AfficherStructure"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Afficher une structure (cours/forum)')
                ->count();

            $this->ActivitesUser["RepondreMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Répondre à un message')
                ->count();

            $this->ActivitesUser["AfficherFilDiscussion"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Afficher le fil de discussion')
                ->count();

            $this->ActivitesUser["PosterNouveauMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Poster un nouveau message')
                ->count();

            $this->ActivitesUser["AfficherContenuMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Afficher le contenu d\'un message')
                ->count();

            $this->ActivitesUser["BougerScrollbarEnBasEtAfficherFinMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Bouger la scrollbar en bas - afficher la fin du message')
                ->count();

            $this->ActivitesUser["CiterMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Citer un message')
                ->count();

            $this->ActivitesUser["BougerScrollbarBas"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Bouger la scrollbar en bas')
                ->count();

            $this->ActivitesUser["DownloaFichierMessage"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where('titre', 'Download un fichier dans le message')
                ->count();

            $this->ActivitesUser["nbUserMsg"][$u] = DB::table('transition')
                ->where('Utilisateur', 'LIKE', $u)
                ->where(function($query){
                    $query->where('titre', 'Poster un nouveau message')
                        ->orWhere('titre', 'Répondre à un message');
                })
                ->count();
            //echo $u.":".$ActivitesUser["RepondreMessage"][$u].",";
        }
        $this->nbMsg = DB::table('transition')
            ->where(function($query){
                $query->where('titre', 'Poster un nouveau message')
                    ->orWhere('titre', 'Répondre à un message');
            })
            ->count();
        //echo $u.":".$ActivitesUser["RepondreMessage"][$u].",";


}


    public function showusers()
    {

        //echo $this->mostActiveUser;
        return View::make('user')->with('data',array(
            'Users' => $this->users,
            'mostActiveUser' =>$this->mostActiveUser,
            'nbMostActiveUser' => $this->nbMostActiveUser,
            'mostMessageUser' => $this->mostMessageUser,
            'nbMostMessageUser' => $this->nbMostMessageUser,
            'mostSujetUser' => $this->mostSujetUser,
            'nbMostSujetUser' => $this->nbMostSujetUser,
            'mostDelaiUser' => $this->mostDelaiUser,
            'nbMostDelaiUser' => $this->nbMostDelaiUser,
            'maxActivities' => $this->maxActivities,
            'maxMessage' => $this->maxMessage,
            'maxSujet' => $this->maxSujet,
            'maxDelai' => $this->maxDelai,
            'ActivitesUser' => $this->ActivitesUser,
            'nbMsg' => $this->nbMsg
        ));

    }

    public function getInfoByUser($u){
        //$u=Input::get('nom');
        //echo $u;
        //print_r('nb forums = '.$nbForums.', nb messages = '.$nbMsg);
        // Camembert Répartition des activités utilisateurs
        $nbActiviteUser = DB::table('transition')
            ->where('Utilisateur', 'LIKE', $u)
            ->count();

        $nbActiviteTotal = DB::table('transition')
            ->count();

        // $results = DB::select('select DISTINCT Date from transition where attribut LIKE "IDForum='.$id.'%"', array());
        $dates = DB::table('transition')
            ->select(DB::raw('Date, count(*) as count'))
            ->where('Utilisateur', 'LIKE', $u)
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

            if(isset($dates[$size-$i-1])){
                $ActiviteMin[]=$dates[$size-$i-1]->count;
                $DateActiviteMin[]=$dates[$size-$i-1]->Date;
            }
            if(isset($dates[$i]))
            {
                $ActiviteMax[]=$dates[$i]->count;
                $DateActiviteMax[]= $dates[$i]->Date;
            }

            //DateTime::createFromFormat('Y-m-d',$date->Date);
            $i++;

        }
        foreach($dates as $date)
        {

            $totalActivite=$totalActivite+$date->count;
        }

        $sujets = DB::table('transition')
            ->where('Utilisateur', 'LIKE',$u)
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
        if(isset($maxs1))
            $maxActiviteSujet[]=$maxs1;
        $maxNbActiviteSujet[]=$max2;
        if(isset($maxs2))
            $maxActiviteSujet[]=$maxs2;
        $maxNbActiviteSujet[]=$max3;
        if(isset($maxs3))
            $maxActiviteSujet[]=$maxs3;
        $maxNbActiviteSujet[]=$max4;
        if(isset($maxs4))
            $maxActiviteSujet[]=$maxs4;
        $maxNbActiviteSujet[]=$max5;
        if(isset($maxs5))
            $maxActiviteSujet[]=$maxs5;

        $minNbActiviteSujet[]=$min1;
        if(isset($mins1))
            $minActiviteSujet[]=$mins1;
        $minNbActiviteSujet[]=$min2;
        if(isset($mins2))
            $minActiviteSujet[]=$mins2;
        $minNbActiviteSujet[]=$min3;
        if(isset($mins3))
            $minActiviteSujet[]=$mins3;
        $minNbActiviteSujet[]=$min4;
        if(isset($mins4))
            $minActiviteSujet[]=$mins4;
        $minNbActiviteSujet[]=$min5;
        if(isset($mins5))
            $minActiviteSujet[]=$mins5;

        $MinNbForumActivite=array();
        $MinForumActivite=array();
        $MaxNbForumActivite=array();
        $MaxForumActivite=array();

        $forums = DB::table('transition')
            ->where('Utilisateur', 'LIKE', $u)
            ->where('attribut','LIKE','IDForum=%')
            ->get();


        //print_r($forums);
        $forumtab = array();
        $top= array();
        $min= array();
        $tabtemp = array();
        //$top["top"]=0;
        /*foreach($forums as $f){
            $att = parse_attribut($f->Attribut);
            $top[$att['IDForum']]=0;
        }*/

        foreach($forums as $f){
            //$f['att']= array();
            $att = parse_attribut($f->Attribut);
            //$forumtab[]= $att['IDForum']?$att['IDForum']:"";
            //echo $att['IDForum']." ";
            if(!isset($tabtemp[$att['IDForum']])){
                $tabtemp[$att['IDForum']]=0;
            }

            $tabtemp[$att['IDForum']]++;

        }

        $tabtemp2=$tabtemp;
        for ($i=1; $i<6;$i++){
            $top[$i]=array();
            $top[$i][0]="";
            $top[$i][1]=0;

            $min[$i]=array();
            $min[$i][0]="";
            $min[$i][1]=PHP_INT_MAX;

            foreach($tabtemp as $key => $value){
                //echo $key.'->'.$value.' ';
                if($value >$top[$i][1]){
                    $top[$i][0]=$key;
                    $top[$i][1]=$value;
                    //echo $key."->". $value." ";
                }

            }
            foreach($tabtemp2 as $key => $value){
                if($value < $min[$i][1] && $value > -1){
                    $min[$i][0]=$key;
                    $min[$i][1]=$value;
                    //echo $key."->". $value." ";
                }

            }
            //echo "<br>";
            $tabtemp[$top[$i][0]]=0;
            $tabtemp2[$min[$i][0]]=-1;
        }


        //print_r($top);

        $size=0;
        foreach($forums as $f)
        {
            $size++;
        }
        $i=1;
        //print_r($min);
        //print_r($top);
        while($i<6) {

            $MinNbForumActivite[]=$min[$i][1];
            $MinForumActivite[]=$min[$i][0];
            $MaxNbForumActivite[]=$top[$i][1];
            $MaxForumActivite[]= $top[$i][0];

            $i++;

        }
        $nbActiviteUser = DB::table('transition')
            ->where('Utilisateur', 'LIKE', $u)
            ->count();

        $nbActiviteTotal = DB::table('transition')
            ->count();

        //echo $nbActiviteForum/$nbActiviteTotal*100;
        $activities = DB::table('transition')->where('Utilisateur', 'LIKE', $u)->distinct()->get(['titre']);

        $nbActivities = array();
        foreach($activities as $activity){
            $activityName = $activity->titre;
            $nbActivities[$activity->titre] = round((DB::table('transition')->where('Utilisateur', 'LIKE', $u)->where('titre', 'LIKE', $activity->titre)->count())*100/$nbActiviteTotal, 2);
        }


        return View::make('infouser')->with('data',array(
            'user' => $u,
            'ActivitesUser' => $this->ActivitesUser,
            'nbActiviteUser' => $nbActiviteUser,
            'nbActiviteTotal' => $nbActiviteTotal,
            'ActivitesMax' => $ActiviteMax,
            'DateActiviteMax' => $DateActiviteMax,
            'TotalActivite' => $totalActivite,
            'activities'=>$activities,
            'activitiesPercentage'=>$nbActivities,
            'ActivitesMin' => $ActiviteMin,
            'DateActiviteMax' => $DateActiviteMax,
            'DateActiviteMin' => $DateActiviteMin,
            'MaxForumActivite' =>$MaxForumActivite,
            'MaxNbForumActivite' => $MaxNbForumActivite,
            'MinForumActivite' =>$MinForumActivite,
            'MinNbForumActivite' => $MinNbForumActivite,
            'MaxNbActiviteSujet' => $maxNbActiviteSujet,
            'MaxActiviteSujet' => $maxActiviteSujet,
            'MinNbActiviteSujet' => $minNbActiviteSujet,
            'MinActiviteSujet' => $minActiviteSujet
        ));

    }

        /*public function getInfo()
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
        return View::make('infouser')->with('data',array(
            'nbForums'=>$nbForums,
            'nbMsg'=>$nbMsg,
            'forums'=>$forums,
            'nbForumMsg'=>$nbMsgForums,
            'nbSujetsForum'=>$nbSujetsForums,
            'nbVisitesForum'=>$nbVisitesForum,
            'nbReponsesForum'=>$nbReponsesForum,
            'nbUsers'=>$nbUsers,
            'user' => $u
        ));

    }*/






}