<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;

Route::get('/', 'HomeController@home');

//membuat fun logout
Route::get('logout', function (){
    //panggil fun Auth logut untk menghapus session
    Auth::logout();
    return redirect('/login')->with('alert-danger','Anda telah keluar!');
});

//login
Route::group(["prefix" => "/"], function () {
    Route::get("login", "LoginController@login")->name('login');;
    Route::post("postLogin", "LoginController@postLogin");
});

//register
Route::group(["prefix" => "/"], function () {
    Route::get("register", "RegisterController@register");
    Route::post("postRegister", "RegisterController@postRegister");
});

//iklan
Route::group(["prefix" => "iklan/"], function () {
    Route::get("", "IklanController@iklan");
    Route::get("add", "IklanController@add");
    Route::post("store", "IklanController@store");
    Route::get("destroy/{id}", "IklanController@destroy");
    Route::get("show/{id}", "IklanController@show");
    Route::post("update/{id}", "IklanController@update");
});

//api
Route::group(["prefix" => "api/"], function () {
    Route::get("iklan", "ApiCotroller@iklan");
});