@extends('main')

@section('titulo', isset($endereco) ? 'Editar Endereço - Pausa Sofás' : 'Novo Endereço - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($endereco) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($endereco) ? 'Editar Endereço' : 'Cadastrar Novo Endereço' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($endereco) ? route('enderecos.update', $endereco->id) : route('enderecos.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($endereco))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="cliente_id" class="form-label fw-semibold">Cliente <span class="text-danger">*</span> (Relação 1:1)</label>
                            <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror" required>
                                <option value="">-- Selecione o Cliente --</option>
                                @foreach($clientes as $cli)
                                    <option value="{{ $cli->id }}" {{ old('cliente_id', $endereco->cliente_id ?? '') == $cli->id ? 'selected' : '' }}>
                                        {{ $cli->nome }} (CPF: {{ $cli->cpf }})
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(count($clientes) == 0 && !isset($endereco))
                                <small class="text-danger">Todos os clientes cadastrados já possuem um endereço vinculado!</small>
                            @endif
                        </div>

                        <div class="col-md-9">
                            <label for="rua" class="form-label fw-semibold">Rua / Logradouro <span class="text-danger">*</span></label>
                            <input type="text" name="rua" id="rua" class="form-control @error('rua') is-invalid @enderror"
                                   value="{{ old('rua', $endereco->rua ?? '') }}" placeholder="Ex: Av. Getúlio Vargas" required>
                            @error('rua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="numero" class="form-label fw-semibold">Número <span class="text-danger">*</span></label>
                            <input type="text" name="numero" id="numero" class="form-control @error('numero') is-invalid @enderror"
                                   value="{{ old('numero', $endereco->numero ?? '') }}" placeholder="Ex: 1200 ou S/N" required>
                            @error('numero')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="bairro" class="form-label fw-semibold">Bairro <span class="text-danger">*</span></label>
                            <input type="text" name="bairro" id="bairro" class="form-control @error('bairro') is-invalid @enderror"
                                   value="{{ old('bairro', $endereco->bairro ?? '') }}" placeholder="Ex: Centro" required>
                            @error('bairro')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cidade" class="form-label fw-semibold">Cidade <span class="text-danger">*</span></label>
                            <input type="text" name="cidade" id="cidade" class="form-control @error('cidade') is-invalid @enderror"
                                   value="{{ old('cidade', $endereco->cidade ?? 'Chapecó') }}" placeholder="Ex: Chapecó" required>
                            @error('cidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cep" class="form-label fw-semibold">CEP <span class="text-danger">*</span></label>
                            <input type="text" name="cep" id="cep" class="form-control @error('cep') is-invalid @enderror"
                                   value="{{ old('cep', $endereco->cep ?? '') }}" placeholder="89800-000" required>
                            @error('cep')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm" {{ count($clientes) == 0 && !isset($endereco) ? 'disabled' : '' }}>
                            <i class="bi bi-check-circle me-1"></i> {{ isset($endereco) ? 'Atualizar Endereço' : 'Salvar Endereço' }}
                        </button>
                        <a href="{{ route('enderecos.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
