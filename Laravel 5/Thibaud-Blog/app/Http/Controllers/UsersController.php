<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function usersList()
    {
        return view('/users', ['users' => User::all()]);
    }
    public function seeUser()
    {

        $email = request('email');
        // On recupere un seul utilisateur dont l'email correspond à $email
        $user = User::where('email', $email)->firstOrFail();

        return view('/user', [
            'user' => $user,
            // On evite les erreur `N+1`
            'messages' => $user->load('messages')->messages
        ]);
    }
}
