@extends('main')

@section('titulo', 'Dashboard - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-speedometer2 me-2"></i>Painel de Controle</h2>
        <small class="text-muted">Visão geral do sistema</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sofas.report') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Sofás
        </a>
        <a href="{{ route('vendas.report') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Vendas
        </a>
    </div>
</div>

{{-- Cards de totais --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #1a3a5c;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Clientes</small>
                        <h3 class="fw-bold mb-0">{{ $totalClientes }}</h3>
                    </div>
                    <i class="bi bi-people fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('clientes.index') }}" class="text-white-50 small">Ver todos &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #234b82;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Fornecedores</small>
                        <h3 class="fw-bold mb-0">{{ $totalFornecedores }}</h3>
                    </div>
                    <i class="bi bi-truck fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('fornecedores.index') }}" class="text-white-50 small">Ver todos &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #2b5d9b;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Sofás</small>
                        <h3 class="fw-bold mb-0">{{ $totalSofas }}</h3>
                    </div>
                    <i class="bi bi-box-seam fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('sofas.index') }}" class="text-white-50 small">Ver catálogo &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #166534;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Vendas</small>
                        <h3 class="fw-bold mb-0">{{ $totalVendas }}</h3>
                    </div>
                    <i class="bi bi-cart-check fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('vendas.index') }}" class="text-white-50 small">Ver todas &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #6d28d9;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Fichas Téc.</small>
                        <h3 class="fw-bold mb-0">{{ $totalFichas }}</h3>
                    </div>
                    <i class="bi bi-card-checklist fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('fichas.index') }}" class="text-white-50 small">Ver fichas &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Faturamento</small>
                        <h5 class="fw-bold mb-0 text-success">R$ {{ number_format($faturamentoTotal, 2, ',', '.') }}</h5>
                    </div>
                    <i class="bi bi-cash-coin fs-2 text-success"></i>
                </div>
                <small class="text-muted">Total em vendas</small>
            </div>
        </div>
    </div>
</div>

{{-- Gráficos com Chart.js --}}
<div class="row g-4 mb-4">
    {{-- Gráfico 1: Pizza - Sofás por Fornecedor --}}
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pie-chart-fill text-warning me-2"></i>Sofás por Fornecedor</h6>
            </div>
            <div class="card-body">
                <canvas id="graficoPizza" height="250"></canvas>
            </div>
        </div>
    </div>

    {{-- Gráfico 2: Barras - Vendas por Mês --}}
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Faturamento por Mês (R$)</h6>
            </div>
            <div class="card-body">
                <canvas id="graficoBarras" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Tabelas de últimos registros --}}
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-cart-check me-2"></i>Últimas Vendas</h6>
                <a href="{{ route('vendas.index') }}" class="small">Ver todas &rarr;</a>
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
                            <td><small>{{ date('d/m/Y', strtotime($venda->data_venda)) }}</small></td>
                            <td>{{ $venda->cliente->nome ?? '-' }}</td>
                            <td>{{ $venda->sofa->modelo ?? '-' }}</td>
                            <td>{{ $venda->quantidade }}</td>
                            <td class="text-end text-success fw-bold">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Nenhuma venda registrada.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Últimos Clientes</h6>
                <a href="{{ route('clientes.index') }}" class="small">Ver todos &rarr;</a>
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
                            <td>{{ $cliente->nome }}</td>
                            <td><small class="text-muted">{{ $cliente->telefone }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center text-muted py-3">Nenhum cliente cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Gráfico 1: Pizza - Sofás por Fornecedor
    const ctxPizza = document.getElementById('graficoPizza').getContext('2d');
    new Chart(ctxPizza, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labelsFornecedor) !!},
            datasets: [{
                data: {!! json_encode($dadosFornecedor) !!},
                backgroundColor: ['#1a3a5c','#234b82','#2b5d9b','#f39c12','#166534','#6d28d9','#dc2626'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Gráfico 2: Barras - Faturamento por Mês
    const ctxBarras = document.getElementById('graficoBarras').getContext('2d');
    new Chart(ctxBarras, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsVendas) !!},
            datasets: [{
                label: 'Faturamento (R$)',
                data: {!! json_encode($dadosVendas) !!},
                backgroundColor: '#234b82',
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endsection
