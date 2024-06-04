<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\AuthModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Mail\Sendotp;
use Mail;

class AuthController extends Controller
{
      public function emailverify(Request $request){ 
        
        if($request->ajax()){

             $validate = Validator::make($request->all(),[
                'email'=>'required | email'
             ]);

             if($validate->fails()){

                return response()->json([
                     'code'=>'400',
                     'errors'=>$validate->errors(),
                ]); 

             }else{
                 $count = AuthModel::emailcheck($request->email)->count();
                 if($count == 1){
                    $otp = genrateotp();
                    $user_data = AuthModel::emailcheck($request->email)->first();
                    $mail = mail::to($request->email)->send(new Sendotp($user_data->name,$otp));
                    $sendsms = sendSMS($user_data->mobile_number,$otp);
                    if($mail && $sendsms){
                        AuthModel::emailcheck($request->email)->update([
                            'otp'=>$otp
                        ]);
                    } 
                    session()->put('otp',1);
                    session()->put('email',$user_data->email);
                    session()->flash('type','success');
                    session()->flash('message','Successfully OTP Send');
                    return response()->json([
                         'code'=>'200'
                    ]);
                 }else{
                    return response()->json([
                        'code'=>"404",
                        'message'=>'Invalid Email',
                    ]);
                 }                 
             }
          }
      }

      public function otpverify(Request $request){

        if($request->ajax()){

            $validate = Validator::make($request->all(),[
               'otp'=>'required | numeric | digits:6'
            ]);

            if($validate->fails()){

               return response()->json([
                    'code'=>'400',
                    'errors'=>$validate->errors(),
               ]); 

            }else{
                $user_data = AuthModel::emailcheck($request->email)->where('otp',$request->otp)->first();
                if($user_data){
                    Auth::guard('login')->login($user_data);
                    session()->flash('type','success');
                    session()->flash('message','Sucessfully logged in');  
                    AuthModel::emailcheck($user_data->email)->update([
                        'otp'=>''
                    ]);  
                    return response()->json([
                        'code'=>'200',
                        'status'=>true,
                    ]);
                }else{
                    return response()->json([
                        'code'=>"404",
                        'message'=>'Invalid OTP',
                    ]);
                }                                
             }
          }
      }

      public function logout(){

        Auth::guard('login')->logout();
        session()->flash('type','success');
        session()->flash('message','Successfully Logout');
        return redirect()->route('front.index');

      }

 }
