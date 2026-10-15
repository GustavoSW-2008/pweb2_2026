@extends('main')

@section('titulo', isset($venda) ? 'Editar Venda - Pausa Sofás' : 'Nova Venda - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($venda) ? 'bi-pencil-square text-warning' : 'bi-cart-plus text-success' }} me-2"></i>
                    {{ isset($venda) ? 'Editar Venda' : 'Registrar Nova Venda' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($venda) ? route('vendas.update', $venda->id) : route('vendas.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($venda))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label fw-semibold">Cliente <span class="text-danger">*</span></label>
                            <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                <option value="">Selecione o cliente...</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}"
                                        {{ (old('cliente_id', $venda->cliente_id ?? '') == $cliente->id) ? 'selected' : '' }}>
                                        {{ $cliente->nome }} (CPF: {{ $cliente->cpf }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="sofa_id" class="form-label fw-semibold">Sofá <span class="text-danger">*</span></label>
                            <select name="sofa_id" id="sofa_id" class="form-select @error('sofa_id') is-invalid @enderror" required>
                                <option value="">Selecione o sofá...</option>
                                @foreach($sofas as $sofa)
                                    <option value="{{ $sofa->id }}"
                                        {{ (old('sofa_id', $venda->sofa_id ?? '') == $sofa->id) ? 'selected' : '' }}>
                                        {{ $sofa->modelo }} — R$ {{ number_format($sofa->preco, 2, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sofa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="quantidade" class="form-label fw-semibold">Quantidade <span class="text-danger">*</span></label>
                            <input type="number" min="1" name="quantidade" id="quantidade" class="form-control @error('quantidade') is-invalid @enderror"
                                   value="{{ old('quantidade', $venda->quantidade ?? 1) }}" required>
                            @error('quantidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="forma_pagamento" class="form-label fw-semibold">Forma de Pagamento <span class="text-danger">*</span></label>
                            @php
                                $pagamentoAtual = old('forma_pagamento', $venda->forma_pagamento ?? 'PIX');
                            @endphp
                            <select name="forma_pagamento" id="forma_pagamento" class="form-select @error('forma_pagamento') is-invalid @enderror" required>
                                <option value="PIX" {{ $pagamentoAtual == 'PIX' ? 'selected' : '' }}>PIX</option>
                                <option value="Cartão de Crédito" {{ $pagamentoAtual == 'Cartão de Crédito' ? 'selected' : '' }}>Cartão de Crédito</option>
                                <option value="Cartão de Débito" {{ $pagamentoAtual == 'Cartão de Débito' ? 'selected' : '' }}>Cartão de Débito</option>
                                <option value="Boleto Bancário" {{ $pagamentoAtual == 'Boleto Bancário' ? 'selected' : '' }}>Boleto Bancário</option>
                                <option value="Dinheiro" {{ $pagamentoAtual == 'Dinheiro' ? 'selected' : '' }}>Dinheiro à Vista</option>
                            </select>
                            @error('forma_pagamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="data_venda" class="form-label fw-semibold">Data da Venda <span class="text-danger">*</span></label>
                            <input type="date" name="data_venda" id="data_venda" class="form-control @error('data_venda') is-invalid @enderror"
                                   value="{{ old('data_venda', isset($venda) ? \Carbon\Carbon::parse($venda->data_venda)->format('Y-m-d') : date('Y-m-d')) }}" required>
                            @error('data_venda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($venda) ? 'Atualizar Venda' : 'Confirmar Venda' }}
                        </button>
                        <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
