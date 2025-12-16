<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Request;

abstract class UserController extends Controller
{
    public function create(Request $request)
    {
        return app(UserCreateController::class)($request);
    }
    public function destroy(User $user)
    {
        return app(UserDestroyController::class)($user);
    }
    public function index(Request $request)
    {
        return app(UserIndexController::class)($request);
    }
    public function store(UserStoreRequest $request)
    {
        return app(UserIndexController::class)($request);
    }
}
