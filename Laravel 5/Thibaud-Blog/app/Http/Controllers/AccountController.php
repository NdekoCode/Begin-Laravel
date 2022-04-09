<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function profile() {
        if(auth()->guest()) {
            return redirect('/')->withErrors(['global_errors' => "Vous devez etre connecter pour acceder à cette page"]);
        }
        
        return view('/profile');
    }

    public function logout () {
        auth()->logout();
        return redirect('/')->withErrors(['global_errors'=>"Vous etes bien deconnectés"]);
    }
}
