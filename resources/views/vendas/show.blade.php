@extends('main')

@section('titulo', 'Detalhes da Venda #' . $venda->id . ' - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold">
                    <i class="bi bi-receipt me-2 text-primary"></i> Comprovante da Venda #{{ $venda->id }}
                </h4>
                <div>
                    <span class="badge bg-success fs-6">Concluída</span>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="text-muted fw-bold">Dados do Cliente</h6>
                        <p class="mb-1 fw-bold fs-5">{{ $venda->cliente->nome }}</p>
                        <p class="mb-1 text-muted"><strong>CPF:</strong> {{ $venda->cliente->cpf }}</p>
                        <p class="mb-1 text-muted"><strong>Telefone:</strong> {{ $venda->cliente->telefone }}</p>
                        <p class="mb-0 text-muted"><strong>E-mail:</strong> {{ $venda->cliente->email }}</p>
                    </div>
                    <div class="col-sm-6 text-sm-end">
                        <h6 class="text-muted fw-bold">Informações da Venda</h6>
                        <p class="mb-1"><strong>Data:</strong> {{ date('d/m/Y', strtotime($venda->data_venda)) }}</p>
                        <p class="mb-1"><strong>Pagamento:</strong> <span class="badge bg-secondary">{{ $venda->forma_pagamento }}</span></p>
                        <p class="mb-0"><strong>Registrada em:</strong> {{ $venda->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 border-bottom pb-2">
                    <i class="bi bi-box-seam me-2"></i>Itens Comprados
                </h5>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Item / Modelo</th>
                                <th>Cor</th>
                                <th class="text-center">Quantidade</th>
                                <th class="text-end">Preço Unitário</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venda->sofas as $sofa)
                            @php
                                $subtotal = $sofa->pivot->preco_unitario * $sofa->pivot->quantidade;
                            @endphp
                            <tr>
                                <td class="fw-semibold">{{ $sofa->modelo }}</td>
                                <td>{{ $sofa->cor }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary fs-6">{{ $sofa->pivot->quantidade }} un</span>
                                </td>
                                <td class="text-end">R$ {{ number_format($sofa->pivot->preco_unitario, 2, ',', '.') }}</td>
                                <td class="text-end fw-bold">R$ {{ number_format($subtotal, 2, ',', '.') }}</td>
                            </tr>
                            @endforeach
                            <tr class="table-light">
                                <td colspan="4" class="text-end fw-bold fs-5">Valor Total:</td>
                                <td class="text-end fw-bold text-success fs-5">
                                    R$ {{ number_format($venda->valor_total, 2, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between pt-3 border-top">
                    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Voltar para Listagem
                    </a>
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i> Editar Venda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
