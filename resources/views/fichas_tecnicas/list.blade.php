@extends('main')

@section('titulo', 'Fichas Técnicas - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-card-checklist me-2"></i>Fichas Técnicas</h2>
        <small class="text-muted">Especificações técnicas dos sofás (relação 1:1)</small>
    </div>
    <a href="{{ route('fichas.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Nova Ficha Técnica
    </a>
</div>

{{-- Busca via GET ?search= --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('fichas.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por tecido..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary">
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
                    <th>#</th>
                    <th>Sofá (1:1)</th>
                    <th>Tecido</th>
                    <th>Peso (kg)</th>
                    <th>Dimensões</th>
                    <th>Garantia</th>
                    <th>Espuma</th>
                    <th class="text-center" style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fichas as $ficha)
                <tr>
                    <td>{{ $ficha->id }}</td>
                    <td class="fw-semibold">{{ $ficha->sofa->modelo ?? '-' }}</td>
                    <td>{{ $ficha->tecido }}</td>
                    <td>{{ number_format($ficha->peso, 2, ',', '.') }} kg</td>
                    <td>{{ $ficha->dimensoes }}</td>
                    <td>{{ $ficha->garantia_meses }} meses</td>
                    <td><small class="text-muted">{{ $ficha->densidade_espuma ?? '-' }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('fichas.edit', $ficha->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('fichas.destroy', $ficha->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja remover esta ficha técnica?')">
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
                    <td colspan="8" class="text-center py-4 text-muted">
                        Nenhuma ficha técnica cadastrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($fichas) }}</strong> fichas técnicas
    </div>
</div>
@endsection
