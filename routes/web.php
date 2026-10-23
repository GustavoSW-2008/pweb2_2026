<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\FichaTecnicaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\VendaController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/sofas/relatorio', [SofaController::class, 'relatorio'])->name('relatorios.sofas');
Route::resource('sofas', SofaController::class);

Route::resource('fichas-tecnicas', FichaTecnicaController::class);

Route::resource('clientes', ClienteController::class);

Route::resource('fornecedores', FornecedorController::class)->parameters([
    'fornecedores' => 'fornecedor',
]);

Route::get('/relatorios/vendas', [VendaController::class, 'relatorio'])->name('relatorios.vendas'); 
Route::resource('vendas', VendaController::class);
