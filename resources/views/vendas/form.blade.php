@extends('main')

@section('titulo', isset($venda) ? 'Editar Venda - Pausa Sofás' : 'Nova Venda - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($venda) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($venda) ? 'Editar Venda #' . $venda->id : 'Registrar Nova Venda' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($venda) ? route('vendas.update', $venda->id) : route('vendas.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($venda))
                        @method('PUT')
                    @endif

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label fw-semibold">Cliente <span class="text-danger">*</span></label>
                            <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                <option value="">-- Selecione o Cliente --</option>
                                @foreach($clientes as $cli)
                                    <option value="{{ $cli->id }}" {{ old('cliente_id', $venda->cliente_id ?? '') == $cli->id ? 'selected' : '' }}>
                                        {{ $cli->nome }} (CPF: {{ $cli->cpf }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="data_venda" class="form-label fw-semibold">Data da Venda <span class="text-danger">*</span></label>
                            <input type="date" name="data_venda" id="data_venda" class="form-control @error('data_venda') is-invalid @enderror"
                                   value="{{ old('data_venda', isset($venda) ? $venda->data_venda : date('Y-m-d')) }}" required>
                            @error('data_venda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="forma_pagamento" class="form-label fw-semibold">Forma de Pagamento <span class="text-danger">*</span></label>
                            <select name="forma_pagamento" id="forma_pagamento" class="form-select @error('forma_pagamento') is-invalid @enderror" required>
                                @php
                                    $formas = ['Cartão de Crédito', 'PIX', 'Boleto Bancário', 'Dinheiro'];
                                    $pagAtual = old('forma_pagamento', $venda->forma_pagamento ?? 'PIX');
                                @endphp
                                @foreach($formas as $f)
                                    <option value="{{ $f }}" {{ $pagAtual == $f ? 'selected' : '' }}>{{ $f }}</option>
                                @endforeach
                            </select>
                            @error('forma_pagamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <h5 class="fw-bold mb-3 border-bottom pb-2">
                        <i class="bi bi-box-seam me-2"></i>Produtos da Venda
                    </h5>

                    <div class="table-responsive mb-3">
                        <table class="table table-bordered align-middle" id="tabelaItens">
                            <thead class="table-light">
                                <tr>
                                    <th>Sofá</th>
                                    <th style="width: 150px;">Quantidade</th>
                                    <th style="width: 80px;" class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody id="itensContainer">
                                @if(isset($venda) && $venda->sofas->count() > 0)
                                    @foreach($venda->sofas as $index => $itemSofa)
                                    <tr>
                                        <td>
                                            <select name="itens[{{ $index }}][sofa_id]" class="form-select" required>
                                                <option value="">-- Selecione o Sofá --</option>
                                                @foreach($sofas as $s)
                                                    <option value="{{ $s->id }}" {{ $itemSofa->id == $s->id ? 'selected' : '' }}>
                                                        {{ $s->modelo }} - {{ $s->cor }} (R$ {{ number_format($s->preco, 2, ',', '.') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="itens[{{ $index }}][quantidade]" class="form-control" min="1" value="{{ $itemSofa->pivot->quantidade }}" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-remover-linha">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <select name="itens[0][sofa_id]" class="form-select" required>
                                                <option value="">-- Selecione o Sofá --</option>
                                                @foreach($sofas as $s)
                                                    <option value="{{ $s->id }}">
                                                        {{ $s->modelo }} - {{ $s->cor }} (R$ {{ number_format($s->preco, 2, ',', '.') }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="itens[0][quantidade]" class="form-control" min="1" value="1" required>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-outline-danger btn-sm btn-remover-linha" disabled>
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mb-4">
                        <button type="button" class="btn btn-outline-primary btn-sm" id="btnAdicionarLinha">
                            <i class="bi bi-plus-lg me-1"></i> Adicionar Outro Sofá
                        </button>
                    </div>

                    <div class="pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($venda) ? 'Atualizar Venda' : 'Finalizar Venda' }}
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

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('itensContainer');
        const btnAdicionar = document.getElementById('btnAdicionarLinha');
        let index = container.querySelectorAll('tr').length;

        btnAdicionar.addEventListener('click', function () {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <select name="itens[${index}][sofa_id]" class="form-select" required>
                        <option value="">-- Selecione o Sofá --</option>
                        @foreach($sofas as $s)
                            <option value="{{ $s->id }}">
                                {{ $s->modelo }} - {{ $s->cor }} (R$ {{ number_format($s->preco, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" name="itens[${index}][quantidade]" class="form-control" min="1" value="1" required>
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-outline-danger btn-sm btn-remover-linha">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            container.appendChild(tr);
            index++;
            atualizarBotoesRemover();
        });

        container.addEventListener('click', function (e) {
            if (e.target.closest('.btn-remover-linha')) {
                const linhas = container.querySelectorAll('tr');
                if (linhas.length > 1) {
                    e.target.closest('tr').remove();
                    atualizarBotoesRemover();
                }
            }
        });

        function atualizarBotoesRemover() {
            const linhas = container.querySelectorAll('tr');
            linhas.forEach(linha => {
                const btn = linha.querySelector('.btn-remover-linha');
                if (btn) {
                    btn.disabled = linhas.length === 1;
                }
            });
        }

        atualizarBotoesRemover();
    });
</script>
@endsection
