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

Route::get('/home', 'HomeController@index')->name('home');

//ゲームコミュニティ
Route::get('/matching/game', 'MatchingController@game_community')->name('matching.game');
//ユーザーマッチング
Route::get('/matching/user', 'MatchingController@user_matching')->name('matching.user');




Auth::routes(['verify' => true]);
//仮登録(メール送信)
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
//本登録入力(名前入力)
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
//本登録確認
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
//本登録
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');
