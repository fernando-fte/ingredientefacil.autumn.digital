<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileEditController extends ProfileController
{
    public function __invoke(Request $request)
    {
        try {
            return view('profile.edit', [
                'user' => $request->user(),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
