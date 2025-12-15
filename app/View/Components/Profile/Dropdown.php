<?php

namespace App\View\Components\Profile;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Dropdown extends Component
{
    public ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    private function can() : bool
    {
        if (!$this->user) {
            return false;
        }

        return true;
    }

    public function render()
    {
        if (!$this->can()) {
            return ''; // Retorna vazio se o usuário não tiver permissão
        }

        return view('components.profile.dropdown');
    }
}
