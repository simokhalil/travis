<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showDashboard()
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

        $nbForums = count($forums);
        $nbMsg = count($msgs);

        $nbUsers = DB::table('transition')->distinct()->get(['utilisateur']);
        $nbUsers = count($nbUsers);

        $activities = DB::table('transition')->distinct()->get(['titre']);
        $nbActivitiesTotal = DB::table('transition')->count();
        $total = 0;
        $nbActivities = array();
        foreach($activities as $activity){
            $activityName = $activity->titre;
            $nbActivities[$activity->titre] = round((DB::table('transition')->where('titre', 'LIKE', $activity->titre)->count())*100/$nbActivitiesTotal, 2);
        }


        //print_r('nb forums = '.$nbForums.', nb messages = '.$nbMsg);
        return View::make('dashboard')->with('data',array(
            'nbForums'=>$nbForums,
            'nbMsg'=>$nbMsg,
            'nbUsers'=>$nbUsers,
            'activities'=>$activities,
            'activitiesPercentage'=>$nbActivities
        ));
	}

}
