@extends('main')

@section('titulo', isset($fornecedor) ? 'Editar Fornecedor - Pausa Sofás' : 'Novo Fornecedor - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($fornecedor) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($fornecedor) ? 'Editar Fornecedor' : 'Cadastrar Novo Fornecedor' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor->id) : route('fornecedores.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($fornecedor))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nome_fantasia" class="form-label fw-semibold">Nome Fantasia <span class="text-danger">*</span></label>
                            <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control @error('nome_fantasia') is-invalid @enderror"
                                   value="{{ old('nome_fantasia', $fornecedor->nome_fantasia ?? '') }}" placeholder="Ex: Herval Estofados" required>
                            @error('nome_fantasia')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="razao_social" class="form-label fw-semibold">Razão Social <span class="text-danger">*</span></label>
                            <input type="text" name="razao_social" id="razao_social" class="form-control @error('razao_social') is-invalid @enderror"
                                   value="{{ old('razao_social', $fornecedor->razao_social ?? '') }}" placeholder="Ex: Herval Indústria e Comércio Ltda" required>
                            @error('razao_social')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cnpj" class="form-label fw-semibold">CNPJ <span class="text-danger">*</span></label>
                            <input type="text" name="cnpj" id="cnpj" class="form-control @error('cnpj') is-invalid @enderror"
                                   value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" placeholder="00.000.000/0001-00" required>
                            @error('cnpj')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="telefone" class="form-label fw-semibold">Telefone <span class="text-danger">*</span></label>
                            <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror"
                                   value="{{ old('telefone', $fornecedor->telefone ?? '') }}" placeholder="(00) 0000-0000" required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="email_contato" class="form-label fw-semibold">E-mail Comercial <span class="text-danger">*</span></label>
                            <input type="email" name="email_contato" id="email_contato" class="form-control @error('email_contato') is-invalid @enderror"
                                   value="{{ old('email_contato', $fornecedor->email_contato ?? '') }}" placeholder="comercial@empresa.com.br" required>
                            @error('email_contato')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($fornecedor) ? 'Atualizar Fornecedor' : 'Salvar Fornecedor' }}
                        </button>
                        <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection