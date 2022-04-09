<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function formLogin()
    {
        if (auth()->check()) {
            return redirect('/profile')->withErrors(["global_errors" => "Vous etes déjà connectés"]);
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
            'email' => request('email'),
            'password' => request('password')
        ]);
        if ($result) {
            return redirect('/profile');
        }
        return back()->withInput()->withErrors(['auth_errors' => "Vos identifiants sont incorrects"]);
    }
}
