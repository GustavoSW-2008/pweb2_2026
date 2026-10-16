<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\FichaTecnicaController;

// Autenticação
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas protegidas (requer login)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Clientes (CRUD + busca via GET ?search=)
    Route::resource('clientes', ClienteController::class);

    // 2. Fornecedores (CRUD + busca via GET ?search=)
    Route::resource('fornecedores', FornecedorController::class)->parameters([
        'fornecedores' => 'fornecedor',
    ]);

    // 3. Sofás (CRUD + busca via GET ?search= + Relatório PDF)
    Route::get('/sofas/relatorio', [SofaController::class, 'report'])->name('sofas.report');
    Route::resource('sofas', SofaController::class);

    // 4. Vendas (CRUD + busca via GET ?search= + Relatório PDF)
    Route::get('/vendas/relatorio', [VendaController::class, 'report'])->name('vendas.report');
    Route::resource('vendas', VendaController::class);

    // 5. Fichas Técnicas (CRUD + busca via GET ?search=) - Relacionamento 1:1 com Sofá
    Route::resource('fichas', FichaTecnicaController::class)->parameters([
        'fichas' => 'ficha',
    ]);
});