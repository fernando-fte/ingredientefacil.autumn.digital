<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileEditController extends ProfileController
{
    public function __invoke(Request $request)
    {
        try {
            $response = [
                'user' => $request->user(),
            ];
            
            return view('profile.edit', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao carregar perfil', $exception);
        }
    }
}
