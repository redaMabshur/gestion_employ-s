<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Fix typo here
use App\Http\Requests\AuthRequest;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function handlelogin(AuthRequest $request){

        $credentials = $request->only(['email','password']);
        if (Auth::attempt($credentials)){
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error_msg','Parametre de connexion non reconnu'); // Fix typo here
        }
    }
}
