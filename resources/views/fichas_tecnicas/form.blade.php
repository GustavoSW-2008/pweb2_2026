@extends('main')

@section('titulo', isset($ficha) ? 'Editar Ficha Técnica - Pausa Sofás' : 'Nova Ficha Técnica - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($ficha) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($ficha) ? 'Editar Ficha Técnica' : 'Cadastrar Ficha Técnica (Relação 1:1)' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($ficha) ? route('fichas.update', $ficha->id) : route('fichas.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($ficha))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="sofa_id" class="form-label fw-semibold">Sofá Correspondente (1:1) <span class="text-danger">*</span></label>
                            <select name="sofa_id" id="sofa_id" class="form-select @error('sofa_id') is-invalid @enderror" required>
                                <option value="">Selecione um modelo de sofá...</option>
                                @foreach($sofas as $sofa)
                                    <option value="{{ $sofa->id }}"
                                        {{ (old('sofa_id', $ficha->sofa_id ?? '') == $sofa->id) ? 'selected' : '' }}>
                                        {{ $sofa->modelo }} (Cor: {{ $sofa->cor }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-muted">Apenas modelos que ainda não possuem ficha técnica cadastrada são exibidos.</small>
                            @error('sofa_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="tecido" class="form-label fw-semibold">Tipo de Tecido / Revestimento <span class="text-danger">*</span></label>
                            <input type="text" name="tecido" id="tecido" class="form-control @error('tecido') is-invalid @enderror"
                                   value="{{ old('tecido', $ficha->tecido ?? '') }}" placeholder="Ex: Linho Sintético Impermeável" required>
                            @error('tecido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="peso" class="form-label fw-semibold">Peso Estimado (kg) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" step="0.01" min="1" name="peso" id="peso" class="form-control @error('peso') is-invalid @enderror"
                                       value="{{ old('peso', $ficha->peso ?? '') }}" placeholder="Ex: 65.50" required>
                                <span class="input-group-text">kg</span>
                            </div>
                            @error('peso')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="dimensoes" class="form-label fw-semibold">Dimensões (L x P x A) <span class="text-danger">*</span></label>
                            <input type="text" name="dimensoes" id="dimensoes" class="form-control @error('dimensoes') is-invalid @enderror"
                                   value="{{ old('dimensoes', $ficha->dimensoes ?? '') }}" placeholder="Ex: 2.30m x 1.05m x 0.95m" required>
                            @error('dimensoes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="garantia_meses" class="form-label fw-semibold">Garantia (Meses) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" min="1" max="120" name="garantia_meses" id="garantia_meses" class="form-control @error('garantia_meses') is-invalid @enderror"
                                       value="{{ old('garantia_meses', $ficha->garantia_meses ?? 12) }}" required>
                                <span class="input-group-text">meses</span>
                            </div>
                            @error('garantia_meses')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="densidade_espuma" class="form-label fw-semibold">Densidade da Espuma / Enchimento</label>
                            <input type="text" name="densidade_espuma" id="densidade_espuma" class="form-control @error('densidade_espuma') is-invalid @enderror"
                                   value="{{ old('densidade_espuma', $ficha->densidade_espuma ?? '') }}" placeholder="Ex: D-33 Soft com Molas Ensacadas e Pillow Top">
                            @error('densidade_espuma')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($ficha) ? 'Atualizar Ficha' : 'Salvar Ficha Técnica' }}
                        </button>
                        <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
