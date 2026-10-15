<?php

namespace App\Charts;

use App\Models\Sofa;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class VendasPorSofaChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $vendasPorSofa = DB::table('vendas')
            ->join('sofas', 'sofas.id', '=', 'vendas.sofa_id')
            ->select('sofas.modelo', DB::raw('SUM(vendas.quantidade) as total_qtd'), DB::raw('SUM(vendas.valor_total) as total_faturamento'))
            ->groupBy('sofas.id', 'sofas.modelo')
            ->orderBy('total_faturamento', 'desc')
            ->get();

        $nomes = [];
        $faturamentos = [];

        foreach ($vendasPorSofa as $item) {
            $nomes[] = $item->modelo;
            $faturamentos[] = (float) $item->total_faturamento;
        }

        // Se nenhuma venda tiver sido registrada, usa dados dos sofás cadastrados
        if (empty($nomes)) {
            $sofas = Sofa::take(5)->get();
            foreach ($sofas as $sofa) {
                $nomes[] = $sofa->modelo;
                $faturamentos[] = (float) $sofa->preco;
            }
        }

        return (new LarapexChart)->barChart()
            ->setTitle('Faturamento por Modelo de Sofá (R$)')
            ->setSubtitle('Valores totais comercializados')
            ->addData($faturamentos, 'Total Vendido (R$)')
            ->setXAxis($nomes);
    }
}
