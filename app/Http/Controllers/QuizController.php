<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
class QuizController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$quizs = Quiz::get();

    	return view('admin.quiz.index',compact('quizs'));
    }

    public function show($id){
    	$quiz = Quiz::findOrFail($id);
    	return view('admin.quiz.show',compact('quiz'));
    }

    public function create(){
    	return view('admin.quiz.create');
    }

    public function store(Request $request){
    	$this->validate($request, [
           'quiz_name' => 'required',
           'quiz_type' => 'required',
           'points' => 'required',
        ]);
        $request->merge(['slug' => str_random (5)]);
    	$store = Quiz::create($request->all());
    	return redirect()->route('quiz.index')->withSuccess("Added Successfully.");
    }

    public function edit($id){
    	$quiz = Quiz::findOrFail($id);
    	return view('admin.quiz.update',compact('quiz'));
    }

    public function update(Request $request,$id){
        $this->validate($request, [
           'quiz_name' => 'required',
           'quiz_type' => 'required',
           'points' => 'required',
        ]);
    	$quiz = Quiz::findOrFail($id);
    	$update = $quiz->update($request->all());
        
    	return redirect()->route('quiz.index')->withSuccess("Updated Successfully.");
    }

    public function destroy($id){
    	$delete = Quiz::findOrFail($id)->delete();
    	return redirect()->route('quiz.index')->withSuccess("Deleted Successfully.");
    }

    public function getQuestion($id){
        $question = Question::where('quiz_id',$id)->get();
        return view('admin.quiz.question',compact('question'));
    }
}
