<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserIndexController extends Controller
{
    public function __invoke()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('users.index', compact('users'));
    }
}
