<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login (Request $request) : JsonResponse
    {
        $validated =$request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(! Auth::attempt($validated))
        {
            return response()->json([
                "message"=>"login or password incorrect"
            ],401);
        }
        $user = User::where('email',$validated['email'])->first();
        return response()->json([
                    "access_token"=>$user->createToken('api_token')->plainTextToken,
                    "token_type"=>"Bearer",
                    "User"=>$user
                ]);
    }
    public function register (Request  $request)
    {
        $validated = $request->validate([
            'name'=>'required|string|max:30',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:6',
        ]);
        $user = User::create($validated);
        return response()->json([
            'user'=>$user,
            'access_token'=>$user->createToken('api_token')->plainTextToken,
            "token_type"=>"Bearer",
        ],201);
    }
}
