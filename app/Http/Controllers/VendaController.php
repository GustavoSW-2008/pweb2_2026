<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Sofa;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $vendas = Venda::with(['cliente', 'sofas'])
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
        $sofas = Sofa::orderBy('modelo')->get();
        return view('vendas.form', compact('clientes', 'sofas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'          => 'required|exists:clientes,id',
            'data_venda'          => 'required|date',
            'forma_pagamento'     => 'required|string|max:100',
            'itens'               => 'required|array|min:1',
            'itens.*.sofa_id'     => 'required|exists:sofas,id',
            'itens.*.quantidade'  => 'required|integer|min:1',
        ]);

        $valorTotal = 0;
        $pivotData = [];

        foreach ($request->itens as $item) {
            $sofa = Sofa::findOrFail($item['sofa_id']);
            $qtd = (int) $item['quantidade'];
            $subtotal = $sofa->preco * $qtd;
            $valorTotal += $subtotal;

            $pivotData[$sofa->id] = [
                'quantidade'     => $qtd,
                'preco_unitario' => $sofa->preco,
            ];
        }

        $venda = Venda::create([
            'cliente_id'      => $request->cliente_id,
            'data_venda'      => $request->data_venda,
            'valor_total'     => $valorTotal,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        $venda->sofas()->attach($pivotData);

        return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function show(Venda $venda)
    {
        $venda->load(['cliente', 'sofas']);
        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $venda->load('sofas');
        $clientes = Cliente::orderBy('nome')->get();
        $sofas = Sofa::orderBy('modelo')->get();
        return view('vendas.form', compact('venda', 'clientes', 'sofas'));
    }

    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'cliente_id'          => 'required|exists:clientes,id',
            'data_venda'          => 'required|date',
            'forma_pagamento'     => 'required|string|max:100',
            'itens'               => 'required|array|min:1',
            'itens.*.sofa_id'     => 'required|exists:sofas,id',
            'itens.*.quantidade'  => 'required|integer|min:1',
        ]);

        $valorTotal = 0;
        $pivotData = [];

        foreach ($request->itens as $item) {
            $sofa = Sofa::findOrFail($item['sofa_id']);
            $qtd = (int) $item['quantidade'];
            $subtotal = $sofa->preco * $qtd;
            $valorTotal += $subtotal;

            $pivotData[$sofa->id] = [
                'quantidade'     => $qtd,
                'preco_unitario' => $sofa->preco,
            ];
        }

        $venda->update([
            'cliente_id'      => $request->cliente_id,
            'data_venda'      => $request->data_venda,
            'valor_total'     => $valorTotal,
            'forma_pagamento' => $request->forma_pagamento,
        ]);

        $venda->sofas()->sync($pivotData);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->sofas()->detach();
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso!');
    }
}
