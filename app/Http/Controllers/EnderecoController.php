<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use App\Models\Cliente;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    // Listagem com busca por rua ou cidade
    public function index(Request $request)
    {
        $search = $request->search;

        $enderecos = Endereco::with('cliente')
            ->when($search, function ($query) use ($search) {
                $query->where('rua', 'like', "%{$search}%")
                      ->orWhere('cidade', 'like', "%{$search}%")
                      ->orWhere('bairro', 'like', "%{$search}%");
            })
            ->get();

        return view('enderecos.list', compact('enderecos', 'search'));
    }

    public function create()
    {
        // Apenas clientes que ainda não possuem endereço (relação 1:1)
        $clientes = Cliente::doesntHave('endereco')->orderBy('nome')->get();
        return view('enderecos.form', compact('clientes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id|unique:enderecos,cliente_id',
            'rua'        => 'required|max:255',
            'numero'     => 'required|max:20',
            'bairro'     => 'required|max:100',
            'cidade'     => 'required|max:100',
            'cep'        => 'required|max:20',
        ]);

        Endereco::create($request->all());

        return redirect()->route('enderecos.index')->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function edit(Endereco $endereco)
    {
        // Clientes sem endereço ou o próprio cliente deste endereço
        $clientes = Cliente::doesntHave('endereco')
            ->orWhere('id', $endereco->cliente_id)
            ->orderBy('nome')
            ->get();

        return view('enderecos.form', compact('endereco', 'clientes'));
    }

    public function update(Request $request, Endereco $endereco)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id|unique:enderecos,cliente_id,' . $endereco->id,
            'rua'        => 'required|max:255',
            'numero'     => 'required|max:20',
            'bairro'     => 'required|max:100',
            'cidade'     => 'required|max:100',
            'cep'        => 'required|max:20',
        ]);

        $endereco->update($request->all());

        return redirect()->route('enderecos.index')->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy(Endereco $endereco)
    {
        $endereco->delete();

        return redirect()->route('enderecos.index')->with('success', 'Endereço removido com sucesso!');
    }
}
