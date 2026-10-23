@extends('main')

@section('titulo', 'Clientes - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-people me-2"></i>Listagem de Clientes</h2>
        <small class="text-muted">Gerenciamento dos clientes da loja</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('clientes.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus me-1"></i> Novo Cliente
        </a>
    </div>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('clientes.index') }}" method="GET" class="row g-2">
            <div class="col-md-9">
                <input type="text" name="search" class="form-control"
                    placeholder="Pesquisar cliente por nome..."
                    value="{{ $search ?? '' }}">
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($search))
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary" title="Limpar busca">
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
                    <th style="width: 70px;">Foto</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Nascimento</th>
                    <th class="text-center" style="width: 160px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    <td>
                        @if($cliente->imagem)
                            <img src="{{ asset('storage/' . $cliente->imagem) }}"
                                 alt="{{ $cliente->nome }}"
                                 class="avatar-thumbnail">
                        @else
                            <div class="avatar-thumbnail d-flex align-items-center justify-content-center bg-light text-secondary">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $cliente->nome }}</td>
                    <td><code>{{ $cliente->cpf }}</code></td>
                    <td>{{ $cliente->telefone }}</td>
                    <td><small>{{ $cliente->email }}</small></td>
                    <td><small>{{ date('d/m/Y', strtotime($cliente->data_nascimento)) }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('Deseja realmente remover o cliente {{ $cliente->nome }}?')">
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
                        Nenhum cliente cadastrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer text-muted small">
        Total: <strong>{{ count($clientes) }}</strong> clientes cadastrados
    </div>
</div>
@endsection
