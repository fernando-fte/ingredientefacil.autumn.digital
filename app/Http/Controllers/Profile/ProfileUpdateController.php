<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileUpdateController extends ProfileController
{
    public function __invoke(ProfileUpdateRequest $request)
    {
        try {
            $user = $request->user();
            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            // Atualiza a senha se enviada
            if ($request->filled('password')) {
                $user->password = $request->input('password');
            }

            $user->save();

            return Redirect::route('web.profile.edit')->with('status', 'profile-updated');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
