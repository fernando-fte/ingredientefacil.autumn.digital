<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Exception;

class UserIndexController extends UserController
{
    public function __invoke()
    {
        try {
            $users = User::orderByDesc('created_at')->get();

            $response = [
                'users' => $users,
            ];

            return self::success('users.index', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao listar usuários', $exception);
        }
    }
}
