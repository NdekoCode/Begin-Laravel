<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function usersList()
    {
        return view('/users', ['users' => User::all()]);
    }
}
