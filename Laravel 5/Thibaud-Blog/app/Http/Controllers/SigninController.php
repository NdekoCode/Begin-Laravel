<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function formSignin () {
        if(auth()->check()) {
            return redirect('/profile')->withErrors(["global_errors"=>"Vous etes déjà connectés"]);
        }
        return view('signin');
    }
    

    public function signinTraitement()
    {
        request()->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ], [
            'password.min' => "Pour des raisons de sécurités le mot de passe doit faire :min caractères."
        ]);
        User::create([
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);
        return "Nous avons reçus votre email qui est " . request('email') . " Ainsi que votre mot de passe qui est " . request('password');
    }
}
