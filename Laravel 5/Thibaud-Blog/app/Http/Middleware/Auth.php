<?php

namespace App\Http\Middleware;

use Closure;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        // On verifie si l'utilisateur est juste un simple visiteur càd si il n'est pas connecté
        if(auth()->guest()) {
            flash('Vous devez etre connecter pour acceder à cette page')->error();
            // Ici on est pas obliger de rediriger l'utilisateur dans un middleWare
            return redirect('/login');
        }
        
        // On verifi si l'utilisateur est connecté
        // if (auth()->check()) {
        //     flash("Vous etes déjà connectés")->warning();
        //     return redirect('/profile');
        // }
        return $next($request);
    }

}
