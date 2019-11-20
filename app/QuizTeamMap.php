<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\FinalResult;
class QuizTeamMap extends Model
{
    protected $table = "quiz_quiz_team_map";
    protected $fillable = [
        'slug','quiz_id','team_id','start_time','start_date','status','session_time','hours','minutes'
    ];

    public function hasTeam(){
        if($this->team_id != '')
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

    public function status(){
    	if($this->status == 1)
    		return "Completed";
    	else
    		return "Pending";
    }

    public function points($quiz_id,$team_id){
        $data = FinalResult::where('team_id',$team_id)->where('quiz_id',$quiz_id)->first();
        if($data){
            return $data['points'];
        }else{
            return 0;
        }
    }

    public function check($team_id){
    	if(QuizTeamMap::where('team_id',$team_id)->first())
    		return false;
    	else
    		return true;
    }

    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }

    public function team(){
        return $this->belongsTo('App\User');
    }
}
