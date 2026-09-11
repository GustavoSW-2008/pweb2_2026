@extends('main')

@section('content')
<h2>Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white mb-3" style="background-color: #1a3a5c;">
            <div class="card-body">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text" style="font-size: 2rem;">{{ $totalClientes }}</p>
                <a href="{{ route('clientes.index') }}" class="text-white">Ver todos →</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white mb-3" style="background-color: #1e3d6f;">
            <div class="card-body">
                <h5 class="card-title">Fornecedores</h5>
                <p class="card-text" style="font-size: 2rem;">{{ $totalFornecedores }}</p>
                <a href="{{ route('fornecedores.index') }}" class="text-white">Ver todos →</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white mb-3" style="background-color: #234b82;">
            <div class="card-body">
                <h5 class="card-title">Sofás</h5>
                <p class="card-text" style="font-size: 2rem;">{{ $totalSofas }}</p>
                <a href="{{ route('sofas.index') }}" class="text-white">Ver todos →</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Últimos Clientes Cadastrados</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosClientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nome }}</td>
                            <td>{{ $cliente->cpf }}</td>
                            <td>{{ $cliente->telefone }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhum cliente cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-dark text-white">Últimos Sofás Cadastrados</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Modelo</th>
                            <th>Cor</th>
                            <th>Preço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosSofas as $sofa)
                        <tr>
                            <td>{{ $sofa->modelo }}</td>
                            <td>{{ $sofa->cor }}</td>
                            <td>R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhum sofá cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr>

<h3 class="mb-3">Nossos Sofás</h3>
<div class="row">
    @php
        $imagens = ['sofa_1.jpg', 'sofa_2.jpg', 'sofa_3.jpg', 'sofa_4.jpg', 'sofa_5.jpg'];
    @endphp

    @forelse($sofas as $sofa)
    <div class="col-md-4 mb-4">
        <div class="card">
            <img src="{{ asset('img/sofas/' . $imagens[$sofa->id % count($imagens)]) }}" class="card-img-top" alt="{{ $sofa->modelo }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">{{ $sofa->modelo }}</h5>
                <p class="card-text">
                    <strong>Cor:</strong> {{ $sofa->cor }}<br>
                    <strong>Preço:</strong> R$ {{ number_format($sofa->preco, 2, ',', '.') }}<br>
                    <strong>Fornecedor:</strong> {{ $sofa->fornecedor->nome ?? '-' }}
                </p>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <p class="text-center">Nenhum sofá cadastrado ainda.</p>
    </div>
    @endforelse
</div>
@endsection
