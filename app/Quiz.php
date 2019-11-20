<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = "quiz_quiz";
    protected $fillable = [
        'slug','quiz_name','quiz_type','status','points'
    ];

    public function isLive(){
    	if($this->quiz_type == 1)
    		return true;
    	else
    		return false;
    }

    public function isEnable(){
        if($this->status == 1)
            return true;
        else
            return false;
    }

    public function question(){
        return $this->hasMany('App\Question');
    }

   
}
