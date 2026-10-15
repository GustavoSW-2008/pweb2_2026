@extends('main')

@section('titulo', 'Fornecedores - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-truck me-2"></i> Listagem de Fornecedores</h2>
        <small class="text-muted">Parceiros e fabricantes parceiros da Pausa Sofás</small>
    </div>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-plus-circle-fill me-1"></i> Novo Fornecedor
    </a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('fornecedores.search') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar por razão social, CNPJ ou e-mail..." value="{{ $buscar ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($buscar))
                    <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th style="width: 60px;">#</th>
                    <th>Razão Social / Nome</th>
                    <th>CNPJ</th>
                    <th>E-mail</th>
                    <th class="text-center">Sofás Vinculados</th>
                    <th class="text-center" style="width: 170px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fornecedores as $fornecedor)
                <tr>
                    <td>{{ $fornecedor->id }}</td>
                    <td class="fw-semibold">{{ $fornecedor->nome }}</td>
                    <td><code>{{ $fornecedor->cnpj }}</code></td>
                    <td><a href="mailto:{{ $fornecedor->email }}" class="text-decoration-none">{{ $fornecedor->email }}</a></td>
                    <td class="text-center">
                        <span class="badge bg-primary fs-6">{{ $fornecedor->sofas_count }}</span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Deseja realmente remover o fornecedor {{ $fornecedor->nome }}?')">
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
                    <td colspan="6" class="text-center py-4 text-muted">
                        <i class="bi bi-inbox fs-3 d-block mb-1"></i>
                        Nenhum fornecedor encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-muted small py-2">
        Total de fornecedores: <strong>{{ count($fornecedores) }}</strong>
    </div>
</div>
@endsection