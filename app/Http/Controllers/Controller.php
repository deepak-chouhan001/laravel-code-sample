<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\QuizTeamMap;
use Auth;
use DateTime;
use DateTimeZone;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(){
   		
   		$this->middleware(function ($request, $next) {
		    $this->user = auth()->user();
		    
		    $quizTeamMaps = QuizTeamMap::with('quiz.question')->where('status',0)->where('team_id',Auth::user()['id'])->get();
		    // dd($quizTeamMap);
		    foreach($quizTeamMaps as $quizTeamMap){

		    	$examTime = $quizTeamMap['start_date'];
	      
		        $now = new DateTime('Asia/Kolkata');
		        $date = new DateTime($examTime, new DateTimeZone('Asia/Kolkata'));

		        $diffInMinutess = $date->diff($now);
		        // echo $diffInMinutess->format('%h')." ".$quizTeamMap['id']."<br>";
		        $diffInYear = $diffInMinutess->format('%y');
		        $diffInMonth = $diffInMinutess->format('%m');
		        $diffInDay = $diffInMinutess->format('%d');
		        $diffInHours = $diffInMinutess->format('%h');
		        $diffInMinutes = $diffInMinutess->format('%i');
		        $diffInSeconds = $diffInMinutess->format('%s');

		        // $resTime = $diffInHours * 60 + $diffInMinutes;
		       	// dd($date < $now);
		        if($date < $now){

		        	if($diffInYear){
		        		$leftTime = (($diffInYear * 365 * 30 * 24 * 60) * ($diffInMonth * 30 * 24 * 60) * ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
		        		$resTime = 0;
		        	}elseif($diffInMonth){
		        		$leftTime = (($diffInMonth * 30 * 24 * 60) * ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
		        		$resTime = 0;
		        	}elseif($diffInDay){
		            	$leftTime = ( ($diffInDay * 24 * 60) + $diffInHours * 60 + $diffInMinutes);
		            	$resTime = $quizTeamMap['session_time'] - $leftTime;
		            	// dd("ddd");
		            	if($resTime > 0){
		            		return redirect('teams/exam/by/'.$quizTeamMap['id']);
		            	}
		          	}else{
		            	$leftTime = $diffInHours * 60 + $diffInMinutes;
		            	$resTime = $quizTeamMap['session_time'] - $leftTime;
		            	// dd("fff");
		            	if($resTime > 0){
		            		return redirect('teams/exam/by/'.$quizTeamMap['id']);
		            	}
		          	}
		        }
		    }
	        
		    // dd("ccc");
	        return $next($request);
		});
   	}
}
