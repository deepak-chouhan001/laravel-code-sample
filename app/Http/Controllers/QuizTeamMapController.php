<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Team;
use App\User;
use App\QuizTeamMap;
class QuizTeamMapController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index(){
        $quiz_teamMaps = QuizTeamMap::with('team','quiz')->get(); 
        return view('admin.mapping.index',compact('quiz_teamMaps'));
    }

    public function show($id){
        $quiz_teamMaps = QuizTeamMap::with('team','quiz')->findOrFail($id);
        return view('admin.mapping.show',compact('quiz_teamMaps'));
    }

    public function create(){
    	$teams = User::where('role_id',2)->get();
    	$quizes = Quiz::get();
    	$teamMap = new QuizTeamMap; 
    	return view('admin.mapping.create',compact('quizes','teams','teamMap'));
    }

    public function store(Request $request){
    	$request->merge(['slug' => str_random (5)]);
        
        $session_time = $request->hours * 60 + $request->minutes;
        $request->merge(['session_time' => $session_time]);
        $request->merge(['status' => 0]);
        // dd($request->all());
    	$mapping = QuizTeamMap::create($request->all());
    	return redirect()->route('mapping.index')->withSuccess('Added Successfully.');
    }

    public function edit($id){
    	$teams = User::where('role_id',2)->get();
    	$quizes = Quiz::get();
    	$teamMap = new QuizTeamMap;
    	$QuizTeamMap = QuizTeamMap::findOrFail($id);
    	return view('admin.mapping.update',compact('quizes','teams','teamMap','QuizTeamMap'));
    }

    public function update(Request $request , $id){
    	$QuizTeamMap= QuizTeamMap::where('id',$id)->first();

    	$session_time = $request->hours * 60 + $request->minutes;
        $request->merge(['session_time' => $session_time]);
        $request->merge(['status' => 0]);
    	$update = $QuizTeamMap->update($request->all());
    	return redirect()->route('mapping.index');
    }

    public function destroy($id){
        $question = QuizTeamMap::findOrFail($id);
        $question->delete();
        return redirect()->route('mapping.index');
    }

    public function getAjax($quiz_id){

        $teams = User::where('role_id',2)->get();
        $getTeam = array();
        foreach ($teams as $team){
            // echo $team['id']."<br>";
            $mapping = QuizTeamMap::where(['team_id'=>$team['id'],'quiz_id'=>$quiz_id])->first();
           
            if($mapping['team_id'] !== $team['id']){
                $getTeam[] = $team;
            }
        }

        return response($getTeam,200);

    }
}
