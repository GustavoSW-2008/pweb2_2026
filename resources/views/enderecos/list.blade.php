@extends('main')

@section('titulo', 'Endereços - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-geo-alt me-2"></i>Listagem de Endereços</h2>
        <small class="text-muted">Endereços de entrega dos clientes (Relacionamento 1:1)</small>
    </div>
    <a href="{{ route('enderecos.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Novo Endereço
    </a>
</div>

{{-- Busca via GET ?search= --}}
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('enderecos.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por rua, bairro ou cidade..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('enderecos.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th>Cliente (1:1)</th>
                    <th>Logradouro / Rua</th>
                    <th>Número</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>CEP</th>
                    <th class="text-center" style="width: 160px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enderecos as $endereco)
                <tr>
                    <td class="fw-semibold text-primary">
                        <i class="bi bi-person me-1"></i> {{ $endereco->cliente->nome ?? '-' }}
                    </td>
                    <td>{{ $endereco->rua }}</td>
                    <td>{{ $endereco->numero }}</td>
                    <td>{{ $endereco->bairro }}</td>
                    <td>{{ $endereco->cidade }}</td>
                    <td><code>{{ $endereco->cep }}</code></td>
                    <td class="text-center">
                        <a href="{{ route('enderecos.edit', $endereco->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('enderecos.destroy', $endereco->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja realmente remover o endereço de {{ $endereco->cliente->nome ?? 'Cliente' }}?')">
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
                        Nenhum endereço encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($enderecos) }}</strong> endereços cadastrados
    </div>
</div>
@endsection
