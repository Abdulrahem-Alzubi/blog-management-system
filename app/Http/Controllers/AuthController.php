<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signup(SignupRequest $request){
        $user = User::query()->create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);

        $token = $user->createToken('user');
        $data['user']=$user;
        $data['type']='Bearer';
        $data['token']=$token->accessToken;

        return successResponse($data);
    }

    public function login(LoginRequest $request){
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)){
            throw new AuthenticationException();
        }

        $user = $request->user();


        $token=$user->createToken('user');

        $data['user']=$user;
        $data['type']='Bearer';
        $data['token']=$token->accessToken;

        return successResponse($data);
    }
    public function logout(Request $request){
        $request->user()->token()->delete();
    }
}
