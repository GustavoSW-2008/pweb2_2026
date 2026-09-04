@extends('main')
@section('content')
<h2>{{ isset($sofa) ? 'Editar Sofá' : 'Novo Sofá' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($sofa) ? route('sofas.update', $sofa->id) : route('sofas.store') }}" method="POST">
    @csrf
    @if(isset($sofa)) @method('PUT') @endif
    
    <div class="mb-3">
        <label>Modelo</label>
        <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $sofa->modelo ?? '') }}">
    </div>
    
    <div class="mb-3">
        <label>Cor</label>
        <input type="text" name="cor" class="form-control" value="{{ old('cor', $sofa->cor ?? '') }}">
    </div>
    
    <div class="mb-3">
        <label>Preço</label>
        <input type="number" step="0.01" name="preco" class="form-control" value="{{ old('preco', $sofa->preco ?? '') }}">
    </div>

    <div class="mb-3">
        <label>Fornecedor</label>
        <select name="fornecedor_id" class="form-control">
            <option value="">Selecione...</option>
            @foreach($fornecedores as $fornecedor)
                <option value="{{ $fornecedor->id }}" {{ (old('fornecedor_id', $sofa->fornecedor_id ?? '')) == $fornecedor->id ? 'selected' : '' }}>
                    {{ $fornecedor->nome }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
</form>
@endsection