<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //membuat middleware
    public function __construct()
    {
        //hanya untk org yang belum punya akun / guest
        $this->middleware('guest');
    }

    public function register(){
        return view('register.register');
    }

    public function postRegister(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

//        dd($request->all());
        return redirect()->back();
    }
}
