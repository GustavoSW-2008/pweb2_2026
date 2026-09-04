@extends('main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Fornecedores</h2>
    <a href="{{ route('fornecedores.create') }}" class="btn btn-success">Novo Fornecedor</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('fornecedores.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por nome, CNPJ ou e-mail..." value="{{ $buscar ?? '' }}">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fornecedores as $fornecedor)
        <tr>
            <td>{{ $fornecedor->nome }}</td>
            <td>{{ $fornecedor->cnpj }}</td>
            <td>{{ $fornecedor->email }}</td>
            <td>
                <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir este fornecedor?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Nenhum fornecedor encontrado.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection