@extends('main')

@section('titulo', isset($sofa) ? 'Editar Sofá - Pausa Sofás' : 'Novo Sofá - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4 class="mb-0 fw-bold">
                    {{ isset($sofa) ? 'Editar Sofá' : 'Cadastrar Novo Sofá' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($sofa) ? route('sofas.update', $sofa->id) : route('sofas.store') }}"
                      method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    @if(isset($sofa))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="modelo" class="form-label">Modelo <span class="text-danger">*</span></label>
                            <input type="text" name="modelo" id="modelo"
                                   class="form-control @error('modelo') is-invalid @enderror"
                                   value="{{ old('modelo', $sofa->modelo ?? '') }}"
                                   placeholder="Ex: Sofá Retrátil 3 Lugares" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cor" class="form-label">Cor <span class="text-danger">*</span></label>
                            <input type="text" name="cor" id="cor"
                                   class="form-control @error('cor') is-invalid @enderror"
                                   value="{{ old('cor', $sofa->cor ?? '') }}"
                                   placeholder="Ex: Cinza" required>
                            @error('cor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="preco" class="form-label">Preço (R$) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="preco" id="preco"
                                   class="form-control @error('preco') is-invalid @enderror"
                                   value="{{ old('preco', $sofa->preco ?? '') }}"
                                   placeholder="0.00" required>
                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="fornecedor_id" class="form-label">Fornecedor <span class="text-danger">*</span></label>
                            <select name="fornecedor_id" id="fornecedor_id"
                                    class="form-select @error('fornecedor_id') is-invalid @enderror" required>
                                <option value="">Selecione...</option>
                                @foreach($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}"
                                        {{ old('fornecedor_id', $sofa->fornecedor_id ?? '') == $fornecedor->id ? 'selected' : '' }}>
                                        {{ $fornecedor->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fornecedor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="imagem" class="form-label">Foto do Sofá</label>
                            @if(isset($sofa) && $sofa->imagem)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $sofa->imagem) }}"
                                         alt="{{ $sofa->modelo }}"
                                         style="width: 120px; height: 90px; object-fit: cover;"
                                         class="rounded border">
                                    <small class="text-muted d-block">Imagem atual</small>
                                </div>
                            @endif
                            <input type="file" name="imagem" id="imagem"
                                   class="form-control @error('imagem') is-invalid @enderror"
                                   accept="image/*">
                            <small class="text-muted">PNG, JPG ou WEBP. Máx: 2MB. Deixe vazio para manter a imagem atual.</small>
                            @error('imagem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-1"></i>
                            {{ isset($sofa) ? 'Atualizar' : 'Salvar' }}
                        </button>
                        <a href="{{ route('sofas.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection