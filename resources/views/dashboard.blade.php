@extends('main')

@section('titulo', 'Dashboard - Pausa Sofás')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="fw-bold mb-0 text-dark"><i class="bi bi-speedometer2 me-2"></i> Painel de Controle</h2>
        <small class="text-muted">Visão geral do sistema de gerenciamento de sofás e vendas</small>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('sofas.report') }}" class="btn btn-outline-danger btn-sm shadow-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Sofás
        </a>
        <a href="{{ route('vendas.report') }}" class="btn btn-outline-danger btn-sm shadow-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Vendas
        </a>
        <a href="{{ route('vendas.create') }}" class="btn btn-success btn-sm shadow-sm">
            <i class="bi bi-cart-plus me-1"></i> Nova Venda
        </a>
    </div>
</div>

<!-- Cards de Estatísticas dos 5 CRUDs -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100 shadow-sm" style="background-color: #1a3a5c;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white-50 small text-uppercase">Clientes</span>
                        <h3 class="fw-bold mb-0 mt-1">{{ $totalClientes }}</h3>
                    </div>
                    <i class="bi bi-people fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('clientes.index') }}" class="text-white-50 text-decoration-none small d-block mt-2">Ver todos &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100 shadow-sm" style="background-color: #1e3d6f;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white-50 small text-uppercase">Fornecedores</span>
                        <h3 class="fw-bold mb-0 mt-1">{{ $totalFornecedores }}</h3>
                    </div>
                    <i class="bi bi-truck fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('fornecedores.index') }}" class="text-white-50 text-decoration-none small d-block mt-2">Ver todos &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100 shadow-sm" style="background-color: #234b82;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white-50 small text-uppercase">Sofás</span>
                        <h3 class="fw-bold mb-0 mt-1">{{ $totalSofas }}</h3>
                    </div>
                    <i class="bi bi-box-seam fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('sofas.index') }}" class="text-white-50 text-decoration-none small d-block mt-2">Ver catálogo &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100 shadow-sm" style="background-color: #2b5d9b;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white-50 small text-uppercase">Vendas</span>
                        <h3 class="fw-bold mb-0 mt-1">{{ $totalVendas }}</h3>
                    </div>
                    <i class="bi bi-cart-check fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('vendas.index') }}" class="text-white-50 text-decoration-none small d-block mt-2">Ver histórico &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100 shadow-sm" style="background-color: #166534;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-white-50 small text-uppercase">Fichas </span>
                        <h3 class="fw-bold mb-0 mt-1">{{ $totalFichas }}</h3>
                    </div>
                    <i class="bi bi-card-checklist fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('fichas.index') }}" class="text-white-50 text-decoration-none small d-block mt-2">Ver fichas &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-dark h-100 shadow-sm" style="background-color: #e2e8f0;">
            <div class="card-body p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small text-uppercase">Faturamento</span>
                        <h5 class="fw-bold mb-0 mt-1 text-success">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h5>
                    </div>
                    <i class="bi bi-cash-coin fs-2 text-success"></i>
                </div>
                <span class="text-muted small d-block mt-2">Total de vendas</span>
            </div>
        </div>
    </div>
</div>

<!-- Seção de Gráficos Integrados (Critério 09) -->
<div class="row g-4 mb-4">
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0 text-dark">
<<<<<<< HEAD
                    <i class="bi bi-pie-chart-fill text-warning me-2"></i>  Sofás por Fornecedor
=======
                    <i class="bi bi-pie-chart-fill text-warning me-2"></i> Sofás por Fornecedor
