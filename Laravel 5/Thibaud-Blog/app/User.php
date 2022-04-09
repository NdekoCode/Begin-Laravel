<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;

class User extends Model implements Authenticatable{
    use BasicAuthenticatable;
    /**
     * Fillable(Remplissable) Va contenir la liste des champs autorisé
     *
     * @var array
     */
    protected $fillable = ['email','password'];
}
