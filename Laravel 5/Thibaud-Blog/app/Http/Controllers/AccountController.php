<?php

namespace App\Http\Controllers;

class AccountController extends Controller
{
    public function profile()
    {
        return view('/profile');
    }

    public function logout()
    {
        auth()->logout();
        flash("Vous etes bien deconnectés")->warning();
        return redirect('/');
    }

    public function updatePassword()
    {

        request()->validate([
            'password' => ['required', 'confirmed', 'min:8'],
            'password_confirmation' => ['required'],

        ], ['password.min' => "Pour des raisons de sécurité le mot de passe doit faire :min caractères"]);

        // On modifie le mot de passe, ignorer le `Warning` sur la fonction `update`
        auth()->user()->update(['password' => bcrypt(request('password'))]);
        flash("Votre mot de passe a été modifié")->success();
        return redirect('/profile');
    }


    public function updateAvatar()
    {
        request()->validate([
            'avatar' => ['required', 'image']
        ]);
        // On enregistre le fichier dans "storages/app/public/avatars" avec un nom unique
        $path = request('avatar')->store('avatars', 'public');
        auth()->user()->update(['avatar' => $path]);
        flash("Votre image a été télécharger avec succés")->success();
        return redirect('/profile');
    }
}
