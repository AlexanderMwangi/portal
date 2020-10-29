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
        
        return redirect('login');
    }

    public function profile()
    {
    	$userId =  Session::get('userid');
    	$user = DB::table('users')->where('id',$userId)->first();
    	return view('profile', ['user' => $user]);
    }

    public function addObjectives()
    {
        return view('addObjectives');
    }

    public function addKPIs()
    {
        return view('addKPIs');
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
		$objectives = DB::table('objectives')
					->leftJoin('organization_goals', 'objectives.organization_goal', '=', 'organization_goals.organization_goal_id')
					->leftJoin('department_goals', 'objectives.department_goal', '=', 'department_goals.department_goal_id')
					->select('objectives.*','organization_goals.organization_goal','department_goals.department_goal')
					->where('user_id',$userId)
					->orderBy('objectives.objective_id', 'asc')
					->get();

		// dd(DB::getQueryLog());
		return view('objectives',['objectives'=>$objectives,'objectivesCount'=>count($objectives)]);

    }

    public function session()
    {
    	dd(Session::all());
    }

}
