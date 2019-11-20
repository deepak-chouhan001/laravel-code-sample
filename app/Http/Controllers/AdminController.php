<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\ContactUs;
use App\FinalResult;
use App\Quiz;
use App\Question;
use App\Students;
use Illuminate\Support\Facades\Hash;
class AdminController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');        
    }

    public function home(){
        $teams = User::where('role_id',2)->count();
        $quizzes = Quiz::count();
        $question = Question::count();
        $students = Students::count();
        return view('home',compact('teams','quizzes','question','students'));
    }


    public function profile(){
        
        return view('admin.profile');
    }

    public function index(){
        $teams = User::where('role_id',2)->get();

        return view('admin.teams.index',compact('teams'));
    }

    public function TopTeams(){
        $toppers = FinalResult::with('teams.teamQuiz')->orderBy('points','DESC')->get();
        
        return view('admin.top_team',compact('toppers'));
    }

    public function show($id){
        $teams = User::findOrFail($id);
        return view('admin.teams.show',compact('teams'));
    }

    public function create(){
        return view('admin.teams.create');
    }

    public function store(Request $request){
        $this->validate($request, [
           'name' => 'required',
           'password' => 'required|confirmed',
        ]);
        $request->merge(['role_id' => 2]);
        $request->merge(['unique_id' => hexdec(uniqid())]);
        $request->merge(['team_password' => $request->password]);
        $request->merge(['password' => Hash::make($request->password)]);
        
        
        $store = User::create($request->all());
        return redirect()->route('team.index')->withSuccess("Team Added Successfully.");
    }

    public function storeOld(Request $request){
        $this->validate($request, [
           'name' => 'required',
           'password' => 'required|confirmed',
        ]);
        $request->merge(['unique_id' => hexdec(uniqid())]);
        $request->merge(['password' => Hash::make($request->password)]);
        $store = Team::create($request->all());
        return redirect()->route('team.index')->withSuccess("Team Added Successfully.");
    }

    public function edit($id){
        $teams = User::findOrFail($id);
        return view('admin.teams.update',compact('teams'));
    }

    public function update(Request $request,$id){

        $this->validate($request, [
           'name' => 'required',
        ]);

        $user = User::findOrFail($id);
        if($request->has('password') && $request->password != ""){
            if(Hash::check($request->old_password,$user->password)){
                $request->merge(['team_password' => $request->password]);
                $request->merge(['password' => Hash::make($request->password)]);
                $update = $user->update($request->all());
                return redirect()->route('team.index')->withSuccess("Updated Successfully.");   
            }else{
                return redirect()->back()->withErrors("Old Password is wrong");
            }
        }else{
           
            $update = $user->update(['role_id'=>2,'name'=>$request->name]);
            return redirect()->route('team.index')->withSuccess("Updated Successfully.");
        }
       
    }
    public function updateOld(Request $request,$id){

            $this->validate($request, [
               'name' => 'required',
            ]);

            $teams = Team::findOrFail($id);
            if($request->has('password') && $request->password != ""){
                if(Hash::check($request->old_password,$teams->password)){
                    $request->merge(['password' => Hash::make($request->password)]);
                    $update = $teams->update($request->all());
                    return redirect()->route('team.index')->withSuccess("Updated Successfully.");   
                }else{
                    return redirect()->back()->withErrors("Old Password is wrong");
                }
            }else{
                $update = $teams->update(['name'=>$request->name ,'status'=>$request->status]);
                return redirect()->route('team.index')->withSuccess("Updated Successfully.");
            }
           
        }

    public function destroy($id){
        $delete = User::findOrFail($id)->delete();
        return redirect()->route('team.index')->withSuccess("Deleted Successfully.");
    }

    public function ChangeStatus($id){
        $user = User::findOrFail($id);
        if($user->isEnabled())
            $user->status = 0;
        else
            $user->status = 1;

        $user->save();
        return redirect()->route('team.index')->withSuccess("Updated Successfully.");
    }

    public function contactUs(){
        $contacts = ContactUs::get();
        return view('admin.contact-us.index',compact('contacts'));
    }

    public function deleteContact($id){
        $delete = ContactUs::findOrFail($id)->delete();
        return redirect()->back()->withSuccess("Deleted Successfully.");
    }



    
}
