<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Sofa;
use App\Models\Venda;
use App\Models\FichaTecnica;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes    = Cliente::count();
        $totalFornecedores = Fornecedor::count();
        $totalSofas       = Sofa::count();
        $totalVendas      = Venda::count();
        $totalFichas      = FichaTecnica::count();
        $faturamentoTotal = Venda::sum('valor_total');

        $ultimasVendas = Venda::with(['cliente', 'sofa'])
            ->orderBy('data_venda', 'desc')
            ->take(5)
            ->get();

        $ultimosClientes = Cliente::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Dados para Gráfico 1: Sofás por Fornecedor (Pizza - Chart.js)
        $sofasPorFornecedor = Fornecedor::withCount('sofas')->get();
        $labelsFornecedor   = $sofasPorFornecedor->pluck('nome');
        $dadosFornecedor    = $sofasPorFornecedor->pluck('sofas_count');

        // Dados para Gráfico 2: Vendas por mês (Barras - Chart.js)
        $vendasPorMes = Venda::select(
            DB::raw('MONTH(data_venda) as mes'),
            DB::raw('SUM(valor_total) as total')
        )
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
        $labelsVendas = [];
        $dadosVendas  = [];
        foreach ($vendasPorMes as $item) {
            $labelsVendas[] = $meses[$item->mes - 1];
            $dadosVendas[]  = $item->total;
        }

        return view('dashboard', compact(
            'totalClientes',
            'totalFornecedores',
            'totalSofas',
            'totalVendas',
            'totalFichas',
            'faturamentoTotal',
            'ultimasVendas',
            'ultimosClientes',
            'labelsFornecedor',
            'dadosFornecedor',
            'labelsVendas',
            'dadosVendas'
        ));
    }
}
