<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    // Listagem com busca por nome fantasia ou razão social
    public function index(Request $request)
    {
        $search = $request->search;

        $fornecedores = Fornecedor::when($search, function ($query) use ($search) {
            $query->where('nome_fantasia', 'like', "%{$search}%")
                  ->orWhere('razao_social', 'like', "%{$search}%");
        })->orderBy('nome_fantasia')->get();

        return view('fornecedores.list', compact('fornecedores', 'search'));
    }

    public function create()
    {
        return view('fornecedores.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'razao_social'  => 'required|max:255',
            'nome_fantasia' => 'required|max:255',
            'cnpj'          => 'required|unique:fornecedores,cnpj',
            'email_contato' => 'required|email|max:255',
            'telefone'      => 'required|max:30',
        ]);

        Fornecedor::create($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedores.form', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $request->validate([
            'razao_social'  => 'required|max:255',
            'nome_fantasia' => 'required|max:255',
            'cnpj'          => 'required|unique:fornecedores,cnpj,' . $fornecedor->id,
            'email_contato' => 'required|email|max:255',
            'telefone'      => 'required|max:30',
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        // Impede remoção se houver sofás vinculados ao fornecedor
        if ($fornecedor->sofas()->count() > 0) {
            return redirect()->route('fornecedores.index')
                ->with('error', 'Não é possível remover o fornecedor pois há sofás vinculados a ele!');
        }

        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
    }
}