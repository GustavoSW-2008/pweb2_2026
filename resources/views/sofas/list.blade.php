@extends('main')
@section('content')
<h2>Lista de Sofás</h2>
<form action="{{ route('sofas.index') }}" method="GET" class="mb-3 d-flex">
    <input type="text" name="buscar" class="form-control me-2" placeholder="Buscar modelo, cor ou fornecedor..." value="{{ $buscar ?? '' }}">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<a href="{{ route('sofas.create') }}" class="btn btn-success mb-3">Novo Sofá</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Modelo</th>
            <th>Cor</th>
            <th>Preço</th>
            <th>Fornecedor</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sofas as $sofa)
        <tr>
            <td>{{ $sofa->modelo }}</td>
            <td>{{ $sofa->cor }}</td>
            <td>R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
            <td>{{ $sofa->fornecedor->nome }}</td>
            <td>
                <a href="{{ route('sofas.edit', $sofa->id) }}" class="btn btn-sm btn-warning">Editar</a>
                <form action="{{ route('sofas.destroy', $sofa->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection