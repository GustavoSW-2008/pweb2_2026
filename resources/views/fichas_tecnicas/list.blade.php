@extends('main')

@section('titulo', 'Fichas Técnicas - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-card-checklist me-2"></i>Fichas Técnicas</h2>
        <small class="text-muted">Especificações técnicas dos modelos de sofás</small>
    </div>
    <a href="{{ route('fichas-tecnicas.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Nova Ficha Técnica
    </a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('fichas-tecnicas.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por tecido ou modelo de sofá..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('fichas-tecnicas.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th>Sofá</th>
                    <th>Tecido</th>
                    <th class="text-center">Dimensões (A x L x P)</th>
                    <th class="text-center">Peso</th>
                    <th class="text-center" style="width: 160px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fichas as $ficha)
                <tr>
                    <td class="fw-semibold">
                        <i class="bi bi-box-seam me-1 text-primary"></i>
                        {{ $ficha->sofa->modelo ?? '-' }}
                    </td>
                    <td><span class="badge bg-secondary">{{ $ficha->tecido }}</span></td>
                    <td class="text-center">
                        {{ number_format($ficha->altura, 2, ',', '.') }}m &times;
                        {{ number_format($ficha->largura, 2, ',', '.') }}m &times;
                        {{ number_format($ficha->profundidade, 2, ',', '.') }}m
                    </td>
                    <td class="text-center">{{ number_format($ficha->peso, 2, ',', '.') }} kg</td>
                    <td class="text-center">
                        <a href="{{ route('fichas-tecnicas.edit', $ficha->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('fichas-tecnicas.destroy', $ficha->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja realmente remover esta ficha técnica?')">
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
                    <td colspan="5" class="text-center py-4 text-muted">
                        Nenhuma ficha técnica encontrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($fichas) }}</strong> fichas técnicas cadastradas
    </div>
</div>
@endsection
