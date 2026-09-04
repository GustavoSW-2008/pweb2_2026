<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\SofaController;

// Redireciona a tela inicial direto para a lista de clientes
Route::get('/', function () {
    return redirect()->route('clientes.index'); 
});

Route::resource('clientes', ClienteController::class);
Route::resource('fornecedores', FornecedorController::class)->parameters([
    'fornecedores' => 'fornecedor'
]);
Route::resource('sofas', SofaController::class);