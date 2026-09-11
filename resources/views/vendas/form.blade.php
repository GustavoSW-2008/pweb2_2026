@extends('main')

@section('content')
<h2>{{ isset($venda) ? 'Editar Venda' : 'Nova Venda' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($venda) ? route('vendas.update', $venda->id) : route('vendas.store') }}" method="POST" class="mt-3">
    @csrf
    @if(isset($venda))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Cliente</label>
        <select name="cliente_id" class="form-control">
            <option value="">Selecione um cliente...</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ (old('cliente_id', $venda->cliente_id ?? '')) == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Sofá</label>
        <select name="sofa_id" class="form-control">
            <option value="">Selecione um sofá...</option>
            @foreach($sofas as $sofa)
                <option value="{{ $sofa->id }}" {{ (old('sofa_id', $venda->sofa_id ?? '')) == $sofa->id ? 'selected' : '' }}>
                    {{ $sofa->modelo }} (R$ {{ number_format($sofa->preco, 2, ',', '.') }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Data da Venda</label>
        <input type="date" name="data_venda" class="form-control" value="{{ old('data_venda', isset($venda) ? \Carbon\Carbon::parse($venda->data_venda)->format('Y-m-d') : date('Y-m-d')) }}">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('vendas.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
