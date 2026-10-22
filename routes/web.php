<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\SofaController;

// Painel de Controle (Dashboard)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// 1. Categorias (CRUD + busca ?search=)
Route::resource('categorias', CategoriaController::class);

// 2. Fornecedores (CRUD + busca ?search=)
Route::resource('fornecedores', FornecedorController::class)->parameters([
    'fornecedores' => 'fornecedor',
]);

// 3. Clientes (CRUD + busca ?search= + Relatório PDF + Upload)
Route::get('/clientes/relatorio', [ClienteController::class, 'relatorio'])->name('clientes.report');
Route::resource('clientes', ClienteController::class);

// 4. Endereços (CRUD + busca ?search= - Relacionamento 1:1 com Cliente)
Route::resource('enderecos', EnderecoController::class);

// 5. Sofás (CRUD + busca ?search= + Relatório PDF + Upload - Relacionamento 1:N)
Route::get('/sofas/relatorio', [SofaController::class, 'relatorio'])->name('sofas.report');
Route::resource('sofas', SofaController::class);