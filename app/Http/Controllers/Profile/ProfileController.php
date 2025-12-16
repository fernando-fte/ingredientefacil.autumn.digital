<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Profile\ProfileDestroyController;
use App\Http\Controllers\Profile\ProfileEditController;
use App\Http\Controllers\Profile\ProfileUpdateController;
use App\Http\Requests\Profile\ProfileUpdateRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return app(ProfileEditController::class)($request);
    }

    public function update(ProfileUpdateRequest $request)
    {
        return app(ProfileUpdateController::class)($request);
    }

    public function destroy(Request $request)
    {
        return app(ProfileDestroyController::class)($request);
    }
}
