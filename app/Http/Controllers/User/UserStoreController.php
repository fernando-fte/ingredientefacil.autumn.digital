<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
            return Redirect::route('web.users.index')->with('success', 'Usuário criado com sucesso!');
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['error' => 'Erro ao criar usuário.'])->withInput();
        }
    }
}
