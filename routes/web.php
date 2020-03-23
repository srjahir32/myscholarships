<?php

use Illuminate\Support\Facades\Route;

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
    return view('pages/login/login');
});

Route::get('login', 'AuthController@index');
Route::post('post-login', 'AuthController@postLogin'); 
Route::get('user-register', 'AuthController@userregistration');
Route::get('partner-register', 'AuthController@partnerregistration');
Route::post('post-registration', 'AuthController@postRegistration'); 
Route::get('dashboard', 'AuthController@dashboard'); 
Route::get('logout', 'AuthController@logout');

Route::view('admin', 'admin/dashboard')->middleware('admin');
Route::view('user', 'user/dashboard')->middleware('user');
Route::view('partner', 'partner/dashboard')->middleware('partner');
