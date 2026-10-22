<?php

namespace App\Http\Controllers;

use App\Models\Sofa;
use App\Models\FichaTecnica;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Venda;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSofas        = Sofa::count();
        $totalFichas       = FichaTecnica::count();
        $totalClientes     = Cliente::count();
        $totalFornecedores = Fornecedor::count();
        $totalVendas       = Venda::count();
        $totalEstoque      = Sofa::sum('quantidade_estoque');

        $ultimosSofas = Sofa::with(['fornecedor', 'fichaTecnica'])
            ->latest()
            ->take(5)
            ->get();

        $ultimasVendas = Venda::with(['cliente', 'sofas'])
            ->latest('data_venda')
            ->take(5)
            ->get();

        $meses = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
        $totaisMes = array_fill(1, 12, 0.0);

        $vendasMes = Venda::select(
            DB::raw('MONTH(data_venda) as mes'),
            DB::raw('SUM(valor_total) as total')
        )
        ->groupBy('mes')
        ->pluck('total', 'mes')
        ->toArray();

        foreach ($vendasMes as $mes => $total) {
            $totaisMes[$mes] = (float) $total;
        }

        $chartVendas = (new LarapexChart)->barChart()
            ->setTitle('Vendas por Mês')
            ->setSubtitle('Faturamento mensal em Reais (R$)')
            ->addData(array_values($totaisMes), 'Total (R$)')
            ->setXAxis($meses)
            ->setHeight(320)
            ->setColors(['#1a3a5c']);

        $topSofas = DB::table('sofa_venda')
            ->join('sofas', 'sofa_venda.sofa_id', '=', 'sofas.id')
            ->select('sofas.modelo', DB::raw('SUM(sofa_venda.quantidade) as total_vendido'))
            ->groupBy('sofas.id', 'sofas.modelo')
            ->orderByDesc('total_vendido')
            ->take(5)
            ->get();

        $modelos = $topSofas->pluck('modelo')->toArray();
        $quantidades = $topSofas->pluck('total_vendido')->map(fn($v) => (int)$v)->toArray();

        if (empty($modelos)) {
            $modelos = ['Sem vendas'];
            $quantidades = [0];
        }

        $chartSofas = (new LarapexChart)->pieChart()
            ->setTitle('Top Sofás Vendidos')
            ->setSubtitle('Modelos com maior saída')
            ->addData($quantidades)
            ->setLabels($modelos)
            ->setHeight(320)
            ->setColors(['#1a3a5c', '#234b82', '#2b5d9b', '#f39c12', '#166534']);

        return view('dashboard', compact(
            'totalSofas',
            'totalFichas',
            'totalClientes',
            'totalFornecedores',
            'totalVendas',
            'totalEstoque',
            'ultimosSofas',
            'ultimasVendas',
            'chartVendas',
            'chartSofas'
        ));
    }
}
