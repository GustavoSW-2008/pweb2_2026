@extends('main')

@section('titulo', 'Fornecedores - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-truck me-2"></i>Listagem de Fornecedores</h2>
        <small class="text-muted">Parceiros e fabricantes da loja</small>
    </div>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Novo Fornecedor
    </a>
</div>

{{-- Busca via GET ?search= --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('fornecedores.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar por nome..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('fornecedores.index') }}" class="btn btn-outline-secondary">
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
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>E-mail</th>
                    <th class="text-center">Sofás</th>
                    <th class="text-center" style="width: 150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fornecedores as $fornecedor)
                <tr>
                    <td>{{ $fornecedor->id }}</td>
                    <td class="fw-semibold">{{ $fornecedor->nome }}</td>
                    <td><code>{{ $fornecedor->cnpj }}</code></td>
                    <td>{{ $fornecedor->email }}</td>
                    <td class="text-center">
                        <span class="badge bg-primary">{{ $fornecedor->sofas->count() }}</span>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja remover o fornecedor {{ $fornecedor->nome }}?')">
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
                    <td colspan="6" class="text-center py-4 text-muted">
                        Nenhum fornecedor encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($fornecedores) }}</strong> fornecedores
    </div>
</div>
@endsection