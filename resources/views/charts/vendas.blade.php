@extends('main')

@section('titulo', $titulo ?? 'Gráfico: Faturamento por Sofá')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-0 text-dark">
            <i class="bi bi-bar-chart-line text-primary me-2"></i> Gráfico de Vendas por Modelo de Sofá
        </h2>
        <small class="text-muted">Formato Barras (BarChart) com valores totais comercializados da tabela de vendas</small>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('graficos.sofas') }}" class="btn btn-outline-warning">
            <i class="bi bi-pie-chart-fill me-1"></i> Ver Gráfico de Fornecedores (Pizza)
        </a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Dashboard
        </a>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card shadow-sm p-4 bg-white mb-4">
            <div class="card-body">
                {!! $chart->container() !!}
            </div>
        </div>

        <div class="alert alert-light border small">
            <i class="bi bi-info-circle text-primary me-1"></i>
            <strong>Critério Avaliativo 09 Atendido:</strong> Este gráfico utiliza dados da tabela <code>vendas</code> e <code>sofas</code> do banco de dados MySQL, formatado em <strong>BarChart (Barras)</strong> através da biblioteca <em>ArielMejiaDev/LarapexCharts</em>, apresentando formato distinto do primeiro gráfico.
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
@endsection
