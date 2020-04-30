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

//コミュニティマッチング
Route::get('/matching_community', 'MatchingController@matching_community')->name('matching_community');
//コミュニティ参加確認
Route::get('/verify_community/{community_id}', 'MatchingController@verify_community')->name('verify_community');
//コミュニティ参加完了
Route::post('/matched_community', 'MatchingController@matched_community')->name('matched_community');

//ユーザーマッチング
Route::get('/matching_user', 'MatchingController@matching_user')->name('matching_user');

//コミュニティ作成
Route::get('/add_community', 'MatchingController@add_community')->name('add_community');
//コミュニティ作成確認画面
Route::post('/verify_community', 'MatchingController@verify_add_community')->name('verify_add_community');
//チャット
Route::get('/chat', 'MatchingController@chat')->name('chat');
//マイページ
Route::get('/mypage', 'MatchingController@mypage')->name('mypage');


Auth::routes(['verify' => true]);
//仮登録(メール送信)
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
//本登録入力(名前入力)
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
//本登録確認
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
//本登録
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');
