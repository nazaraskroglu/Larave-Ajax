<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function check(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password'=>'required|min:3'
        ]);

        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return view('home');
        }
        return redirect()->route('admin.login')->withErrors('Email adresi veya şifre hatalı!');

    }

}
