@extends('main')

@section('titulo', 'Vendas - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-cart-check me-2"></i>Listagem de Vendas</h2>
        <small class="text-muted">Registro de pedidos e pagamentos</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('vendas.report') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório PDF
        </a>
        <a href="{{ route('vendas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Nova Venda
        </a>
    </div>
</div>

{{-- Busca via GET ?search= --}}
<div class="card mb-4">
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
                    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
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
                    <th>#</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Sofá</th>
                    <th class="text-center">Qtd</th>
                    <th>Pagamento</th>
                    <th class="text-end">Valor Total</th>
                    <th class="text-center" style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ date('d/m/Y', strtotime($venda->data_venda)) }}</td>
                    <td>{{ $venda->cliente->nome ?? '-' }}</td>
                    <td>{{ $venda->sofa->modelo ?? '-' }}</td>
                    <td class="text-center">{{ $venda->quantidade }}</td>
                    <td>{{ $venda->forma_pagamento }}</td>
                    <td class="text-end fw-bold text-success">
                        R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja excluir esta venda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        Nenhuma venda encontrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small d-flex justify-content-between">
        <span>Total: <strong>{{ count($vendas) }}</strong> vendas</span>
        <span>Faturamento listado: <strong class="text-success">R$ {{ number_format($vendas->sum('valor_total'), 2, ',', '.') }}</strong></span>
    </div>
</div>
@endsection
