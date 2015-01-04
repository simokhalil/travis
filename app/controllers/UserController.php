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
        return View::make('infouser')->with('data',array(
            'user' => $u
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