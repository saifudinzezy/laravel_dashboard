<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //membuat middleware
    public function __construct()
    {
        //hanya untk org yang belum punya akun / guest
        $this->middleware('guest');
    }

    public function login(){
        return view('login.login');
    }

    public function postLogin(Request $request){
        if (Auth::attempt([
            'email' => $request->username,
            'password' => $request->password
        ])){
            return redirect()->back();
        }else if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])){
            return redirect()->back();
        }else{
            return redirect('/login')->with('alert-danger','Data tidak ditemukan!');
        }
    }
}