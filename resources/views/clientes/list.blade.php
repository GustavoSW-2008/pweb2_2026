@extends('main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-success">Novo Cliente</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('clientes.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por nome, CPF, telefone ou endereço..." value="{{ $buscar ?? '' }}">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Telefone</th>
            <th>Idade</th>
            <th>Endereço</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($clientes as $cliente)
        <tr>
            <td>{{ $cliente->nome }}</td>
            <td>{{ $cliente->cpf }}</td>
            <td>{{ $cliente->telefone }}</td>
            <td>{{ $cliente->idade ?? '-' }}</td>
            <td>{{ $cliente->endereco ?? '-' }}</td>
            <td>
                <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir este cliente?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Nenhum cliente encontrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection