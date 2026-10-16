@extends('main')

@section('titulo', 'Sofás - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-box-seam me-2"></i>Catálogo de Sofás</h2>
        <small class="text-muted">Gerenciamento dos sofás da loja</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sofas.report') }}" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório PDF
        </a>
        <a href="{{ route('sofas.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle me-1"></i> Novo Sofá
        </a>
    </div>
</div>

{{-- Busca via GET ?search= --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('sofas.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por modelo..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('sofas.index') }}" class="btn btn-outline-secondary">
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
                    <th style="width: 80px;">Foto</th>
                    <th>Modelo</th>
                    <th>Cor</th>
                    <th>Preço</th>
                    <th>Fornecedor</th>
                    <th class="text-center">Ficha Técnica</th>
                    <th class="text-center" style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sofas as $sofa)
                <tr>
                    <td>
                        @if($sofa->imagem)
                            <img src="{{ asset('storage/' . $sofa->imagem) }}"
                                 alt="{{ $sofa->modelo }}"
                                 class="product-thumbnail">
                        @else
                            <div class="product-thumbnail d-flex align-items-center justify-content-center bg-light text-secondary">
                                <i class="bi bi-image fs-4"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $sofa->modelo }}</td>
                    <td>{{ $sofa->cor }}</td>
                    <td class="fw-bold text-success">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                    <td>{{ $sofa->fornecedor->nome ?? '-' }}</td>
                    <td class="text-center">
                        @if($sofa->fichaTecnica)
                            <span class="badge bg-success">{{ $sofa->fichaTecnica->tecido }}</span>
                        @else
                            <span class="badge bg-secondary">Sem ficha</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('sofas.edit', $sofa->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('sofas.destroy', $sofa->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja remover este sofá?')">
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
                    <td colspan="7" class="text-center py-4 text-muted">
                        Nenhum sofá encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($sofas) }}</strong> sofás
    </div>
</div>
@endsection