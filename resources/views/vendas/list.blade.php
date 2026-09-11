@extends('main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Vendas</h2>
    <a href="{{ route('vendas.create') }}" class="btn btn-success">Nova Venda</a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('vendas.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar por nome do cliente ou modelo do sofá..." value="{{ $buscar ?? '' }}">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Sofá (Modelo)</th>
            <th>Data da Venda</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($vendas as $venda)
        <tr>
            <td>{{ $venda->id }}</td>
            <td>{{ $venda->cliente->nome ?? 'Cliente não encontrado' }}</td>
            <td>{{ $venda->sofa->modelo ?? 'Sofá não encontrado' }}</td>
            <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir esta venda?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Nenhuma venda encontrada.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
