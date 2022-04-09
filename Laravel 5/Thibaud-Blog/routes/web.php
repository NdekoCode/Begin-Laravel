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

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
// On simplifie ce qu'il y a au dessus
Route::view('/','welcome');
Route::view('/about','about');

Route::get('/hello/{firstname}', function () {
    return view('hello', ['firstname'=>request('firstname')]);
});

Route::get('/signin', 'SigninController@formSignin');

Route::post('signin', 'SigninController@signinTraitement');

Route::get('/login','LoginController@formLogin');

Route::post('/login','LoginController@loginTraitement');


Route::get('/users', 'UsersController@usersList');

Route::get('/profile','AccountController@profile');

Route::get('/logout','AccountController@logout');