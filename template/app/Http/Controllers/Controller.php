<?php

namespace amref\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    private function getAverage($rating)
    {
        foreach ($rating as $rate) {
            $average = ($rate->communication_skills + $rate->goals +$rate->job_knowledge+$rate->management_skills+$rate->organizational_skills+$rate->initiative)/6;
        }
        return $average;
    }

    private function getObjectives($userId)
    {
        $objectives = DB::table('objectives')
                    ->leftJoin('organization_goals', 'objectives.organization_goal', '=', 'organization_goals.organization_goal_id')
                    ->leftJoin('department_goals', 'objectives.department_goal', '=', 'department_goals.department_goal_id')
                    ->select('objectives.*','organization_goals.organization_goal','department_goals.department_goal')
                    ->where('user_id',$userId)
                    ->orderBy('objectives.objective_id', 'asc')
                    ->get();
        return $objectives;
    }

    private function getKpis($userId)
    {
        $kpis = DB::table('kpis')
                    ->leftJoin('objectives', 'kpis.objective_id', '=', 'objectives.objective_id')
                    ->select('kpis.*','objectives.objective')
                    ->where('kpis.user_id',$userId)
                    ->orderBy('kpis.kpi_id', 'asc')
                    ->get();
        return $kpis;
    }

    public function index() {
        if(Session::has('userid'))
            return redirect('profile');
        else
            return redirect('login');
    }

    public function login()
    {
    	if(Input::has('email') && Input::has('password'))
        {
            $email = Input:: get('email');
            $password = Input:: get('password');
            $status = DB::table('users')->where([['email',$email],['password',$password]])->first();
            if($status)
            {
            	Session::put(['name'=> $status->name,
                    'email' =>$status->email,
                    'userid' => $status->id,
                      ]); 
            }
            return redirect('/');
        }
        else
        {
            return view('pages.user-pages.login', ['error' => 'Wrong Username or Password']);
        }

    }
    public function logout()
    {
        Session::flush();
        
        return redirect('/');
    }

    public function profile()
    {
    	$userId =  Session::get('userid');
    	$user = DB::table('users')->where('id',$userId)->first();
        $objectives = $this->getObjectives($userId);
        $kpis = $this->getKpis($userId);
    	return view('profile', ['user' => $user,'kpis'=>$kpis,'objectivesCount'=>count($objectives)]);
    }

    public function addObjectives()
    {
        $userId = Session::get('userid');
        $objectives = DB::table('objectives')
                    ->select(DB::raw('count(*) as objectives_count'))
                    ->where('user_id',$userId)
                    ->groupBy('objective_id')
                    ->get();
        if(count($objectives) >= 5)
        {
            return redirect('objectives')->with('status', 'You cannot add more objectives!');
        }
        else
        {
            return view('addObjectives');
        }
    }

    public function submitObjective()
    {

    	$array = array(
    		'year' => Input::get('year'),
    		'organization_goal' => Input:: get('organization_goal'),
    		'department_goal' => Input::get('department_goal'),
    		'objective' => Input:: get('objective'),
    		'user_id' => Session::get('userid'),
    		'date_added'=> date('Y-m-d H:i:s')
    		);
    	$insertQuery = DB::table('objectives')->insert($array);
    	return redirect('objectives/add')->with('status', 'Objective added successfully!');
    	// return view('addObjectives', ['success' => 'Objective added successfully']);

    }

    public function objectives()
    {
    	// DB::enableQueryLog(); // Enable query log

    	$userId = Session::get('userid');
		$objectives = $this->getObjectives($userId);

		// dd(DB::getQueryLog());
		return view('objectives',['objectives'=>$objectives,'objectivesCount'=>count($objectives)]);

    }

    public function addKPIs()
    {
        $userId = Session::get('userid');

        $kpis = DB::table('kpis')
                    ->leftJoin('objectives', 'kpis.objective_id', '=', 'objectives.objective_id')
                    ->select('kpis.*','objectives.objective')
                    ->where('kpis.user_id',$userId)
                    ->orderBy('kpis.kpi_id', 'asc')
                    ->get();
        if(count($kpis) >= 15)
        {
            return redirect('kpis')->with('status', 'You cannot add more KPIs!');
        }
        else
        {
            $objectiveIds= DB::table('kpis')
                    ->groupBy('objective_id')
                    ->where('user_id',$userId)
                    ->having(DB::raw('count(objective_id)'), '>', 2)
                    ->pluck('objective_id');

            if(!empty($objectiveIds))
            {
                $objectives = DB::table('objectives')
                    ->where('user_id',$userId)
                    ->whereNotIn('objective_id', $objectiveIds)
                    ->orderBy('objective_id', 'asc')
                    ->get();
            }
            else
            {
                $objectives = DB::table('objectives')
                    ->where('user_id',$userId)
                    ->orderBy('objectives.objective_id', 'asc')
                    ->get(); 
            }
    
            return view('addKPIs',['objectives'=>$objectives]);
        }
           
    }

    public function submitKPI()
    {

        $array = array(
            'kpi' => Input::get('kpi'),
            'objective_id' => Input:: get('objective'),
            'user_id' => Session::get('userid'),
            'date_added'=> date('Y-m-d H:i:s')
            );
        $insertQuery = DB::table('kpis')->insert($array);
        return redirect('kpis/add')->with('status', 'KPI added successfully!');

    }

    public function kpis()
    {
        // DB::enableQueryLog(); // Enable query log

        $userId = Session::get('userid');
        $kpis = DB::table('kpis')
                    ->leftJoin('objectives', 'kpis.objective_id', '=', 'objectives.objective_id')
                    ->select('kpis.*','objectives.objective')
                    ->where('kpis.user_id',$userId)
                    ->orderBy('kpis.kpi_id', 'asc')
                    ->get();

        // dd(DB::getQueryLog());
        return view('kpis',['kpis'=>$kpis,'kpisCount'=>count($kpis)]);

    }

    public function addMidReview()
    {
        $userId = Session::get('userid');
        $objectives = DB::table('objectives')
                    ->leftJoin('organization_goals', 'objectives.organization_goal', '=', 'organization_goals.organization_goal_id')
                    ->leftJoin('department_goals', 'objectives.department_goal', '=', 'department_goals.department_goal_id')
                    ->select('objectives.*','organization_goals.organization_goal','department_goals.department_goal')
                    ->where('user_id',$userId)
                    ->orderBy('objectives.objective_id', 'asc')
                    ->get();

        return view('addMidReview',['objectives'=>$objectives,'objectivesCount'=>count($objectives)]);
    }

    public function submitMidReview()
    {
        $userId = Session::get('userid');
        $array = array(
                'organizational_skills' => Input:: get('organizational_skills'),
                'communication_skills' => Input::get('communication_skills'),
                'management_skills' => Input:: get('management_skills'),
                'job_knowledge' => Input:: get('job_knowledge'),
                'initiative' => Input:: get('initiative'),
                'goals' => Input::get('goals'),
                'user_id' => $userId,
                'type'=>'mid',
                'date_added'=> date('Y-m-d H:i:s')
                );
        DB::table('rating')->where([['user_id',$userId],['type','mid']])->delete();
        $insertQuery = DB::table('rating')->insert($array);
        return redirect('review/mid');
    }

    public function midReview()
    {
        $userId = Session::get('userid');
        $rating = DB::table('rating')
                    ->select('*')
                    ->where([['user_id',$userId],['type','mid']])
                    ->get();
        $average = $this->getAverage($rating);

        return view('midReview',['rating'=>$rating,'average'=>$average]);
    }
    //end year
    public function addEndReview()
    {
        $userId = Session::get('userid');
        $objectives = DB::table('objectives')
                    ->leftJoin('organization_goals', 'objectives.organization_goal', '=', 'organization_goals.organization_goal_id')
                    ->leftJoin('department_goals', 'objectives.department_goal', '=', 'department_goals.department_goal_id')
                    ->select('objectives.*','organization_goals.organization_goal','department_goals.department_goal')
                    ->where('user_id',$userId)
                    ->orderBy('objectives.objective_id', 'asc')
                    ->get();

        return view('addEndReview',['objectives'=>$objectives,'objectivesCount'=>count($objectives)]);
    }

    public function submitEndReview()
    {
        $userId = Session::get('userid');
        $array = array(
                'organizational_skills' => Input:: get('organizational_skills'),
                'communication_skills' => Input::get('communication_skills'),
                'management_skills' => Input:: get('management_skills'),
                'job_knowledge' => Input:: get('job_knowledge'),
                'initiative' => Input:: get('initiative'),
                'goals' => Input::get('goals'),
                'user_id' => $userId,
                'type'=>'end',
                'date_added'=> date('Y-m-d H:i:s')
                );
        DB::table('rating')->where([['user_id',$userId],['type','end']])->delete();
        $insertQuery = DB::table('rating')->insert($array);
        return redirect('review/end');
    }

    public function endReview()
    {
        $userId = Session::get('userid');
        $rating = DB::table('rating')
                    ->select('*')
                    ->where([['user_id',$userId],['type','end']])
                    ->get();
        $average = $this->getAverage($rating);

        return view('endReview',['rating'=>$rating,'average'=>$average]);
    }

    public function session()
    {
    	dd(Session::all());
    }

}
