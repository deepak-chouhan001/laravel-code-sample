<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalResult extends Model
{
    protected $table = "quiz_final_result";
    protected $fillable = [
        'slug','points','team_id','quiz_id'
    ];

    public function teams(){
    	return $this->belongsTo('App\User','team_id');
    }
    public function quiz(){
    	return $this->belongsTo('App\Quiz','quiz_id');
    }

    //Percent logic of team
    public function getPercent($team_id,$quiz_id){
        $points = FinalResult::where('team_id',$team_id)->get();
        $quizTeamMaps = QuizTeamMap::where('team_id',$team_id)->pluck('quiz_id');
        // dd($quizTeamMaps);
        $question = array();
        $quiz = array();
        $array = array();
        foreach ($quizTeamMaps as $value) {
            $text = Quiz::findOrFail($value);
            $quest = Question::where('quiz_id',$value)->count();
            
            foreach($points as $point){
                if($point['quiz_id'] == $text['id']){
                    $count = $point['points'];
                    $array['marks'][$value] = $count;
                    $array['total'][$value] = $text['points'] * $quest;
                }
            }
        }
        $myMarks = 0;
        if($array){
            foreach($array['total'] as $key => $arr1){
                foreach($array['marks'] as $key2 => $arr2){
                    if($key === $key2){
                        $x = $arr2;
                        $total = $arr1;
                        $percentage = ($x*100)/$total;
                        $myMarks = $percentage;
                    }
                }
            }
        }
        return $myMarks ;
    }
}
