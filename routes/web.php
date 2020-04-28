<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('register');
});

//仮登録(メール送信)
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
//
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
//本登録確認
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
//本登録
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
