<div class="dropdown">
    <a class="btn btn-light dropdown-toggle d-flex align-items-center" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=32" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
        <span>{{ $user->name }}</span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="userDropdown" style="min-width: 240px;">
        <li class="border-bottom px-3 py-2">
            <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0D8ABC&color=fff&size=40" alt="Avatar" class="rounded-circle me-2" width="40" height="40">
                <div>
                    <div class="fw-semibold">{{ $user->name }}</div>
                    <div class="text-muted small">Ver perfil</div>
                </div>
            </div>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                <i class="fa fa-cog"></i> Configurações
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="fa fa-question-circle"></i> Ajuda
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="#">
                <i class="fa fa-adjust"></i> Acessibilidade
            </a>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
                    <i class="fa fa-sign-out-alt"></i> Sair
                </button>
            </form>
        </li>
    </ul>
</div>
