@extends('main')

@section('titulo', 'Fichas Técnicas - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-card-checklist me-2"></i> Fichas Técnicas (1:1)</h2>
        <small class="text-muted">Especificações técnicas dos sofás (Tecidos, Espumas, Pesos e Dimensões)</small>
    </div>
    <a href="{{ route('fichas.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Nova Ficha Técnica
    </a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('fichas.search') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar por modelo do sofá, tecido, dimensões ou espuma..." value="{{ $buscar ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($buscar))
                    <a href="{{ route('fichas.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th style="width: 50px;">#</th>
                    <th>Sofá Associado (1:1)</th>
                    <th>Tecido</th>
                    <th>Peso (kg)</th>
                    <th>Dimensões (L x P x A)</th>
                    <th>Garantia</th>
                    <th>Espuma / Estrutura</th>
                    <th class="text-center" style="width: 170px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fichas as $ficha)
                <tr>
                    <td>{{ $ficha->id }}</td>
                    <td class="fw-semibold">
                        <i class="bi bi-box me-1 text-primary"></i>
                        {{ $ficha->sofa->modelo ?? 'Sofá não vinculado' }}
                    </td>
                    <td><span class="badge bg-secondary">{{ $ficha->tecido }}</span></td>
                    <td>{{ number_format($ficha->peso, 2, ',', '.') }} kg</td>
                    <td><code>{{ $ficha->dimensoes }}</code></td>
                    <td>{{ $ficha->garantia_meses }} meses</td>
                    <td><small class="text-muted">{{ $ficha->densidade_espuma ?? '-' }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('fichas.edit', $ficha->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('fichas.destroy', $ficha->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Deseja realmente remover esta ficha técnica?')">
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
                    <td colspan="8" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                        Nenhuma ficha técnica cadastrada.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-muted small py-2">
        Total de fichas técnicas cadastradas: <strong>{{ count($fichas) }}</strong>
    </div>
</div>
@endsection
