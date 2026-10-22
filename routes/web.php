<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\FichaTecnicaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\VendaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/sofas/relatorio', [SofaController::class, 'relatorio'])->name('sofas.report');
Route::resource('sofas', SofaController::class);

Route::resource('fichas-tecnicas', FichaTecnicaController::class);

Route::get('/clientes/relatorio', [ClienteController::class, 'relatorio'])->name('clientes.report');
Route::resource('clientes', ClienteController::class);

Route::resource('fornecedores', FornecedorController::class)->parameters([
    'fornecedores' => 'fornecedor',
]);

Route::resource('vendas', VendaController::class);
