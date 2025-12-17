{{-- resources/views/components/food/modal/recipe-form.blade.php --}}
<div class="modal fade" id="{{ $modalId ?? '' }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" method="post" action="{{ $route ?? '' }}">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title">{{ $title ?? 'Formulario de receita' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nome <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="title" value="{{ $name ?? '' }}" placeholder="Ex: Pão Italiano" required>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-4">
                        <label class="form-label">Rendimento <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" name="yield[value]" value="{{ $yield ?? '' }}" required>
                    </div>
                    <div class="col-2">
                        <label class="form-label">Em <span class="text-danger">*</span></label>
                        <select class="form-select" name="yield[unit]">
                            <option value="g" @selected(($unit ?? '') == 'g')>g</option>
                            <option value="kg" @selected(($unit ?? '') == 'kg')>kg</option>
                            <option value="ml" @selected(($unit ?? '') == 'ml')>ml</option>
                            <option value="l" @selected(($unit ?? '') == 'l')>L</option>
                            <option value="un" @selected(($unit ?? '') == 'un')>un</option>
                        </select>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <label class="form-label">Porções <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="portions" value="{{ $portions ?? '' }}" required>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="form-label">Modo de preparo</label>
                    <textarea class="form-control" name="modo_preparo" rows="4" placeholder="Descreva o preparo da receita...">{{ $preparation ?? '' }}</textarea>
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>
