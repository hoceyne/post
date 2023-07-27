<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request){

        if (
            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])
        ) {
            $user = User::where("email",$request->email)->first();

            Auth::login($user);

            $token =  $user->createToken('API Token')->plainTextToken;

            return $token;
        }else{
            abort(401);
            // 400 bad request
            // 401 unathenticated
            // 402 unauthorized
            // 404 not found
            // 500 server down
        }


    }

    public function logout(Request $request){
        $user = $request->user();
        if(!$user){
            abort(404);
        }
        if (Auth::check($user)) {
            $user->tokens()->delete();
            return response(200);
        } else {
            abort(400);
        }
    }
}
