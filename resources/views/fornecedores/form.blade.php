@extends('main')

@section('titulo', isset($fornecedor) ? 'Editar Fornecedor - Pausa Sofás' : 'Novo Fornecedor - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
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

                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">Razão Social / Nome Fantasia <span class="text-danger">*</span></label>
                        <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                               value="{{ old('nome', $fornecedor->nome ?? '') }}" placeholder="Ex: Estofados Requinte Ltda" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cnpj" class="form-label fw-semibold">CNPJ <span class="text-danger">*</span></label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control @error('cnpj') is-invalid @enderror"
                               value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}" placeholder="00.000.000/0001-00" required>
                        @error('cnpj')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">E-mail Comercial <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email', $fornecedor->email ?? '') }}" placeholder="contato@empresa.com.br" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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