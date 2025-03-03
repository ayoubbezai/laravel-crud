<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $data = $request->validate([
            "name" =>["required","string"],
            'email'=> ['required','email','unique:users'],
            'password'=> ["required","min:6"],
        ]);
        $user = User::create($data);
        $token = $user->createToken("auth_token")->plainTextToken;

        
        return response()->json([
            "user"=> $user,
            "token"=>$token,
        ],201);
    }
    public function login(Request $request){
        $data = $request->validate([
            'email'=> ['required','email','exists:users'],
            'password'=> ["required","min:6"],
        ]);
        $user = User::where("email",$data["email"])->first();

        if(!$user || !Hash::check($data["password"],$user->password)){
            return response([
                "success" => false,
                "message" => "bad creds"
            ],401);
        }

        $token = $user->createToken("auth_token")->plainTextToken;

        
        return response()->json([
            "user"=> $user,
            "token"=>$token,
        ]);
    }
}
