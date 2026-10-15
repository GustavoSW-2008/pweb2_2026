<?php

namespace App\Charts;

use App\Models\Fornecedor;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SofasPorFornecedorChart
{
    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $fornecedores = Fornecedor::withCount('sofas')->get();

        $nomes = [];
        $quantidades = [];

        foreach ($fornecedores as $fornecedor) {
            $nomes[] = $fornecedor->nome;
            $quantidades[] = $fornecedor->sofas_count;
        }

        return (new LarapexChart)->pieChart()
            ->setTitle('Modelos de Sofás por Fornecedor')
            ->setSubtitle('Distribuição do catálogo por parceiro')
            ->addData($quantidades)
            ->setLabels($nomes);
    }
}
