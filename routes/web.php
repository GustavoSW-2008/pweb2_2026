<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\FichaTecnicaController;
use App\Http\Controllers\GraficoController;

/*
|--------------------------------------------------------------------------
| Autenticação (Session / Login)
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::match(['get', 'post'], '/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Rotas Protegidas do Sistema
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Principal
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Clientes
    Route::post('/clientes/search', [ClienteController::class, 'search'])->name('clientes.search');
    Route::resource('clientes', ClienteController::class);

    // 2. Fornecedores
    Route::post('/fornecedores/search', [FornecedorController::class, 'search'])->name('fornecedores.search');
    Route::resource('fornecedores', FornecedorController::class)->parameters([
        'fornecedores' => 'fornecedor',
    ]);

    // 3. Sofás (com Upload de Imagem e Relatório PDF)
    Route::get('/sofas/report', [SofaController::class, 'report'])->name('sofas.report');
    Route::post('/sofas/search', [SofaController::class, 'search'])->name('sofas.search');
    Route::resource('sofas', SofaController::class);

    // 4. Vendas (com Relatório PDF)
    Route::get('/vendas/report', [VendaController::class, 'report'])->name('vendas.report');
    Route::post('/vendas/search', [VendaController::class, 'search'])->name('vendas.search');
    Route::resource('vendas', VendaController::class);

    // 5. Fichas Técnicas (Relacionamento 1:1 com Sofá)
    Route::post('/fichas/search', [FichaTecnicaController::class, 'search'])->name('fichas.search');
    Route::resource('fichas', FichaTecnicaController::class)->parameters([
        'fichas' => 'ficha',
    ]);

    // Gráficos (LarapexCharts: Pizza e Barras)
    Route::get('/graficos/sofas-fornecedor', [GraficoController::class, 'sofasPorFornecedor'])->name('graficos.sofas');
    Route::get('/graficos/vendas', [GraficoController::class, 'vendasPorSofa'])->name('graficos.vendas');
});