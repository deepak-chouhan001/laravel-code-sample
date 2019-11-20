<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class RawExamination extends Model
{
    protected $table = "quiz_raw_examinations";
    protected $fillable = [
        'slug','quiz_id','team_id','status','question_id','answer_id'
    ];

    public function hasAttempt($id){
    	
    	if($this->team_id == $id)
    		return true;
    	else
    		return false;
    }

    //Check question reviewed or answered
    public function checkQuestion($id){
    	if($data = RawExamination::where('question_id',$id)->where('team_id',Auth::user()['id'])->where('status',2)->first())
    		return "reviewed";
    	elseif($data = RawExamination::where('question_id',$id)->where('team_id',Auth::user()['id'])->where('status',1)->first())
            return "answered";
        else
    		return false;
    }

    //Get answer of question
    public function getAnswer($id){
        $answer = RawExamination::where('question_id',$id)->where('team_id',Auth::user()['id'])->first();
        return $answer ;
    }


}
