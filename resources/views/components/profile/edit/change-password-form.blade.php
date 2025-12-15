<div class="card mb-4">
    <div class="card-header">Alterar Senha</div>
    <div class="card-body">
        <form method="POST" action="{{ route('profile.update') }}" data-profile-edit-password-form>
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="password" class="form-label">Nova senha</label>
                <input type="password" class="form-control" name="password" autocomplete="new-password" data-profile-edit-password>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar nova senha</label>
                <input type="password" class="form-control" name="password_confirmation" autocomplete="new-password" data-profile-edit-password-confirmation>
            </div>
            <div class="text-danger mb-2" data-profile-edit-password-error style="display:none;"></div>
            <button type="submit" class="btn btn-warning">Alterar Senha</button>
        </form>
    </div>
</div>
@once
    @push('scripts')
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-profile-edit-password-form]').forEach(function(form) {
                // Evita múltiplos listeners no mesmo form
                if (form.dataset.profileEditPasswordListenerAttached) return;
                form.dataset.profileEditPasswordListenerAttached = 'true';
                form.addEventListener('submit', function (event) {
                    const password = form.querySelector('[data-profile-edit-password]').value;
                    const confirmation = form.querySelector('[data-profile-edit-password-confirmation]').value;
                    const errorDiv = form.querySelector('[data-profile-edit-password-error]');
                    if (password !== confirmation) {
                        errorDiv.textContent = 'As senhas não coincidem.';
                        errorDiv.style.display = 'block';
                        event.preventDefault();
                    } else {
                        errorDiv.style.display = 'none';
                    }
                });
            });
        });
        </script>
    @endpush
@endonce
</script>
