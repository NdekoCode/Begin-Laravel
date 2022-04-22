<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function new() {
        request()->validate([
            'message' =>['required','min:3']
        ]);
        // On recupere la relation entre l'utilisateur connecté et le message
        auth()->user()->messages()->create([
            // On passe uniquement le contenus car Laravel va deviner tous seul qu'on a besoin d'un identifiant et passera l'identifiant de l'utilisateur connecté
            'content' =>request('message')
            ]);
        // Message::create([,
            // L'identifiant de l'utilisateur connecté
        //     'user_id' => auth()->id()
        //     ]);
        flash('Votre message a été publié avec succés')->success();
        return back();
    }
}
