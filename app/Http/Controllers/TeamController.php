<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FinalResult;
use App\Students;
use App\QuizTeamMap;
use App\Question;
use App\Quiz;
use Auth;
use Carbon\Carbon;
class TeamController extends Controller
{
    //Logic to check user is logged in or not
    public function __construct(){
        $this->middleware('auth');
        parent::__construct();
        // $this->middleware('auth:teams');
    }

    //Team index view load
    public function index()
    {
        $points = FinalResult::where('team_id',Auth::user()['id'])->get();
    	$students = Students::where('team_id',Auth::user()['id'])->get();
    	$count = 0;

        $quizTeamMaps = QuizTeamMap::where('team_id',Auth::user()['id'])->pluck('quiz_id');
        // dd($quizTeamMaps);
        $question = array();
        $quiz = array();
        $array = array();
        foreach ($quizTeamMaps as $value) {
            $text = Quiz::findOrFail($value);
            $quest = Question::where('quiz_id',$value)->count();
            
            foreach($points as $point){
                if($point['quiz_id'] == $text['id']){
                    $count = $point['points'];
                    $array['marks'][$value] = $count;
                    $array['total'][$value] = $text['points'] * $quest;
                }
            }
        }
        $myMarks = array();
        if($array){
            foreach($array['total'] as $key => $arr1){
                foreach($array['marks'] as $key2 => $arr2){
                    if($key === $key2){
                        $x = $arr2;
                        $total = $arr1;
                        $percentage = ($x*100)/$total;
                        $myMarks[$key] = $percentage;
                    }
                }
            }
        }
        
        return view('home1',compact('count','students','myMarks'));
    }

    public function teamResult()
    {
            /*$finalResult = FinalResult::where('points','!=',0)->with('teams')->orderBy('points','DESC')->get();       
            $users = User::where('role_id',2)->count();  */     
            $quizTeamMaps = QuizTeamMap::where('team_id',Auth::user()['id'])->get();             
        
            
        return view('team_result',compact('quizTeamMaps'));
    }

    
    
}
