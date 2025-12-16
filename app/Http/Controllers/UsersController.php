<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    // Lista de usuários
    public function index()
    {
        $users = User::orderByDesc('created_at')->get();
        return view('users.index', compact('users'));
    }

    // Formulário de criação
    public function create()
    {
        return view('users.create');
    }

    // Salva novo usuário
    public function store(Request $request)
    {
    }

        // Remove um usuário
    public function destroy($id)
    {
    }
}
