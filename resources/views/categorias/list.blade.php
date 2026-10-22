@extends('main')

@section('titulo', 'Categorias - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-tags me-2"></i>Listagem de Categorias</h2>
        <small class="text-muted">Gerenciamento das categorias de sofás</small>
    </div>
    <a href="{{ route('categorias.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Nova Categoria
    </a>
</div>

{{-- Formulário de busca via GET ?search= --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('categorias.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar categoria por nome..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 80px;">#</th>
                    <th>Nome da Categoria</th>
                    <th>Descrição</th>
                    <th class="text-center" style="width: 160px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td class="fw-semibold">{{ $categoria->nome }}</td>
                    <td><small class="text-muted">{{ $categoria->descricao ?? 'Sem descrição' }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja realmente remover a categoria {{ $categoria->nome }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">
                        Nenhuma categoria encontrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($categorias) }}</strong> categorias
    </div>
</div>
@endsection
