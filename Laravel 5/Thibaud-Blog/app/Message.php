<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * Pour empecher le massAssignment Exception on met les attribut autorisé dans un tableau de suivis
     *
     * @var array
     */
    protected $fillable = ['content','user_id'];
}
