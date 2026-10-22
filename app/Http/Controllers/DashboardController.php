<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Fornecedor;
use App\Models\Cliente;
use App\Models\Endereco;
use App\Models\Sofa;

class DashboardController extends Controller
{
    public function index()
    {
        // Contagens totais para os cards do dashboard
        $totalCategorias    = Categoria::count();
        $totalFornecedores = Fornecedor::count();
        $totalClientes     = Cliente::count();
        $totalEnderecos    = Endereco::count();
        $totalSofas        = Sofa::count();
        $totalEstoque      = Sofa::sum('quantidade_estoque');

        // Últimos registros para as tabelas resumo
        $ultimosSofas = Sofa::with(['categoria', 'fornecedor'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $ultimosClientes = Cliente::with('endereco')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Dados para Gráfico 1: Pizza - Sofás por Categoria
        $sofasPorCategoria = Categoria::withCount('sofas')->get();
        $labelsCategorias  = $sofasPorCategoria->pluck('nome');
        $dadosCategorias   = $sofasPorCategoria->pluck('sofas_count');

        // Dados para Gráfico 2: Barras - Sofás por Fornecedor
        $sofasPorFornecedor = Fornecedor::withCount('sofas')->get();
        $labelsFornecedores = $sofasPorFornecedor->pluck('nome_fantasia');
        $dadosFornecedores  = $sofasPorFornecedor->pluck('sofas_count');

        return view('dashboard', compact(
            'totalCategorias',
            'totalFornecedores',
            'totalClientes',
            'totalEnderecos',
            'totalSofas',
            'totalEstoque',
            'ultimosSofas',
            'ultimosClientes',
            'labelsCategorias',
            'dadosCategorias',
            'labelsFornecedores',
            'dadosFornecedores'
        ));
    }
}
