@extends('main')

@section('titulo', isset($categoria) ? 'Editar Categoria - Pausa Sofás' : 'Nova Categoria - Pausa Sofás')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 fw-bold text-dark">
                    <i class="bi {{ isset($categoria) ? 'bi-pencil-square text-warning' : 'bi-plus-circle text-success' }} me-2"></i>
                    {{ isset($categoria) ? 'Editar Categoria' : 'Cadastrar Nova Categoria' }}
                </h4>
            </div>
            <div class="card-body p-4">
                <form action="{{ isset($categoria) ? route('categorias.update', $categoria->id) : route('categorias.store') }}"
                      method="POST">
                    @csrf
                    @if(isset($categoria))
                        @method('PUT')
                    @endif

                    <div class="mb-3">
                        <label for="nome" class="form-label fw-semibold">Nome da Categoria <span class="text-danger">*</span></label>
                        <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                               value="{{ old('nome', $categoria->nome ?? '') }}" placeholder="Ex: Retrátil e Reclinável" required>
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label fw-semibold">Descrição</label>
                        <textarea name="descricao" id="descricao" rows="3" class="form-control @error('descricao') is-invalid @enderror"
                                  placeholder="Descrição detalhada dos modelos desta categoria...">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4 shadow-sm">
                            <i class="bi bi-check-circle me-1"></i> {{ isset($categoria) ? 'Atualizar Categoria' : 'Salvar Categoria' }}
                        </button>
                        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Voltar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
