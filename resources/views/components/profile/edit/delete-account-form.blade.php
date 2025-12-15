<div class="card">
    <div class="card-header">Excluir Conta</div>
    <div class="card-body">
        <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Excluir Conta</button>
        </form>
    </div>
</div>
