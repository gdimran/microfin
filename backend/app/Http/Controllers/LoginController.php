<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function submit( Request $request){
    
    //validate phone number
    $request->validate([
        'phone' => 'required|numeric|min:11'
    ]);

    //find or create a user model
    $user = User::firstOrCreate([
        'phone' => $request->phone
    ]);

    if(!$user){
        return response()->json(['message'=> 'Could not process a user with this phone number.'], 401);
    }
    //send the user a one-time use code
    $user->notify( new LoginNeedsVerification());

    //return back a response
    return response()->json(['message'=>'Text message notification sent.']);

   }
   
   
   public function verify(Request $request){
    // validate the incoming request

    $request->validate([
        'phone' => 'required|numeric|min:11',
        'password'=>'required|numeric|between:111111,999999'
    ]);

    //find the user
    $user=User::where('phone', $request->phone)
    ->where('password', $request->password)
    ->first();

    //is the code provided the same one saved?
    //if so, return back an auth token
    if($user){
        $user->update([
            'password'=> null
        ]);
        return $user->createToken($request->password)->plainTextToken;
    }


    //if not, return back a message

    return response()->json(['message'=>'Invalid verification code'], 401);
    
   }
}