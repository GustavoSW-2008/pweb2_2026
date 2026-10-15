<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Sofa;
use App\Models\Venda;
use App\Models\FichaTecnica;
use App\Charts\SofasPorFornecedorChart;
use App\Charts\VendasPorSofaChart;

class DashboardController extends Controller
{
    public function index(SofasPorFornecedorChart $chartSofas, VendasPorSofaChart $chartVendas)
    {
        $totalClientes = Cliente::count();
        $totalFornecedores = Fornecedor::count();
        $totalSofas = Sofa::count();
        $totalVendas = Venda::count();
        $totalFichas = FichaTecnica::count();
        $faturamentoTotal = Venda::sum('valor_total');

        // Últimos registros para painel
        $ultimosClientes = Cliente::orderBy('created_at', 'desc')->take(5)->get();
        $ultimosSofas = Sofa::with('fornecedor')->orderBy('created_at', 'desc')->take(5)->get();
        $ultimasVendas = Venda::with(['cliente', 'sofa'])->orderBy('data_venda', 'desc')->take(5)->get();

        // Todos os sofás para o catálogo visual
        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalFornecedores',
            'totalSofas',
            'totalVendas',
            'totalFichas',
            'faturamentoTotal',
            'ultimosClientes',
            'ultimosSofas',
            'ultimasVendas',
            'sofas'
        ), [
            'chartSofas' => $chartSofas->build(),
            'chartVendas' => $chartVendas->build(),
        ]);
    }
}
