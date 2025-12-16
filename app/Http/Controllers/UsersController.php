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
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('web.users.index')->with('success', 'Usuário criado com sucesso!');
    }

        // Remove um usuário
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('web.users.index')->with('success', 'Usuário removido com sucesso!');
    }
}
