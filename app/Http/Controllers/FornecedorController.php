<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request) {
    $buscar = $request->buscar;
    $fornecedores = Fornecedor::when($buscar, function ($query) use ($buscar) {
        $query->where('nome', 'like', "%{$buscar}%")
              ->orWhere('cnpj', 'like', "%{$buscar}%")
              ->orWhere('email', 'like', "%{$buscar}%");
    })->get();

    return view('fornecedores.list', compact('fornecedores', 'buscar'));
    }

    public function create()
    {
        return view('fornecedores.form');
    }

    public function store(Request $request)
    {
        $request->validate([
        'nome' => 'required|max:255',
        'cnpj' => 'required|unique:fornecedores,cnpj,' . ($fornecedor->id ?? ''),
        'email' => 'required|email|max:255',
        ], [
        'required' => 'O campo :attribute é obrigatório.',
        'unique' => 'Este :attribute já está cadastrado.',
        'email' => 'Insira um endereço de e-mail válido.Ex: exemplo@dominio.com',
        'max' => 'O campo :attribute é muito longo.'
        ]);

        Fornecedor::create($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor salvo com sucesso!');
    }

    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedores.form', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $request->validate([
        'nome' => 'required|max:255',
        'cnpj' => 'required|unique:fornecedores,cnpj,' . ($fornecedor->id ?? ''),
        'email' => 'required|email|max:255',
        ], [
        'required' => 'O campo :attribute é obrigatório.',
        'unique' => 'Este :attribute já está cadastrado.',
        'email' => 'Insira um endereço de e-mail válido.Ex: exemplo@dominio.com',
        'max' => 'O campo :attribute é muito longo.'
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
    }
}