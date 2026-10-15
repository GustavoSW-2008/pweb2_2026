@extends('main')

@section('titulo', 'Clientes - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-people me-2"></i> Listagem de Clientes</h2>
        <small class="text-muted">Gerenciamento completo dos clientes da loja</small>
    </div>
    <a href="{{ route('clientes.create') }}" class="btn btn-success shadow-sm">
        <i class="bi bi-person-plus-fill me-1"></i> Novo Cliente
    </a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form action="{{ route('clientes.search') }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-9">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="valor" class="form-control" placeholder="Pesquisar por nome, CPF, telefone ou endereço..." value="{{ $buscar ?? '' }}">
                </div>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search me-1"></i> Buscar
                </button>
                @if(!empty($buscar))
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
                    <th>Idade</th>
                    <th>Endereço</th>
                    <th class="text-center" style="width: 170px;">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cliente)
                <tr>
                    <td>
                        @if($cliente->imagem)
                            <img src="{{ asset('storage/' . $cliente->imagem) }}" alt="{{ $cliente->nome }}" class="avatar-thumbnail">
                        @else
                            <div class="avatar-thumbnail d-flex align-items-center justify-content-center bg-light text-secondary">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-semibold">{{ $cliente->nome }}</td>
                    <td><code>{{ $cliente->cpf }}</code></td>
                    <td>{{ $cliente->telefone }}</td>
                    <td>{{ $cliente->idade ? $cliente->idade . ' anos' : '-' }}</td>
                    <td><small class="text-muted">{{ $cliente->endereco ?? '-' }}</small></td>
                    <td class="text-center">
                        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning" title="Editar">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Deseja realmente remover o(a) cliente {{ $cliente->nome }}?')">
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
                        Nenhum cliente encontrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white text-muted small py-2">
        Total de clientes cadastrados: <strong>{{ count($clientes) }}</strong>
    </div>
</div>
@endsection