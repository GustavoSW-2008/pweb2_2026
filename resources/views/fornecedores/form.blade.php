@extends('main')

@section('content')
<h2>{{ isset($fornecedor) ? 'Editar Fornecedor' : 'Novo Fornecedor' }}</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ isset($fornecedor) ? route('fornecedores.update', $fornecedor->id) : route('fornecedores.store') }}" method="POST" class="mt-3">
    @csrf
    @if(isset($fornecedor))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Nome</label>
        <input type="text" name="nome" class="form-control" value="{{ old('nome', $fornecedor->nome ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">CNPJ</label>
        <input type="text" name="cnpj" class="form-control" value="{{ old('cnpj', $fornecedor->cnpj ?? '') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">E-mail</label>
        <input type="text" name="email" class="form-control" value="{{ old('email', $fornecedor->email ?? '') }}">
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection