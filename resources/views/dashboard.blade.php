@extends('main')

@section('titulo', 'Dashboard - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-speedometer2 me-2"></i>Painel de Controle</h2>
        <small class="text-muted">Visão geral da Loja de Sofás</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('sofas.report') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Sofás
        </a>
        <a href="{{ route('clientes.report') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Clientes
        </a>
    </div>
</div>

{{-- Cards com contadores dos 5 CRUDs --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #1a3a5c;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Categorias</small>
                        <h3 class="fw-bold mb-0">{{ $totalCategorias }}</h3>
                    </div>
                    <i class="bi bi-tags fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('categorias.index') }}" class="text-white-50 small">Ver todas &rarr;</a>
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
        <div class="card text-white h-100" style="background-color: #166534;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Endereços</small>
                        <h3 class="fw-bold mb-0">{{ $totalEnderecos }}</h3>
                    </div>
                    <i class="bi bi-geo-alt fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('enderecos.index') }}" class="text-white-50 small">Ver todos &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #7c3aed;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Modelos Sofás</small>
                        <h3 class="fw-bold mb-0">{{ $totalSofas }}</h3>
                    </div>
                    <i class="bi bi-box-seam fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('sofas.index') }}" class="text-white-50 small">Ver catálogo &rarr;</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-2">
        <div class="card h-100 bg-white border">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Estoque</small>
                        <h3 class="fw-bold mb-0 text-success">{{ $totalEstoque }} <span class="fs-6 text-muted">un</span></h3>
                    </div>
                    <i class="bi bi-layers fs-2 text-success"></i>
                </div>
                <small class="text-muted">Unidades disponíveis</small>
            </div>
        </div>
    </div>
</div>

{{-- 2 Gráficos de tipos diferentes com Chart.js --}}
<div class="row g-4 mb-4">
    {{-- Gráfico 1: Pizza - Sofás por Categoria --}}
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-pie-chart-fill text-warning me-2"></i>Distribuição de Sofás por Categoria (Gráfico em Pizza)</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <div style="width: 100%; max-width: 380px;">
                    <canvas id="graficoPizza"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Gráfico 2: Barras - Sofás por Fornecedor --}}
    <div class="col-lg-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="bi bi-bar-chart-fill text-primary me-2"></i>Sofás por Fornecedor (Gráfico em Barras)</h6>
            </div>
            <div class="card-body">
                <canvas id="graficoBarras" height="220"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Tabelas Resumo --}}
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-box-seam me-2"></i>Últimos Sofás Cadastrados</h6>
                <a href="{{ route('sofas.index') }}" class="small">Ver todos &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Modelo</th>
                            <th>Categoria</th>
                            <th>Fornecedor</th>
                            <th>Preço</th>
                            <th class="text-center">Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosSofas as $sofa)
                        <tr>
                            <td class="fw-semibold">{{ $sofa->modelo }}</td>
                            <td><span class="badge bg-secondary">{{ $sofa->categoria->nome ?? '-' }}</span></td>
                            <td><small class="text-muted">{{ $sofa->fornecedor->nome_fantasia ?? '-' }}</small></td>
                            <td class="text-success fw-bold">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                            <td class="text-center"><span class="badge bg-primary">{{ $sofa->quantidade_estoque }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Nenhum sofá cadastrado.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><i class="bi bi-people me-2"></i>Últimos Clientes</h6>
                <a href="{{ route('clientes.index') }}" class="small">Ver todos &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Cidade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosClientes as $cli)
                        <tr>
                            <td class="fw-semibold">{{ $cli->nome }}</td>
                            <td><small class="text-muted">{{ $cli->telefone }}</small></td>
                            <td><small>{{ $cli->endereco->cidade ?? 'Sem endereço' }}</small></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Nenhum cliente cadastrado.</td>
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
    // Gráfico 1: Pizza - Sofás por Categoria
    const ctxPizza = document.getElementById('graficoPizza').getContext('2d');
    new Chart(ctxPizza, {
        type: 'pie',
        data: {
            labels: {!! json_encode($labelsCategorias) !!},
            datasets: [{
                data: {!! json_encode($dadosCategorias) !!},
                backgroundColor: ['#1a3a5c', '#234b82', '#2b5d9b', '#f39c12', '#166534', '#7c3aed', '#dc2626'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' }
            }
        }
    });

    // Gráfico 2: Barras - Sofás por Fornecedor
    const ctxBarras = document.getElementById('graficoBarras').getContext('2d');
    new Chart(ctxBarras, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labelsFornecedores) !!},
            datasets: [{
                label: 'Quantidade de Modelos',
                data: {!! json_encode($dadosFornecedores) !!},
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
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
