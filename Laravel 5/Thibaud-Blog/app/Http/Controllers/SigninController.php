<?php

namespace App\Http\Controllers;

use App\User;

class SigninController extends Controller
{
    public function formSignin () {

        if(auth()->check()) {
            flash("Vous etes déjà connectés")->error();
            return redirect('/profile');
        }
        return view('signin');
    }
    

    public function signinTraitement()
    {
        // On verifie si les données entrer par l'utilisateur sont valide
        request()->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required']
        ], [
            'password.min' => "Pour des raisons de sécurités le mot de passe doit faire :min caractères."
        ]);

        // On verifie si il n'y a pas un utilisateur déjà existant avec le meme email
        $user = User::where('email', strtolower(request('email')))->first();

        // Si l'utilisateur n'existe pas alors c'est bon il peut s'inscrire
        if(empty($user)){
            User::create([
                'email' => strtolower(request('email')),
                'password' => bcrypt(request('password'))
            ]);
            $result = auth()->attempt([
                'email' =>strtolower(request('email')),
                'password' => request('password')
            ]);
            if($result) {
                flash("Vous etes bien connectés")->success();
                return redirect('/profile');
            }else {
                flash("Information invalide")->error();
                return redirect('/signin')->withInput();
    
            }

        }
        else {
            flash("Email ou mot de passe invalide")->error();
            return redirect('/signin')->withInput();

        }
    }
}
