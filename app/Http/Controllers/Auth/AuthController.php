<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create([
            'name' => $request->name ,
            'email' => $request->email,
            'password' => Hash::make($request->password)           
        ]);
        Auth::login($user);
        return redirect()->to('/reservations')->with('success' , 'You are created account succssful');
    }

     public function login(LoginRequest $request){
         if(Auth::attempt($request->only('email' , 'password'))){
            if(auth()->user()->role== "admin")
            return redirect()->intended('/buildings')->with('success' , 'You are in');
        else 
            return redirect()->intended('/reservations')->with('success' , 'You are in');
         }
 
        return back()->with('error' , 'Invalide Cerdientials');
    } 

    public function logout(Request $request){
        Auth::logout();
        return redirect()->to('/')->with('success','logouted successifuly');
    }

}
