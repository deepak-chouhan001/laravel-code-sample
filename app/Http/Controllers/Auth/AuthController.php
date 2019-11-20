<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Validation\ValidationException;
use Twilio;
use Carbon\Carbon;
class AuthController extends Controller
{

    
    public function authenticateUser(Request $request){
    	$this->validate($request, [
           'email' => 'required',
        ]);
    	
        $user = User::where('email', $request->email)->first();

        if($user){
            
    		  // Auth::attempt(['email' => $request->email]);
            Auth::loginUsingId($user->id);
            return redirect('admin/home');
            
        }else{
               return redirect()->back()->withErrors(trans('auth.failed'));  
            }
    }

    public function otpVerification(Request $request){
    	//dd($request);
    	$user = User::where(['otp'=>$request->opt,'email'=>$request->email])->first();
        if($user){
            if($user->isExpired()){
                return "expired";    		
            }else{
                return "verified";
            }
    	}else{
       		return "wrong Otp";  
        }
    }

    public function phone_verify(Request $request ){
        $this->validate($request, [
           'email' => 'required',
           'phone_no' => 'required',
        ]);
    	$users = User::where('email',$request->email)->where('phone_no',$request->phone_no)->first(); 
        
        if($users){
            $otp = rand(1000,9999); 
            $users->otp = $otp;
            $users->otp_expiration = Carbon::now();
            $users->save();
            
            $this->twilio($request->phone_no,$otp);

            return "success";
        }else{
            return "Something wrong";
        }
    }

    public function twilio($phone,$message){
    	$to_phone_number = '+'.$phone; // who are you sending to?
    	
        $twilio =  Twilio::message($to_phone_number, $message);
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $user = User::findOrFail($id);
        if($request->has('password') && $data['password'] != ""){
            $data['password'] = Hash::make($request->password);             
        }
        if($request->hasFile('avatar')){
            $image = $request->avatar;
            $imageName = time().'.'.$image->getClientOriginalExtension(); 
            $destination = 'uploads/avatar';
            $image->move($destination, $imageName);
            $profile = $destination."/".$imageName;    
            
            $data['avatar'] = $profile;
        }
        
        $update = $user->update($data);
        return redirect()->back()->withSuccess("Updated Successfully.");
       
    }
}
