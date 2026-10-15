<?php

namespace App\Http\Controllers;

use App\Charts\SofasPorFornecedorChart;
use App\Charts\VendasPorSofaChart;

class GraficoController extends Controller
{
    public function sofasPorFornecedor(SofasPorFornecedorChart $chart)
    {
        return view('charts.sofas_fornecedor', [
            'chart' => $chart->build(),
            'titulo' => 'Gráfico: Sofás por Fornecedor (Formato Pizza)',
        ]);
    }

    public function vendasPorSofa(VendasPorSofaChart $chart)
    {
        return view('charts.vendas', [
            'chart' => $chart->build(),
            'titulo' => 'Gráfico: Faturamento por Modelo de Sofá (Formato Barras)',
        ]);
    }
}
