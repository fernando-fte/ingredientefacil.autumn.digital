<div class="card mb-4">
    <div class="card-header">Editar Dados do Perfil</div>
    <div class="card-body">
        <form method="POST" action="{{ route('web.profile.update') }}">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Dados</button>
        </form>
    </div>
</div>
