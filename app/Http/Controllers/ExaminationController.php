<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examination;
use App\Question;
use App\QuizTeamMap;
use App\FinalResult;
use App\RawExamination;
use Auth;
use DateTime;
use Carbon\Carbon;
class ExaminationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $mytime = Carbon::now()->tz('Asia/Kolkata');
       
        $currentTime =  $mytime->format('Y-m-d h:i:s', $mytime->now());

        $examination =  FinalResult::where('team_id',Auth::user()['id'])->count();
        $examination_raw = new RawExamination;
        // dd($examination);
        if($examination){
            return redirect('teams/dashboard')->withErrors('You have attempted the quiz already.');
        }
        // $Question = Question::with('quiz')->paginate(10);
        $quizTeamMap = QuizTeamMap::with('quiz.question')->where('team_id',Auth::user()['id'])->first();


        $Question = $quizTeamMap->quiz->question;
        $questionRaw = $quizTeamMap->quiz->question;
        return view('team.demo',compact('Question','quizTeamMap','questionRaw','examination_raw','currentTime'));
    }
    public function examById($id){

        $quizTeamMap = QuizTeamMap::findOrFail($id);
        $Question = $quizTeamMap->quiz->question;
        $questionRaw = $quizTeamMap->quiz->question;

        $mytime = Carbon::now()->tz('Asia/Kolkata');
        // dd($mytime->format('Y-m-d h:i:s'));
        $currentTime =  $mytime->format('Y-m-d h:i:s');

        $examination =  FinalResult::where('team_id',Auth::user()['id'])->where('quiz_id',$quizTeamMap['quiz_id'])->count();
        $examination_raw = new RawExamination;
        // dd($examination);
        if($examination){
            return redirect('teams/dashboard')->withErrors('You have attempted the quiz already.');
        }
        // $Question = Question::with('quiz')->paginate(10);
        // $quizTeamMap = QuizTeamMap::with('quiz.question')->where('team_id',Auth::user()['id'])->first();

        
    	return view('team.demo',compact('Question','quizTeamMap','questionRaw','examination_raw','currentTime'));
    }

    public function store(Request $request){
    	
    	$body = $request->all();
        // dd($body);
        
        if(isset($body['answer'])){
            $arr1 = $body['questId'];

            $arr2 = $body['answer'];
            $array = array();
            $count = min(count($arr1), count($arr2));

            foreach ($arr1 as  $key => $ques_id) {                 
                foreach ($arr2 as  $key2 => $ans_id) {
                    if($ques_id == $key2)
                        $array[$key2] = $ans_id;
                }
            }
            // $array = array_combine($body['questId'],$body['answer']);
            foreach ($array as $key => $arr) { 
                $body['quiz_id'] = $body['quiz_id'];
                $body['team_id'] = $body['team_id'];
                $body['question_id'] = $key;
                $body['answer_id'] = $arr;
                $body['slug'] = str_random (5);
                $body['status'] = 1;
                $save = Examination::create($body);
            }
            $QuizTeamMap =QuizTeamMap::find($body['map_id']);
            $QuizTeamMap->status = 1;
            $QuizTeamMap->save();

            $points = $this->examCount($body['map_id']);
        }else{
            $QuizTeamMap =QuizTeamMap::find($body['map_id']);
            $QuizTeamMap->status = 1;
            $QuizTeamMap->save();
            $points = $this->examCount($body['map_id']);
        }


           
    	return redirect('teams/dashboard')->with('message',"You've got ".$points." points.");
    	//dd("kk");
    }

    public function examCount($map_id){
    	
    	$my_exam = Auth::user()['exam'];
    	$quizTeamMap = QuizTeamMap::findOrFail($map_id);

    	$question = $quizTeamMap->quiz->question;
    	
    	$data = array();
    	foreach($question as $ques){
    		$array = json_decode($ques['option'], true);
    		$keys= array_keys($array);
    		
    		foreach($my_exam as $exam){
	    		
                if ($ques['id'] === $exam['question_id'] && $ques['answer'] === $exam['answer_id']) {
                    $data[] = $exam['question_id'];
                }else{
                    
                }
	    	}
    	}
        
    	$marks = $quizTeamMap->quiz;
    	$points = $marks['points'] * count(array_unique($data));
    	$result['slug'] = str_random(5);
        $result['team_id'] = Auth::user()['id'];
    	$result['quiz_id'] = $marks['id'];
    	$result['points'] = $points;
    	$createPoint= FinalResult::updateOrCreate(['team_id'=>Auth::user()['id'],'quiz_id'=>$marks['id']],$result);
        
    	return $points;

    }

    function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            $quizTeamMap = QuizTeamMap::with('quiz.question')->where('team_id',Auth::user()['id'])->first();

            $examination_raw = new RawExamination;

            $Question = $quizTeamMap->quiz->question()->simplePaginate(1);
            return view('team.pagination_data', compact('Question','examination_raw'))->render();
        }
    }

    public function SaveRaw(Request $request){
        $body = $request->all();
        $raw = RawExamination::where('quiz_id',$body['quiz_id'])->where('team_id',$body['team_id'])->where('question_id',$body['ques_id'])->first();
        if($raw){
            $body['quiz_id'] = $body['quiz_id'];
            $body['team_id'] = $body['team_id'];
            $body['question_id'] = $body['ques_id'];
            $body['answer_id'] = $body['answer_id'];
            $body['status'] = 2;
            $save = $raw->update($body);
        }else{
            $body['quiz_id'] = $body['quiz_id'];
            $body['team_id'] = $body['team_id'];
            $body['question_id'] = $body['ques_id'];
            $body['answer_id'] = $body['answer_id'];
            $body['status'] = 2;
            $save = RawExamination::create($body);
        }
       
        if($save)
            return "success";
        else
            return "failed";
    }

    public function SaveRawAnswer(Request $request){
        $body = $request->all();

        $raw = RawExamination::where('quiz_id',$body['quiz_id'])->where('team_id',$body['team_id'])->where('question_id',$body['ques_id'])->first();
        if($raw){
            $body['quiz_id'] = $body['quiz_id'];
            $body['team_id'] = $body['team_id'];
            $body['question_id'] = $body['ques_id'];
            $body['answer_id'] = $body['answer_id'];
            $body['status'] = 1;
            $save = $raw->update($body);
        }else{
            $body['quiz_id'] = $body['quiz_id'];
            $body['team_id'] = $body['team_id'];
            $body['question_id'] = $body['ques_id'];
            $body['answer_id'] = $body['answer_id'];
            $body['status'] = 1;
            $save = RawExamination::create($body);
        }
       
        if($save)
            return "success";
        else
            return "failed";
    }
}
