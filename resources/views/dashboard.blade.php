@extends('main')

@section('titulo', 'Dashboard - Pausa Sofás')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0"><i class="bi bi-speedometer2 me-2"></i>Painel de Controle</h2>
        <small class="text-muted">Visão geral da Loja de Sofás</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('relatorios.sofas') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Sofás
        </a>
        <a href="{{ route('relatorios.vendas') }}" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-file-earmark-pdf me-1"></i> PDF Vendas
        </a>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-2">
        <div class="card text-white h-100" style="background-color: #1a3a5c;">
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
        <div class="card text-white h-100" style="background-color: #234b82;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Fichas Técnicas</small>
                        <h3 class="fw-bold mb-0">{{ $totalFichas }}</h3>
                    </div>
                    <i class="bi bi-card-checklist fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('fichas-tecnicas.index') }}" class="text-white-50 small">Ver todas &rarr;</a>
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
        <div class="card text-white h-100" style="background-color: #7c3aed;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Vendas</small>
                        <h3 class="fw-bold mb-0">{{ $totalVendas }}</h3>
                    </div>
                    <i class="bi bi-cart-check fs-2 text-white-50"></i>
                </div>
                <a href="{{ route('vendas.index') }}" class="text-white-50 small">Ver vendas &rarr;</a>
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

<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="card shadow-sm h-100">
            <div class="card-body p-3">
                {!! $chartVendas->container() !!}
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow-sm h-100">
            <div class="card-body p-3">
                {!! $chartSofas->container() !!}
            </div>
        </div>
    </div>
</div>

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
                            <th>Tecido</th>
                            <th>Fornecedor</th>
                            <th>Preço</th>
                            <th class="text-center">Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosSofas as $sofa)
                        <tr>
                            <td class="fw-semibold">{{ $sofa->modelo }}</td>
                            <td><span class="badge bg-secondary">{{ $sofa->fichaTecnica->tecido ?? '-' }}</span></td>
                            <td><small class="text-muted">{{ $sofa->fornecedor->empresa ?? '-' }}</small></td>
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
                <h6 class="mb-0 fw-bold"><i class="bi bi-cart-check me-2"></i>Últimas Vendas</h6>
                <a href="{{ route('vendas.index') }}" class="small">Ver todas &rarr;</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Data</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasVendas as $venda)
                        <tr>
                            <td class="fw-semibold">{{ $venda->cliente->nome ?? '-' }}</td>
                            <td><small class="text-muted">{{ date('d/m/Y', strtotime($venda->data_venda)) }}</small></td>
                            <td class="text-success fw-bold">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-3">Nenhuma venda registrada.</td>
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
<script src="{{ $chartVendas->cdn() }}"></script>
{{ $chartVendas->script() }}
{{ $chartSofas->script() }}
@endsection
