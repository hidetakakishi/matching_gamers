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

//コミュニティ画面
Route::get('/community/{community_id}', 'MatchingController@community')->name('community');
//フレンド追加
Route::post('/community_add_friend', 'MatchingController@community_add_friend')->name('community_add_friend');
//コミュニティチャット
Route::post('/community_chat', 'MatchingController@community_chat')->name('community_chat');
//コミュニティマッチング
Route::get('/matching_community', 'MatchingController@matching_community')->name('matching_community');
//コミュニティ参加確認
Route::get('/verify_community/{community_id}', 'MatchingController@verify_community')->name('verify_community');
//コミュニティ参加完了
Route::post('/matched_community', 'MatchingController@matched_community')->name('matched_community');

//ユーザーマッチング
Route::get('/now_community', 'MatchingController@now_community')->name('now_community');

//コミュニティ作成
Route::get('/add_community', 'MatchingController@add_community')->name('add_community');
//コミュニティ作成確認画面
Route::post('/verify_community', 'MatchingController@verify_add_community')->name('verify_add_community');
//フレンド
Route::get('/friend', 'MatchingController@friend')->name('friend');
Route::post('/friend/check', 'MatchingController@friend_check')->name('friend.check');
Route::post('/friend/delete', 'MatchingController@friend_delete')->name('friend.delete');

//マイページ
Route::get('/mypage', 'MatchingController@mypage')->name('mypage');
//マイページ編集
Route::get('/edit_mypage', 'MatchingController@edit_mypage')->name('edit_mypage');
//マイページ更新
Route::post('/update_mypage', 'MatchingController@update_mypage')->name('update_mypage');


Auth::routes(['verify' => true]);
//仮登録(メール送信)
Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');
//本登録入力(名前入力)
Route::get('register/verify/{token}', 'Auth\RegisterController@showForm');
//本登録確認
Route::post('register/main_check', 'Auth\RegisterController@mainCheck')->name('register.main.check');
//本登録
Route::post('register/main_register', 'Auth\RegisterController@mainRegister')->name('register.main.registered');
