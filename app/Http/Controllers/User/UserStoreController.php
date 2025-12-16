<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserStoreController extends UserController
{
    public function __invoke(UserStoreRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            $response = [
                'user' => $user,
            ];
            
            return self::success('users.index', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao criar usuário', $exception);
        }
    }
}
