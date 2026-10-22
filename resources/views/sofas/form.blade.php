@extends('main')

@section('titulo', isset($sofa) ? 'Editar Sofá - Pausa Sofás' : 'Novo Sofá - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($sofa) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
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
                            <label for="modelo" class="form-label fw-semibold">Modelo do Sofá <span class="text-danger">*</span></label>
                            <input type="text" name="modelo" id="modelo" class="form-control @error('modelo') is-invalid @enderror"
                                   value="{{ old('modelo', $sofa->modelo ?? '') }}" placeholder="Ex: Sofá Sevilha 3 Lugares Retrátil" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="cor" class="form-label fw-semibold">Cor <span class="text-danger">*</span></label>
                            <input type="text" name="cor" id="cor" class="form-control @error('cor') is-invalid @enderror"
                                   value="{{ old('cor', $sofa->cor ?? '') }}" placeholder="Ex: Cinza Chumbo" required>
                            @error('cor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="fornecedor_id" class="form-label fw-semibold">Fornecedor / Fabricante <span class="text-danger">*</span></label>
                            <select name="fornecedor_id" id="fornecedor_id" class="form-select @error('fornecedor_id') is-invalid @enderror" required>
                                <option value="">-- Selecione o Fornecedor --</option>
                                @foreach($fornecedores as $forn)
                                    <option value="{{ $forn->id }}" {{ old('fornecedor_id', $sofa->fornecedor_id ?? '') == $forn->id ? 'selected' : '' }}>
                                        {{ $forn->nome_fantasia }} ({{ $forn->razao_social }})
                                    </option>
                                @endforeach
                            </select>
                            @error('fornecedor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="preco" class="form-label fw-semibold">Preço Unitário (R$) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="preco" id="preco" class="form-control @error('preco') is-invalid @enderror"
                                   value="{{ old('preco', $sofa->preco ?? '') }}" placeholder="Ex: 2899.90" required>
                            @error('preco')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="quantidade_estoque" class="form-label fw-semibold">Quantidade em Estoque <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="quantidade_estoque" id="quantidade_estoque" class="form-control @error('quantidade_estoque') is-invalid @enderror"
                                   value="{{ old('quantidade_estoque', $sofa->quantidade_estoque ?? 0) }}" placeholder="Ex: 5" required>
                            @error('quantidade_estoque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold"><i class="bi bi-image me-1"></i> Foto do Sofá</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded border">
                                @if(!empty($sofa->imagem))
                                    <div>
                                        <img src="{{ asset('storage/' . $sofa->imagem) }}" alt="{{ $sofa->modelo }}" class="rounded border" style="width: 100px; height: 75px; object-fit: cover;">
                                    </div>
                                @else
                                    <div class="rounded bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 100px; height: 75px;">
                                        <i class="bi bi-box-seam fs-2"></i>
                                    </div>
                                @endif
                                <div class="flex-grow-1">
                                    <input type="file" name="imagem" id="imagem" class="form-control @error('imagem') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted d-block mt-1">Formatos aceitos: PNG, JPG, JPEG ou WEBP (máx. 2MB). Deixe vazio para manter a imagem atual.</small>
                                    @error('imagem')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($sofa) ? 'Atualizar Sofá' : 'Salvar Sofá' }}
                        </button>
                        <a href="{{ route('sofas.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
