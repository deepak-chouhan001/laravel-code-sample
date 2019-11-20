<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class TeamLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = 'teams/dashboard';
    
    //For team login using middleware
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }
    
    //Team login page view load
    public function TeamLoginForm(Request $request){
    	
    	return view('auth.user_login');
    }

    //Login post logic for team
    public function TeamLogin(Request $request){
        $this->validate($request, [
           'team_id' => 'required',
           'password' => 'required',
        ]);
        $team = User::where('unique_id',$request->team_id)->first();
        
        if($team == null){
            return redirect()->back()->withErrors(trans('auth.failed'));
        }elseif(count($team['members']) >= 1){
            if($team && $team->isTeam()){

                if(Hash::check($request->password,$team->password)){
                    
                    if($team->isLoggedIn())
                        return redirect()->back()->withErrors("It seems that you are already logged in.");

                    Auth::attempt(['unique_id' => $request->team_id,'password' => $request->password]);
                    $string = str_random(25);
                    
                    $team->update(['login_token' => str_shuffle($string)]);
                    return redirect()->intended('teams/dashboard')->withSuccess(trans('auth.loggedIn'));
                }else{
                    return redirect()->back()->withErrors(trans('auth.failed'));
                }
            }else{                            
                return redirect()->back()->withErrors(trans('auth.failed'));
            } 
        }{
            return redirect()->back()->withErrors("Need atleast one member to log in.");
        }      
        
    }

    public function TeamLoginOld(Request $request){
    	$this->validate($request, [
           'team_id' => 'required',
           'password' => 'required',
        ]);
    	$team = Team::where('unique_id',$request->team_id)->first();
    	// dd($team);
    	if($team){

            if($team->isLoggedIn())
                return redirect()->back()->withErrors("It seems that you are already logged in.");

    		if(Hash::check($request->password,$team->password)){
    			
	    		Auth::guard('teams')->attempt(['unique_id' => $request->team_id,'password' => $request->password]);
                $string = str_random(25);
                
                $team->update(['login_token' => str_shuffle($string)]);
	    		return redirect()->intended('teams/dashboard');
	    	}else{
	    		return redirect()->back()->withErrors(trans('auth.failed'));
	    	}
    	}else{                            
            return redirect()->back()->withErrors(trans('auth.failed'));
    	}   	
    	
    }

    //Logout team logic
    public function logout(Request $request)
    {        
        if($request->has('userid')){  
                  
            $nullToken =  User::findOrFail($request->userid);
            $nullToken->login_token = '';
            $nullToken->save();
        }        
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }
    
    public function logoutOld(Request $request)
    {        
        if($request->has('userid')){            
            $nullToken =  Team::findOrFail($request->userid);
            $nullToken->login_token = '';
            $nullToken->save();
        }        
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }
}
