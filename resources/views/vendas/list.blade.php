@extends('main')

@section('titulo', 'Vendas - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-cart-check me-2"></i>Histórico de Vendas</h2>
        <small class="text-muted">Registro de vendas e produtos vendidos</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('relatorios.vendas') }}" class="btn btn-outline-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório PDF
        </a>
        <a href="{{ route('vendas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nova Venda
        </a>
    </div>

</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('vendas.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por nome do cliente..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 70px;" class="text-center">#</th>
                    <th>Cliente</th>
                    <th>Data da Venda</th>
                    <th>Forma de Pagamento</th>
                    <th class="text-center">Itens Vendidos</th>
                    <th class="text-end">Valor Total</th>
                    <th class="text-center" style="width: 200px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vendas as $venda)
                <tr>
                    <td class="text-center fw-bold text-muted">{{ $venda->id }}</td>
                    <td class="fw-semibold">
                        <i class="bi bi-person me-1 text-primary"></i>
                        {{ $venda->cliente->nome ?? '-' }}
                    </td>
                    <td>{{ date('d/m/Y', strtotime($venda->data_venda)) }}</td>
                    <td><span class="badge bg-light text-dark border">{{ $venda->forma_pagamento }}</span></td>
                    <td class="text-center">
                        <span class="badge bg-info text-dark">
                            {{ $venda->sofas->sum('pivot.quantidade') }} un ({{ $venda->sofas->count() }} modelos)
                        </span>
                    </td>
                    <td class="text-end fw-bold text-success">
                        R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('vendas.show', $venda->id) }}" class="btn btn-sm btn-info text-white" title="Visualizar Detalhes">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning" title="Editar Venda">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja realmente excluir a venda #{{ $venda->id }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir Venda">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        Nenhuma venda registrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($vendas) }}</strong> vendas cadastradas
    </div>
</div>
@endsection
