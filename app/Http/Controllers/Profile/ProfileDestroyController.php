<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Profile\ProfileDestroyRequest;

class ProfileDestroyController extends ProfileController
{
    public function __invoke(ProfileDestroyRequest $request)
    {
        try {
            $user = $request->user();

            Auth::logout();
            $user->delete();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return Redirect::to('/');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
