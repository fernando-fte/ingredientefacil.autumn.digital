<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Exception;

class UserDestroyController extends UserController
{
    public function __invoke(User $user)
    {
        try {
            $user->delete();

            $response = [
                'message' => 'Usuário removido com sucesso',
                'users' => User::orderByDesc('created_at')->get(['id', 'name']),
            ];

            return self::success('users.index', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao remover usuário', $exception);
        }
    }
}
