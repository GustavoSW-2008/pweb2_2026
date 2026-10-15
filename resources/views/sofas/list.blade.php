@extends('main')

@section('titulo', 'Sofás - Pausa Sofás')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-box-seam me-2"></i> Catálogo de Sofás</h2>
        <small class="text-muted">Gerenciamento dos sofás comercializados e fichas técnicas</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sofas.report') }}" class="btn btn-danger shadow-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> Relatório em PDF
        </a>
        <a href="{{ route('sofas.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Novo Sofá
        </a>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('sofas.search') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar por modelo, cor ou fornecedor..." value="{{ $buscar ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($buscar))
                    <a href="{{ route('sofas.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th>Preço Unitário</th>
                    <th>Fornecedor</th>
                    <th class="text-center">Ficha Técnica (1:1)</th>
                    <th class="text-center" style="width: 170px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($sofas as $sofa)
                <tr>
                    <td>
                        @if($sofa->imagem)
                            <img src="{{ asset('storage/' . $sofa->imagem) }}" alt="{{ $sofa->modelo }}" class="product-thumbnail">
                        @else
                            <div class="product-thumbnail d-flex align-items-center justify-content-center bg-light text-secondary">
                                <i class="bi bi-image fs-4"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $sofa->modelo }}</td>
                    <td><span class="badge bg-secondary">{{ $sofa->cor }}</span></td>
                    <td class="fw-bold text-success">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                    <td>{{ $sofa->fornecedor->nome ?? '-' }}</td>
                    <td class="text-center">
                        @if($sofa->fichaTecnica)
                            <a href="{{ route('fichas.edit', $sofa->fichaTecnica->id) }}" class="badge bg-info text-dark text-decoration-none py-2 px-3" title="Ver/Editar Ficha">
                                <i class="bi bi-check-circle me-1"></i> {{ $sofa->fichaTecnica->tecido }}
                            </a>
                        @else
                            <a href="{{ route('fichas.create') }}" class="badge bg-light text-muted border text-decoration-none py-2 px-3" title="Cadastrar Ficha Técnica">
                                <i class="bi bi-plus"></i> Sem Ficha
                            </a>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('sofas.edit', $sofa->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('sofas.destroy', $sofa->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Deseja realmente remover o sofá {{ $sofa->modelo }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                        Nenhum sofá encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-muted small py-2 d-flex justify-content-between align-items-center">
        <span>Total de modelos cadastrados: <strong>{{ count($sofas) }}</strong></span>
        <a href="{{ route('sofas.report') }}" class="text-danger text-decoration-none">
            <i class="bi bi-file-earmark-pdf me-1"></i> Baixar Relatório em PDF
        </a>
    </div>
</div>
@endsection