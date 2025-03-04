<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class AuthController extends Controller
{
  public function register(Request $request){
    $data = $request->validate([
        "name" => ["required", "string"],
        "email" => ["required", "email", "unique:users"],
        "password" => ["required", "min:6"],
        "role_id" => ["nullable", "exists:roles,id"],
    ]);

    // Default role to "user"
    $defaultRole = Role::where("name", "user")->first()->id;

    $role_id = $defaultRole;  
    if (auth('sanctum')->check() && auth('sanctum')->user()->role->name === "admin") {
        $role_id = $request->role_id ?? $defaultRole; 
    }

    $user = User::create([
        "name" => $data["name"],
        "email" => $data["email"],
        "password" => bcrypt($data["password"]),
        "role_id" => $role_id,
    ]);

    $token = $user->createToken("auth_token")->plainTextToken;

    return response()->json([
        "user" => $user,
        "token" => $token,
    ], 201);
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
