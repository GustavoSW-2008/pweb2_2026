<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $clientes = Cliente::when($search, function ($query) use ($search) {
            $query->where('nome', 'like', "%{$search}%");
        })->orderBy('nome')->get();

        return view('clientes.list', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'     => 'required|max:255',
            'cpf'      => 'required|unique:clientes,cpf',
            'telefone' => 'required|max:30',
            'idade'    => 'nullable|integer|min:0|max:150',
            'endereco' => 'nullable|max:255',
            'imagem'   => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
            $imagem->storeAs('imagens/clientes', $nomeImagem, 'public');
            $dados['imagem'] = 'imagens/clientes/' . $nomeImagem;
        }

        Cliente::create($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'     => 'required|max:255',
            'cpf'      => 'required|unique:clientes,cpf,' . $cliente->id,
            'telefone' => 'required|max:30',
            'idade'    => 'nullable|integer|min:0|max:150',
            'endereco' => 'nullable|max:255',
            'imagem'   => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
                Storage::disk('public')->delete($cliente->imagem);
            }

            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
            $imagem->storeAs('imagens/clientes', $nomeImagem, 'public');
            $dados['imagem'] = 'imagens/clientes/' . $nomeImagem;
        }

        $cliente->update($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->vendas()->count() > 0) {
            return redirect()->route('clientes.index')
                ->with('error', 'Não é possível remover o cliente pois há vendas vinculadas a ele!');
        }

        if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
            Storage::disk('public')->delete($cliente->imagem);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }
}