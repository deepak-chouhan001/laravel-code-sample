<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
class User extends Authenticatable
{
    use Notifiable;
    const EXPIRATION_TIME = 5; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "quiz_users";
    protected $fillable = [
        'name', 'email', 'password','phone_no','otp_expiration','unique_id','role_id','login_token','avatar','address','team_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isExpired(){
         $expiratie = Carbon::parse($this->otp_expiration);
         if($expiratie->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME){
            return true;
         }else{
            return false;
         }
    }

    public function isTeam(){
        if($this->unique_id != '' && $this->role_id == 2)
            return true;
        else
            return false;
    }

    public function isLoggedIn(){
        if($this->login_token)
            return true;
        else
            return false;
    }

    public function isEnabled(){
        if($this->status)
            return true;
        else
            return false;
    }

    public function teamQuiz(){
        return $this->belongsTo('App\QuizTeamMap','team_id');
    }

    public function quizzes(){
        return $this->hasMany('App\QuizTeamMap','team_id');
    }

    public function exam(){
        return $this->hasMany('App\Examination','team_id')->where('status',1)->latest();
    }

    public function members(){
        return $this->hasMany('App\Students','team_id');
    }

     public function quizDetail($quiz_id){
        $quiz = Quiz::findOrFail($quiz_id);
        
        if($quiz){
            return $quiz;
        }else{
            return 0;
        }
    }

}
