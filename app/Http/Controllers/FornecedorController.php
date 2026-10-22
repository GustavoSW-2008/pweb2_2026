<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $fornecedores = Fornecedor::when($search, function ($query) use ($search) {
            $query->where('empresa', 'like', "%{$search}%");
        })->orderBy('empresa')->get();

        return view('fornecedores.list', compact('fornecedores', 'search'));
    }

    public function create()
    {
        return view('fornecedores.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'empresa'       => 'required|max:255',
            'cnpj'          => 'required|unique:fornecedores,cnpj',
            'email_contato' => 'required|email|max:255',
            'telefone'      => 'required|max:30',
            'avaliacao'     => 'required|integer|min:1|max:10',
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
            'empresa'       => 'required|max:255',
            'cnpj'          => 'required|unique:fornecedores,cnpj,' . $fornecedor->id,
            'email_contato' => 'required|email|max:255',
            'telefone'      => 'required|max:30',
            'avaliacao'     => 'required|integer|min:1|max:10',
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        if ($fornecedor->sofas()->count() > 0) {
            return redirect()->route('fornecedores.index')
                ->with('error', 'Não é possível remover o fornecedor pois há sofás vinculados a ele!');
        }

        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
    }
}