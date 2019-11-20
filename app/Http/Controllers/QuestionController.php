<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Quiz;
class QuestionController extends Controller
{
    public function index(){
    	$question = Question::with('quiz')->get();
        
    	return view("admin.question.index",compact('question'));
    }

    public function show($id){
    	$question = Question::findOrFail($id);
        $option = json_decode($question['option']);

        return view("admin.question.show",compact('question','option'));
    }

    public function create(){
        $quizes = Quiz::get();
    	return view("admin.question.create",compact('quizes'));
    }

    public function ImageUpload(Request $request){
        // dd($request->file);
        $url = '';
        if($request->hasFile('file')){
            $image = $request->file;
            $imagePath = str_random(16) . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/', $imagePath);
            $url = '/uploads/' . $imagePath;
        }
        $array = ['file_path'=>$url];
        return json_encode($array); 
    }

    public function store(Request $request){
        $this->validate($request, [
           'description' => 'required',
           'quiz_id' => 'required',
           'answer' => 'required',
        ]);
        $body = $request->all();
        if(array_key_exists($body['answer'], $body['option'])){
            $body['slug'] = str_random (5);
            if(isset($body['format']) && $body['format'] == "file"){
                $data = array();

                if ($request->hasFile('option')) {
                    
                    $imageA = $request->file('option')['A'];
                    $imagePathA = str_random(16) . '.' . $imageA->getClientOriginalExtension();
                    $imageA->move('uploads/', $imagePathA);
                    $data['A'] = 'uploads/' . $imagePathA;

                    $imageB = $request->file('option')['B'];
                    $imagePathB = str_random(16) . '.' . $imageB->getClientOriginalExtension();
                    $imageB->move('uploads/', $imagePathB);
                    $data['B'] = 'uploads/' . $imagePathB;

                    $imageC = $request->file('option')['C'];
                    $imagePathC = str_random(16) . '.' . $imageC->getClientOriginalExtension();
                    $imageC->move('uploads/', $imagePathC);
                    $data['C'] = 'uploads/' . $imagePathC;

                    $imageD = $request->file('option')['D'];
                    $imagePathD = str_random(16) . '.' . $imageD->getClientOriginalExtension();
                    $imageD->move('uploads/', $imagePathD);
                    $data['D'] = 'uploads/' . $imagePathD; 

                }
                $body['format'] = $body['format'];
                $body['option'] =json_encode($data);
                // dd($body);
            }else{
                 $body['format'] = $body['format'];
                $body['option'] = json_encode($request->option);
            }
            $dataStore = Question::create($body);
            return redirect()->route('question.index')->withSuccess("added..");
        }else{
            return redirect()->back()->withErrors("Answer should be in between A to D");
        }
    	
    	
    }

    public function edit($id){
        $quizes = Quiz::get();
        $question = Question::findOrFail($id);
        $option = json_decode($question['option']);
        return view("admin.question.update",compact('quizes','question','option'));
    }

    public function update(Request $request ,$id){
        $question = Question::findOrFail($id);
        $body = $request->all();     
        
        if($body['format'] == "file"){
            $data = array();
            // dd($request->hasFile('option'));
            if ($request->hasFile('option')) {
                
                $imageA = $request->file('option')['A'];
                $imagePathA = str_random(16) . '.' . $imageA->getClientOriginalExtension();
                $imageA->move('uploads/', $imagePathA);
                $data['A'] = 'uploads/' . $imagePathA;

                $imageB = $request->file('option')['B'];
                $imagePathB = str_random(16) . '.' . $imageB->getClientOriginalExtension();
                $imageB->move('uploads/', $imagePathB);
                $data['B'] = 'uploads/' . $imagePathB;

                $imageC = $request->file('option')['C'];
                $imagePathC = str_random(16) . '.' . $imageC->getClientOriginalExtension();
                $imageC->move('uploads/', $imagePathC);
                $data['C'] = 'uploads/' . $imagePathC;

                $imageD = $request->file('option')['D'];
                $imagePathD = str_random(16) . '.' . $imageD->getClientOriginalExtension();
                $imageD->move('uploads/', $imagePathD);
                $data['D'] = 'uploads/' . $imagePathD; 

            }else{
                $body['option'] =$question['option'];
            }
            

        }else{
            $body['option'] = json_encode($request->option);
        }
    	$data = $question->update($body);
        return redirect()->route('question.index');
    }

    public function destroy($id){

    	$question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('question.index');
    }

    public function examination(Request $request){
    	// dd($request);
    	$count = 0;
    	$all = Question::get();
        dd($request);
    	foreach($all as $question){
    		if(in_array($request->option,unserialize($question['option']))){
    			$count += 1;
    			echo $question['option'];
    		}else{
    			$count -= 1;
    		}
    	}
    	dd($count);
    	
    }

    public function questionByQuiz($id){
        $question = Question::where('quiz_id',$id)->get();
        dd($question);
    }
}
