<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class User extends Model implements Authenticatable
{
    use BasicAuthenticatable;
    /**
     * Fillable(Remplissable) Va contenir la liste des champs autorisé
     *
     * @var array
     */
    protected $fillable = ['email', 'password', 'avatar'];

    public function messages()
    {
        return $this->hasMany(Message::class)->latest();
    }
    /**
     * Permet de faire une relation manyToMany de suvisi des utilisateurs entre deux utilisateur qui se suivent et créer la table pivot des suivis ou de cette relation
     *
     * @return BelongsToMany
     */
    public function follow()
    {
        return $this->belongsToMany(User::class, 'followed', 'follower_id', 'followed_id');
    }

    /**
     * Permet de voir si $user suit l'utilisateur courrant ie $this
     *
     * @param User $user
     * @return void
     */
    public function follows($user)
    {
        // On recupere toutes les personnes que l'on suit
        // exists() Permet de verifier si la requete retourne une ligne ou plusieurs et retourne "false" si elle retourne rien
        return $this->follow()->where('followed_id', $user->id)->exists();
    }
}
