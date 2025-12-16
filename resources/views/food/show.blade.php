@extends('layouts.app')

@section('title', 'Nova Receita')

@section('content')


<div class="container py-4">
    <!-- Header -->
    <div class="d-flex align-items-start justify-content-between gap-3 mb-3">
        <div>
            <h3 class="mb-1">Lavien</h3>
            <div class="text-muted small">Rendimento: <strong>1 kg</strong> • Porções: <strong>400</strong></div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalReceita">
                Editar receita
            </button>
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Ações
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalReceita">Editar</a></li>
                    <li><a class="dropdown-item" href="#">Preparo</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="#">Remover</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- KPIs -->
    <div class="row g-2 mb-4">
        <div class="col-12 col-md-3">
            <div class="border rounded p-3">
                <div class="text-muted small">CMV (porção)</div>
                <div class="fw-semibold">R$ 2,54</div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="border rounded p-3">
                <div class="text-muted small">Custo receita</div>
                <div class="fw-semibold">R$ 2,54</div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="border rounded p-3">
                <div class="text-muted small">Custo operação</div>
                <div class="fw-semibold">R$ 2,54</div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="border rounded p-3">
                <div class="text-muted small">Sugestão de venda</div>
                <div class="fw-semibold">R$ 2,54</div>
            </div>
        </div>
    </div>

    <!-- Ingredientes -->
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h5 class="mb-0">Ingredientes</h5>
        <div class="d-flex align-items-center gap-2">
            <div class="form-check form-switch mb-0">
                <input class="form-check-input" type="checkbox" role="switch" data-preparo-ingrediente-switch checked>
                <label class="form-check-label small">Exibir preparo por ingrediente</label>
            </div>
            <span class="mx-1"></span>
            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalIngrediente">+ Adicionar ingrediente</button>
        </div>  
    </div>

    @foreach(['1','2', '3'] as $item)
      
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between gap-3">
                <div class="flex-grow-1">
                    <div class="row g-2">
                        <div class="col-6 col-md-6">
                            <div class="fw-semibold fs-4">Farinha de Trigo</div>
                            <div class="text-muted small">R$ 23,99 (pacote 5.000g) • R$ 0,004798/g</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.7em;">Quantidade <span class="badge text-bg-light border">fc 1.0</span></div>
                                    <div class="fw-semibold fs-5">400g</div>
                                    <div class="text-muted small" style="font-size: 0.7em;">400g bruto</div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="text-muted small fw-semibold" style="font-size: 0.7em;">Total</div>
                                    <div class="fw-semibold fs-5">R$ 1,92</div>
                                    <div class="text-muted small" style="font-size: 0.7em;">R$ 0,004798/g</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-2 col-md-3 text-end">
                            <div class="d-flex align-items-center gap-2">
                                <button class="btn btn-lg btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalIngrediente" title="Editar">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <button class="btn btn-lg btn-outline-danger" title="Remover">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3" data-preparo-ingrediente-box>
                        <hr class="my-2">
                        <div class="text-muted small fw-semibold">Preparo</div>
                        <div class="small">Misture com os outros ingredientes.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Custo operacional -->
    <div class="d-flex align-items-center justify-content-between mb-2">
        <h5 class="mb-0">Custo operacional</h5>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalCusto">
            + Adicionar custo
        </button>
    </div>
    <div class="table-responsive mb-4">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tipo</th>
                    <th style="width: 140px;">Quantidade</th>
                    <th style="width: 140px;">Total</th>
                    <th style="width: 90px;"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Tempo da cozinheira</td>
                    <td>1 hora</td>
                    <td class="fw-semibold">R$ 10,00</td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">...</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCusto">Editar</a></li>
                                <li><a class="dropdown-item text-danger" href="#">Remover</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Gás</td>
                    <td>5 min</td>
                    <td class="fw-semibold">R$ 10,00</td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown">...</button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCusto">Editar</a></li>
                                <li><a class="dropdown-item text-danger" href="#">Remover</a></li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Preparo (receita) -->
    <h5 class="mb-2">Preparo</h5>
    <div class="border rounded p-3">
        <div class="text-muted small">Misture com os outros ingredientes.</div>
    </div>
</div>

<!-- ========================================================= -->
<!-- MODAL 1: Receita (Novo/Editar) -->
<!-- ========================================================= -->
<div class="modal fade" id="modalReceita" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" action="#">
      <div class="modal-header">
        <h5 class="modal-title">Novo/Editar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label class="form-label">Nome</label>
          <input type="text" class="form-control" name="nome" value="Lavien" placeholder="Ex: Pão Italiano">
        </div>

        <div class="row g-2 mb-3">
          <div class="col-4">
            <label class="form-label">Rendimento</label>
            <input type="number" step="0.01" class="form-control" name="rendimento_valor" value="1.0">
          </div>
          <div class="col-4">
            <label class="form-label">Em</label>
            <select class="form-select" name="rendimento_unidade">
              <option value="g">g</option>
              <option value="kg" selected>kg</option>
              <option value="ml">ml</option>
              <option value="l">L</option>
              <option value="un">un</option>
            </select>
          </div>
          <div class="col-4">
            <label class="form-label">Porções</label>
            <input type="number" class="form-control" name="porcoes" value="400">
          </div>
        </div>

        <div class="mb-2">
          <label class="form-label">Modo de preparo</label>
          <textarea class="form-control" name="modo_preparo" rows="4" placeholder="Descreva o preparo da receita..."></textarea>
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="submit" class="btn btn-success">
          Salvar
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL 2: Ingrediente (Novo/Editar insumo) -->
<!-- ========================================================= -->
<div class="modal fade" id="modalIngrediente" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" action="#">
      <div class="modal-header">
        <h5 class="modal-title">Novo/Editar</h5>

        <div class="d-flex align-items-center gap-2 ms-2">
          <button type="button" class="btn btn-sm btn-primary">+ Novo insumo</button>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">Insumo</label>
          <div class="input-group">
            <select class="form-select" name="insumo_id">
              <option selected>Isca Fermento Natural</option>
              <option>Farinha de Trigo</option>
              <option>Sal</option>
            </select>
            <button class="btn btn-outline-secondary" type="button" title="Editar insumo">✎</button>
            <button class="btn btn-outline-danger" type="button" title="Remover">🗑</button>
          </div>

          <div class="d-flex justify-content-between text-muted small mt-1">
            <span>R$ 23,99 pacote 5.000g</span>
            <span>R$ 0,004798/g</span>
          </div>
        </div>

        <div class="row g-2 mb-2">
          <div class="col-4">
            <label class="form-label">FC</label>
            <input type="number" step="0.01" class="form-control" name="fc" value="1.0">
          </div>
          <div class="col-5">
            <label class="form-label">Quantidade líquida</label>
            <input type="number" step="0.01" class="form-control" name="quantidade_liquida" value="400">
          </div>
          <div class="col-3">
            <label class="form-label">Em</label>
            <select class="form-select" name="unidade">
              <option value="g" selected>g</option>
              <option value="kg">kg</option>
              <option value="ml">ml</option>
              <option value="l">L</option>
              <option value="un">un</option>
            </select>
          </div>
        </div>

        <div class="text-muted small mb-3">
          400g bruto: total de <strong>R$ 1,92</strong>.
        </div>

        <div class="mb-2">
          <label class="form-label">Modo de preparo</label>
          <textarea class="form-control" name="modo_preparo_ingrediente" rows="4" placeholder="Preparo específico deste ingrediente..."></textarea>
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="submit" class="btn btn-success">
          Salvar
        </button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================= -->
<!-- MODAL 3: Custo operacional (Novo/Editar custo) -->
<!-- ========================================================= -->
<div class="modal fade" id="modalCusto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form class="modal-content" method="post" action="#">
      <div class="modal-header">
        <h5 class="modal-title">Novo/Editar</h5>

        <div class="d-flex align-items-center gap-2 ms-2">
          <button type="button" class="btn btn-sm btn-primary">+ Novo insumo</button>
        </div>

        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">Tipo do custo</label>
          <div class="input-group">
            <select class="form-select" name="tipo_custo">
              <option selected>Tempo da cozinheira</option>
              <option>Gás</option>
              <option>Energia elétrica</option>
              <option>Embalagem</option>
            </select>
            <button class="btn btn-outline-secondary" type="button" title="Editar">✎</button>
            <button class="btn btn-outline-danger" type="button" title="Remover">🗑</button>
          </div>

          <div class="d-flex justify-content-between text-muted small mt-1">
            <span>R$ 10,00</span>
            <span>&nbsp;</span>
          </div>
        </div>

        <div class="row g-2 mb-2">
          <div class="col-4">
            <label class="form-label">Quantidade</label>
            <input type="number" step="0.01" class="form-control" name="quantidade" value="1">
          </div>
          <div class="col-4">
            <label class="form-label">Em</label>
            <select class="form-select" name="unidade_tempo">
              <option value="min">Minutos</option>
              <option value="h" selected>Horas</option>
              <option value="un">Un</option>
            </select>
          </div>
          <div class="col-4">
            <label class="form-label">Valor</label>
            <input type="number" step="0.01" class="form-control" name="valor" value="10.00">
          </div>
        </div>
      </div>

      <div class="modal-footer d-flex justify-content-between">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="submit" class="btn btn-success">
          Salvar
        </button>
      </div>
    </form>
  </div>
</div>

@once
  @push('scripts')
    <script>
    document.querySelectorAll('[data-preparo-ingrediente-switch]').forEach(switchPrepare => {
      // Busca o box mais próximo dentro do mesmo card/componente
      const prepares = document.querySelectorAll('[data-preparo-ingrediente-box]');

      prepares.forEach(prepare => {
          if (switchPrepare && prepare) {
            const apply = () => prepare.style.display = switchPrepare.checked ? 'block' : 'none';
            switchPrepare.addEventListener('change', apply);
            apply();
          }
      });
    });
    </script>
  @endpush
@endonce
