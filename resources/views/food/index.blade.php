{{-- filepath: resources/views/food/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Receitas')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h3 class="mb-0">Receitas</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalReceita">
            + Nova Receita
        </button>
    </div>

    <div class="d-flex flex-nowrap overflow-auto gap-3 pb-2">
        @foreach($foods as $food)
            <div class="card" style="min-width: 320px; max-width: 340px;">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-start justify-content-between mb-2">
                        <div>
                            <h5 class="card-title mb-1">{{ $food->title }}</h5>
                            <div class="text-muted small">
                                Rendimento: <strong>{{ $food->yield_value }} {{ $food->yield_unit }}</strong>
                                • Porções: <strong>{{ $food->portions }}</strong>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Ações
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('web.food.show', $food->id) }}">Visualizar</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#">Remover</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted small">CMV (porção)</div>
                        <div class="fw-semibold">
                            @if(isset($food->cmv))
                                R$ {{ number_format($food->cmv, 2, ',', '.') }}
                            @else
                                <span class="text-warning small">Não informado</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted small">Custo receita</div>
                        <div class="fw-semibold">
                            @if(isset($food->cost))
                                R$ {{ number_format($food->cost, 2, ',', '.') }}
                            @else
                                <span class="text-warning small">Não informado</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted small">Custo operação</div>
                        <div class="fw-semibold">
                            @if(isset($food->operation_cost))
                                R$ {{ number_format($food->operation_cost, 2, ',', '.') }}
                            @else
                                <span class="text-warning small">Não informado</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-2">
                        <div class="text-muted small">Sugestão de venda</div>
                        <div class="fw-semibold">
                            @if(isset($food->suggested_price))
                                R$ {{ number_format($food->suggested_price, 2, ',', '.') }}
                            @else
                                <span class="text-warning small">Não informado</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Modal de Nova Receita -->
    <x-food.modal.recipe-form title="Nova receita" modalId="modalReceita" />
</div>
@endsection