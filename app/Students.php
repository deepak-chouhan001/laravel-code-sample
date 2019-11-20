<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = "quiz_students";
    protected $fillable = [
        'name','email','team_id'
    ];

    public function team(){
    	return $this->belongsTo('App\User','team_id');
    }
}
