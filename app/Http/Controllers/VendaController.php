<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Sofa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $vendas = Venda::with(['cliente', 'sofa'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('cliente', function ($q) use ($search) {
                    $q->where('nome', 'like', "%{$search}%");
                });
            })
            ->orderBy('data_venda', 'desc')
            ->get();

        return view('vendas.list', compact('vendas', 'search'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $sofas    = Sofa::orderBy('modelo')->get();
        return view('vendas.form', compact('clientes', 'sofas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'sofa_id'        => 'required|exists:sofas,id',
            'data_venda'     => 'required|date',
            'quantidade'     => 'required|integer|min:1',
            'forma_pagamento'=> 'required|string|max:50',
        ]);

        $sofa = Sofa::findOrFail($request->sofa_id);

        $dados = $request->all();
        $dados['valor_total'] = $sofa->preco * $request->quantidade;

        Venda::create($dados);

        return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $sofas    = Sofa::orderBy('modelo')->get();
        return view('vendas.form', compact('venda', 'clientes', 'sofas'));
    }

    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'cliente_id'     => 'required|exists:clientes,id',
            'sofa_id'        => 'required|exists:sofas,id',
            'data_venda'     => 'required|date',
            'quantidade'     => 'required|integer|min:1',
            'forma_pagamento'=> 'required|string|max:50',
        ]);

        $sofa = Sofa::findOrFail($request->sofa_id);

        $dados = $request->all();
        $dados['valor_total'] = $sofa->preco * $request->quantidade;

        $venda->update($dados);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso!');
    }

    public function report()
    {
        $vendas = Venda::with(['cliente', 'sofa'])->orderBy('data_venda', 'desc')->get();

        $pdf = Pdf::loadView('reports.vendas', [
            'vendas'      => $vendas,
            'totalGeral'  => $vendas->sum('valor_total'),
            'data'        => date('d/m/Y H:i'),
        ]);

        return $pdf->download('relatorio_vendas.pdf');
    }
}
