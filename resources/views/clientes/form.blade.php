@extends('main')

@section('content')
<h2>{{ isset($cliente) ? 'Editar Cliente' : 'Novo Cliente' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST" class="mt-3">
    @csrf
    @if(isset($cliente))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $cliente->nome ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">CPF</label>
        <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $cliente->cpf ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Telefone</label>
        <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $cliente->telefone ?? '') }}">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection