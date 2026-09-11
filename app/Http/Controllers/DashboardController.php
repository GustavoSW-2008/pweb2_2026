<?php
namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Sofa;

class DashboardController extends Controller {
    public function index() {
        $totalClientes = Cliente::count();
        $totalFornecedores = Fornecedor::count();
        $totalSofas = Sofa::count();

        // ultimos 5 clientes cadastrados
        $ultimosClientes = Cliente::orderBy('created_at', 'desc')->take(5)->get();

        // ultimos 5 sofas cadastrados
        $ultimosSofas = Sofa::with('fornecedor')->orderBy('created_at', 'desc')->take(5)->get();

        // todos os sofas para o catalogo
        $sofas = Sofa::with('fornecedor')->get();

        return view('dashboard', compact(
            'totalClientes',
            'totalFornecedores',
            'totalSofas',
            'ultimosClientes',
            'ultimosSofas',
            'sofas'
        ));
    }
}
