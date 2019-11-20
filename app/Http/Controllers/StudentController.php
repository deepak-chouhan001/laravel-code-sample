<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;
use App\User;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Students index page
    public function index(){
    	$students = Students::all();
    	return view('admin.students_mapping.index',compact('students'));
    }

    //To show role by id
    public function show($id){
    	$students = Students::findOrFail($id);
    	return view('admin.students_mapping.show',compact('students'));
    }

    //Create role view page
    public function create(){
        $teams = User::where('role_id',2)->get();
    	return view('admin.students_mapping.create',compact('teams'));
    }

    //Store role logic
    public function store(Request $request){
    	
    	$this->validate($request, [
           'name' => 'required',
           'email' => 'required|email',
        ]);

    	$students = Students::create($request->all());
    	return redirect()->route('student.index')->withSuccess("Added Successfully.");
    }

    //Students edit view 
    public function edit($id){
        $teams = User::where('role_id',2)->get();
    	$students = Students::findOrFail($id);
    	return view('admin.students_mapping.update',compact('students','teams'));
    }

    //Students update logic
    public function update(Request $request,$id){

    	$students = Students::findOrFail($id);
    	$update = $students->update($request->all());
    	return redirect()->route('student.index')->withSuccess("Updated Successfully.");
    }

    //Delete role logic
    public function destroy($id){
    	$students = Students::findOrFail($id)->delete();
    	return redirect()->route('student.index')->withSuccess("Deleted Successfully.");
    }
}
