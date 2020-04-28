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
    return view('login');
});

Route::get('/register', function () {
  Log::debug('**********************************************************');
    return view('register');
});

Route::post('register/pre_check', 'Auth\RegisterController@pre_check')->name('register.pre_check');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
