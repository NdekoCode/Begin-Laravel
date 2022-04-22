<?php

namespace App\Http\Controllers;

use App\User;

class newsController extends Controller
{
    public function list()
    {

        // La fonction map() est une fonction de transformation
        // La methode flattent() nous permet d'eviter d'avoir des tableaux dans des tableaux ou des tableaux avec des dispositions complexe
        /** On recupere la relation et ainsi les personnes que suis l'utilisateur
         * Puis on execute une fonction de transformation (map) qui transforme les utilisateurs suivis en leurs messages
         * On execute une fonction (flatten) qui eviter les imbrications complexes des tableaux et nous renvois juste un tableau d'un niveau
         * 
         * On utilise Laravel Array order Proxy au niveau de map->messages qui equivaut à 
         * map(function(user) { return $user->messages}) et aussi au niveau de sortByDesc->created_at qui equivaut à:
         * sortByDesc(function (message) { return $message->created_at})
         * 
         * - On evite le problème du "N + 1": Qui est dus au fait qu'on fait plusieurs requetes SQL qui sont tous les memes cela peut induire à des problèmes de performance, pour eviter ce problème Laravel nous donne une solution qui est le `loading` qui fait partie des collections qui sont issues des bases de données avec la methode `load`, load permet de charger une relation en avance
         */
        $messages = auth()->user()->follow->load('messages')->map->messages->flatten()->sortByDesc->created_at;
        /**
         * Ce code ci-dessus en utilisant le Array Order proxy evoluer  equivaut à:
         * auth()->user()->follow->flatMap->messages->sortByDesc->created_at
         */

        return view('news', [
            'messages' => $messages
        ]);
    }
}
