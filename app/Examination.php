<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $table = "quiz_examination";
    protected $fillable = [
        'slug','quiz_id','team_id','status','question_id','answer_id'
    ];

    public function hasAttempt($id){
    	
    	if($this->team_id == $id)
    		return true;
    	else
    		return false;
    }
}