>>>>>>> 9628c1dd57e776de2ea6bb8507240778c996e2cf
                </h6>
                <a href="{{ route('graficos.sofas') }}" class="btn btn-sm btn-outline-secondary">Tela cheia</a>
            </div>
            <div class="card-body p-3">
                {!! $chartSofas->container() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                <h6 class="fw-bold mb-0 text-dark">
<<<<<<< HEAD
                    <i class="bi bi-bar-chart-fill text-primary me-2"></i>  Faturamento por Sofá
=======
                    <i class="bi bi-bar-chart-fill text-primary me-2"></i> Faturamento por Sofá
>>>>>>> 9628c1dd57e776de2ea6bb8507240778c996e2cf
                </h6>
                <a href="{{ route('graficos.vendas') }}" class="btn btn-sm btn-outline-secondary">Tela cheia</a>
            </div>
            <div class="card-body p-3">
                {!! $chartVendas->container() !!}
            </div>
        </div>
    </div>
</div>

<!-- Tabelas Resumo: Últimas Vendas e Últimos Sofás -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-cart-check me-2"></i> Últimas Vendas Realizadas</h6>
                <a href="{{ route('vendas.index') }}" class="small text-decoration-none">Ver todas &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Data</th>
                            <th>Cliente</th>
                            <th>Sofá</th>
                            <th>Qtd</th>
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasVendas as $venda)
                        <tr>
                            <td><small class="text-muted">{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</small></td>
                            <td class="fw-semibold">{{ $venda->cliente->nome ?? '-' }}</td>
                            <td>{{ $venda->sofa->modelo ?? '-' }}</td>
                            <td><span class="badge bg-secondary">{{ $venda->quantidade }}</span></td>
                            <td class="text-end fw-bold text-success">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 text-muted">Nenhuma venda registrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-people me-2"></i> Últimos Clientes</h6>
                <a href="{{ route('clientes.index') }}" class="small text-decoration-none">Ver todos &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosClientes as $cliente)
                        <tr>
                            <td class="fw-semibold">
                                <i class="bi bi-person me-1 text-muted"></i>{{ $cliente->nome }}
                            </td>
                            <td><small class="text-muted">{{ $cliente->telefone }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center py-3 text-muted">Nenhum cliente cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr class="my-4">

<!-- Catálogo Visual de Sofás -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="bi bi-grid me-2"></i> Mostruário e Catálogo de Sofás</h4>
        <small class="text-muted">Exibição dos modelos com especificações e foto</small>
    </div>
    <a href="{{ route('sofas.create') }}" class="btn btn-outline-success btn-sm">
        <i class="bi bi-plus"></i> Adicionar ao Catálogo
    </a>
</div>

<div class="row g-4">
    @forelse($sofas as $sofa)
    <div class="col-md-6 col-lg-4">
        <div class="card h-100 shadow-sm border-0">
            @php
                if (!empty($sofa->imagem)) {
                    $caminhoImagem = asset('storage/' . $sofa->imagem);
                } else {
                    $imagens = ['sofa_1.jpg', 'sofa_2.jpg', 'sofa_3.jpg', 'sofa_4.jpg', 'sofa_5.jpg'];
                    $caminhoImagem = asset('img/sofas/' . $imagens[$sofa->id % count($imagens)]);
                }
            @endphp
            <img src="{{ $caminhoImagem }}" class="card-img-top" alt="{{ $sofa->modelo }}" style="height: 200px; object-fit: cover;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h5 class="card-title fw-bold text-dark mb-0">{{ $sofa->modelo }}</h5>
                </div>
                <p class="card-text small text-muted mb-2">
                    <strong>Cor:</strong> {{ $sofa->cor }}<br>
                    <strong>Fornecedor (1:N):</strong> {{ $sofa->fornecedor->nome ?? '-' }}<br>
                    <strong>Ficha Técnica (1:1):</strong>
                    @if($sofa->fichaTecnica)
                        <span class="badge bg-info text-dark">{{ $sofa->fichaTecnica->tecido }} ({{ $sofa->fichaTecnica->garantia_meses }}m)</span>
                    @else
                        <span class="badge bg-light text-muted border">Pendente</span>
                    @endif
                </p>
                <div class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">
                    <span class="fs-5 fw-bold text-success">
                        R$ {{ number_format($sofa->preco, 2, ',', '.') }}
                    </span>
                    <a href="{{ route('sofas.edit', $sofa->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-pencil"></i> Detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-4 text-muted">
        Nenhum sofá cadastrado no catálogo.
    </div>
    @endforelse
</div>
@endsection

@section('scripts')
    <script src="{{ $chartSofas->cdn() }}"></script>
    {{ $chartSofas->script() }}
    {{ $chartVendas->script() }}
@endsection
