<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //membuat midleware sebagai penyaringan bagi yang sudah login
    public function __construct()
    {
//        //middleware utk user yang sudah login
        $this->middleware('auth');
        /*if (Auth::check()) {
            return 'login';
        }else{
            return 'no login';
        }*/
    }

    //jadi hanya org yang sudah login yang bisa mengakses halaman ini
    public function home(){
        $user = Auth::user();
//        dd(Auth::user());
        return view('menus.dashboard', ['dashboard' => 1, 'user' => $user]);
    }
}
