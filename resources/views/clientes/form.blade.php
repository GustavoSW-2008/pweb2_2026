@extends('main')

@section('titulo', isset($cliente) ? 'Editar Cliente - Pausa Sofás' : 'Novo Cliente - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($cliente) ? 'bi-pencil-square text-warning' : 'bi-person-plus text-success' }} me-2"></i>
                    {{ isset($cliente) ? 'Editar Cliente' : 'Cadastrar Novo Cliente' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($cliente))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="nome" class="form-label fw-semibold">Nome Completo <span class="text-danger">*</span></label>
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                                   value="{{ old('nome', $cliente->nome ?? '') }}" placeholder="Ex: João da Silva" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cpf" class="form-label fw-semibold">CPF <span class="text-danger">*</span></label>
                            <input type="text" name="cpf" id="cpf" class="form-control @error('cpf') is-invalid @enderror"
                                   value="{{ old('cpf', $cliente->cpf ?? '') }}" placeholder="000.000.000-00" required>
                            @error('cpf')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="telefone" class="form-label fw-semibold">Telefone / WhatsApp <span class="text-danger">*</span></label>
                            <input type="text" name="telefone" id="telefone" class="form-control @error('telefone') is-invalid @enderror"
                                   value="{{ old('telefone', $cliente->telefone ?? '') }}" placeholder="(00) 00000-0000" required>
                            @error('telefone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="idade" class="form-label fw-semibold">Idade</label>
                            <input type="number" name="idade" id="idade" min="0" max="150" class="form-control @error('idade') is-invalid @enderror"
                                   value="{{ old('idade', $cliente->idade ?? '') }}" placeholder="Ex: 32">
                            @error('idade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="endereco" class="form-label fw-semibold">Endereço Completo</label>
                            <input type="text" name="endereco" id="endereco" class="form-control @error('endereco') is-invalid @enderror"
                                   value="{{ old('endereco', $cliente->endereco ?? '') }}" placeholder="Rua, número, bairro, cidade">
                            @error('endereco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload de Foto do Cliente -->
                        <div class="col-12">
                            <label class="form-label fw-semibold"><i class="bi bi-camera me-1"></i> Foto de Perfil do Cliente</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border">
                                @if(!empty($cliente->imagem))
                                    <div>
                                        <img src="{{ asset('storage/' . $cliente->imagem) }}" alt="{{ $cliente->nome }}" class="rounded-circle border" style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                        <i class="bi bi-person fs-1"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="imagem" id="imagem" class="form-control @error('imagem') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted d-block mt-1">Formatos aceitos: PNG, JPG, JPEG ou WEBP (máx. 2MB). Deixe em branco para manter a foto atual.</small>
                                    @error('imagem')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($cliente) ? 'Atualizar Cliente' : 'Salvar Cliente' }}
                        </button>
                        <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection