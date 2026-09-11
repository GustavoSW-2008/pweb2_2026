<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VendaController;

// Redireciona a tela inicial para o dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('clientes', ClienteController::class);
Route::resource('fornecedores', FornecedorController::class)->parameters([
    'fornecedores' => 'fornecedor'
]);
Route::resource('sofas', SofaController::class);
Route::resource('vendas', VendaController::class);