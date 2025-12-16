<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\User\UserDestroyRequest;

class UserDestroyController extends UserController
{
    public function __invoke(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('web.users.index')->with('success', 'Usuário removido com sucesso!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
