<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $table = "quiz_question";
    protected $fillable = [
        'slug','quiz_id','description','status','answer','option','format'
    ];

    public function quiz(){
    	return $this->belongsTo('App\Quiz');
    }

    public function isEnable(){
        if($this->status == 1)
            return true;
        else
            return false;
    }


}
