<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserCreateController extends Controller
{
    public function __invoke()
    {
        return view('users.create');
    }
}
