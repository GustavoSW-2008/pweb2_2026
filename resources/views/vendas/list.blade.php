@extends('main')

@section('titulo', 'Vendas - Pausa Sofás')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-cart-check me-2"></i> Listagem de Vendas</h2>
        <small class="text-muted">Registro de pedidos, valores e formas de pagamento</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('vendas.report') }}" class="btn btn-danger shadow-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório em PDF
        </a>
        <a href="{{ route('vendas.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Nova Venda
        </a>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('vendas.search') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar por cliente, modelo do sofá, forma de pagamento ou data..." value="{{ $buscar ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($buscar))
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
                    <th style="width: 50px;">#</th>
                    <th>Data</th>
                    <th>Cliente</th>
                    <th>Sofá</th>
                    <th class="text-center">Qtd</th>
                    <th>Forma de Pagto</th>
                    <th class="text-end">Valor Total</th>
                    <th class="text-center" style="width: 170px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($vendas as $venda)
                <tr>
                    <td>{{ $venda->id }}</td>
                    <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
                    <td class="fw-semibold">
                        <i class="bi bi-person me-1 text-muted"></i>{{ $venda->cliente->nome ?? 'Cliente não encontrado' }}
                    </td>
                    <td>
                        <i class="bi bi-box me-1 text-muted"></i>{{ $venda->sofa->modelo ?? 'Sofá não encontrado' }}
                    </td>
                    <td class="text-center">
                        <span class="badge bg-secondary">{{ $venda->quantidade }}</span>
                    </td>
                    <td>
                        <span class="badge bg-info text-dark">{{ $venda->forma_pagamento }}</span>
                    </td>
                    <td class="text-end fw-bold text-success">
                        R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                    </td>
                    <td class="text-center">
                        <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Deseja realmente excluir esta venda #{{ $venda->id }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                        Nenhuma venda encontrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-muted small py-2 d-flex justify-content-between align-items-center">
        <span>Total de vendas: <strong>{{ count($vendas) }}</strong></span>
        <span>Faturamento total listado: <strong class="text-success">R$ {{ number_format($vendas->sum('valor_total'), 2, ',', '.') }}</strong></span>
    </div>
</div>
@endsection
