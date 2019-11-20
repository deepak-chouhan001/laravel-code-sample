<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio;
use App\User;
use App\Team;
use App\FinalResult;
use App\Students;
use App\Quiz;
use App\ContactUs;
use Auth;
class HomeController extends Controller
{

    public function __construct(){
        parent::__construct();
        
    }

    public function index()
    {
        // return view('home');
    }

    public function welcome()
    {
        $finalResult = FinalResult::where('points','!=',0)->with('teams')->orderBy('points','DESC')->get();       
        $users = User::where('role_id',2)->count();       
        $quizzes = Quiz::count();       
        $students = Students::count();       
        $admin = User::where('role_id',1)->first();
        
        return view('welcome',compact('finalResult','users','students','quizzes','admin'));
    }

    public function toppers()
    {
        $finalResult = FinalResult::where('points','!=',0)->with('teams')->orderBy('points','DESC')->get();       
        $users = User::where('role_id',2)->count();       
        $quizzes = Quiz::count();       
        $students = Students::count();       
        $admin = User::where('role_id',1)->first();
            
        return view('toppers',compact('finalResult','users','students','quizzes','admin'));
    }

    public function contactUsSave(Request $request)
    {
        $this->validate($request, [
           'name' => 'required',
           'subject' => 'required',
           'message' => 'required',
           'email' => 'required|email',
        ]);

        $contact = ContactUs::create($request->all());
        return response('OK');
    }
}
