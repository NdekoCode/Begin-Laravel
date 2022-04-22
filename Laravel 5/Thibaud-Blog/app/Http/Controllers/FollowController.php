<?php

namespace App\Http\Controllers;

use App\Mail\newFollowerMail;
use App\User;
use Illuminate\Support\Facades\Mail;

class FollowController extends Controller
{
    public function new()
    {
        // L'utilisateur qui veut suivre l'autre c'est l'utilisateur connecté
        $follower = auth()->user();
        // L'utilisateur dont on veut suivre ou l'utilisateur à qui on veut s'abonner
        $followed = User::where('email', strtolower(request('email')))->firstOrFail();

        // On attache l'identifiant de follower dans la table pivaut
        $follower->follow()->attach($followed);

        Mail::to($followed)->send(new newFollowerMail($follower));

        flash("Vous suivez maintenant " . $followed->email)->success();

        return back();
    }

    public function remove()
    {
        $follower = auth()->user();
        $followed = User::where('email', strtolower(request('email')))->firstOrFail();
        $follower->follow()->detach($followed);
        flash("Vous ne suivez plus " . $followed->email)->error();
        return back();
    }
}
