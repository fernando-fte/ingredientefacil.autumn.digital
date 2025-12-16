<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserCreateController extends UserController
{
    public function __invoke()
    {
        try {
            return self::success('users.create', []);
        } catch (\Exception $exception) {
            return self::fatal('Erro ao carregar formulário de criação de usuário', $exception);
        }
    }
}
