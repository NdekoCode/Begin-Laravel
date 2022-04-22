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
Route::view('/home', 'welcome');
Route::view('/about', 'about');

Route::view('/hello/{firstname}', 'hello', ['firstname' => request('firstname')]);

Route::get('/signin', 'SigninController@formSignin');

Route::post('/signin', 'SigninController@signinTraitement');

Route::get('/login', 'LoginController@formLogin');

Route::post('/login', 'LoginController@loginTraitement');


Route::get('/', 'UsersController@usersList');

Route::get('/logout', 'AccountController@logout');

// Un groupe de route dependant d'un middleware
Route::group([
    // Le middleware à appelé pour tous ce groupe de route
    'middleware' => 'App\Http\Middleware\Auth'
], function () {
    // Un groupe de route impacter par le middleware `Auth`
    // A chaque qu'un utilisateurs voudra acceder à l'une de ces routes, ce middleware sera appelé
    Route::get('/profile', 'AccountController@profile');
    Route::post('/updated-password', 'AccountController@updatePassword');
    Route::post('/updated-avatar', 'AccountController@updateAvatar');

    Route::post('/messages', 'MessagesController@new');

    Route::get('/news', 'NewsController@list');

    Route::post('/follow/{email}', 'FollowController@new');
    Route::delete('/follow/{email}', 'FollowController@remove');
});

Route::get('/{email}', 'UsersController@seeUser');
