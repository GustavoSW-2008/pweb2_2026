@extends('main')

@section('titulo', isset($fichaTecnica) ? 'Editar Ficha Técnica - Pausa Sofás' : 'Nova Ficha Técnica - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($fichaTecnica) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($fichaTecnica) ? 'Editar Ficha Técnica' : 'Cadastrar Nova Ficha Técnica' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($fichaTecnica) ? route('fichas-tecnicas.update', $fichaTecnica->id) : route('fichas-tecnicas.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($fichaTecnica))
                        @method('PUT')
                    @endif

                    <div class="row g-3">
                        <div class="col-12">
                            <label for="sofa_id" class="form-label fw-semibold">Sofá <span class="text-danger">*</span></label>
                            <select name="sofa_id" id="sofa_id" class="form-select @error('sofa_id') is-invalid @enderror" required>
                                <option value="">-- Selecione o Sofá --</option>
                                @foreach($sofas as $sofa)
                                    <option value="{{ $sofa->id }}" {{ old('sofa_id', $fichaTecnica->sofa_id ?? '') == $sofa->id ? 'selected' : '' }}>
                                        {{ $sofa->modelo }} (Cor: {{ $sofa->cor }})
                                    </option>
                                @endforeach
                            </select>
                            @error('sofa_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="altura" class="form-label fw-semibold">Altura (metros) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="altura" id="altura" class="form-control @error('altura') is-invalid @enderror"
                                   value="{{ old('altura', $fichaTecnica->altura ?? '') }}" placeholder="Ex: 1.05" required>
                            @error('altura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="largura" class="form-label fw-semibold">Largura (metros) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="largura" id="largura" class="form-control @error('largura') is-invalid @enderror"
                                   value="{{ old('largura', $fichaTecnica->largura ?? '') }}" placeholder="Ex: 2.30" required>
                            @error('largura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="profundidade" class="form-label fw-semibold">Profundidade (metros) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="profundidade" id="profundidade" class="form-control @error('profundidade') is-invalid @enderror"
                                   value="{{ old('profundidade', $fichaTecnica->profundidade ?? '') }}" placeholder="Ex: 1.10" required>
                            @error('profundidade')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label for="tecido" class="form-label fw-semibold">Tipo de Tecido <span class="text-danger">*</span></label>
                            <input type="text" name="tecido" id="tecido" class="form-control @error('tecido') is-invalid @enderror"
                                   value="{{ old('tecido', $fichaTecnica->tecido ?? '') }}" placeholder="Ex: Linho Nobre, Veludo Soft, Suede Prime" required>
                            @error('tecido')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="peso" class="form-label fw-semibold">Peso Aproximado (kg) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" name="peso" id="peso" class="form-control @error('peso') is-invalid @enderror"
                                   value="{{ old('peso', $fichaTecnica->peso ?? '') }}" placeholder="Ex: 68.50" required>
                            @error('peso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($fichaTecnica) ? 'Atualizar Ficha Técnica' : 'Salvar Ficha Técnica' }}
                        </button>
                        <a href="{{ route('fichas-tecnicas.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
