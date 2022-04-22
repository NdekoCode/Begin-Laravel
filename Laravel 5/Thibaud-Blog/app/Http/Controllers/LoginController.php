<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function formLogin()
    {
        if (auth()->check()) {
            flash("Vous etes déjà connectés")->warning();
            return redirect('/profile');
        }
        return view('login');
    }

    public function loginTraitement()
    {

        request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $result = auth()->attempt([
            'email' => strtolower(request('email')),
            'password' => request('password')
        ]);
        if ($result) {
            
            flash("Vous etes bien connectés")->success();
            return redirect('/profile');
        }
        // On renvois les erreurs dans le formulaire au lieu dans l'en-tete pour bien insister
        return back()->withInput()->withErrors(['auth_errors' => "Vos identifiants sont incorrects"]);
    }
}
