<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SofaController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\FichaTecnicaController;

Route::get('/', function () {
    return view('main');
});

Route::resource('sofas', SofaController::class);
Route::resource('fornecedors', FornecedorController::class);
Route::resource('fichas', FichaTecnicaController::class);

Route::get('/aluno/edit/{id}',
    [AlunoController::class, 'edit'])->name('aluno.edit');
Route::put(
    '/aluno/update/{id}',
    [AlunoController::class, 'update']
)->name('aluno.update');

Route::delete(
    '/aluno/{id}',
    [AlunoController::class, 'destroy']
)->name('aluno.destroy');

Route::post(
    '/aluno/search',
    [AlunoController::class, 'search']
)->name('aluno.search');

/*
Route::get('/aluno', function () {
    return view('aluno.list');
    //return "<h3>Olá mundo Laravel!</h3>";
});
*/
