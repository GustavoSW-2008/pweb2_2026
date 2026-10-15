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
        $buscar = $request->buscar ?? $request->valor;

        $vendas = Venda::with(['cliente', 'sofa'])
            ->when($buscar, function ($query) use ($buscar) {
                $query->whereHas('cliente', function ($q) use ($buscar) {
                    $q->where('nome', 'like', "%{$buscar}%");
                })
                ->orWhereHas('sofa', function ($q) use ($buscar) {
                    $q->where('modelo', 'like', "%{$buscar}%");
                })
                ->orWhere('forma_pagamento', 'like', "%{$buscar}%")
                ->orWhere('data_venda', 'like', "%{$buscar}%");
            })
            ->orderBy('data_venda', 'desc')
            ->get();

        return view('vendas.list', compact('vendas', 'buscar'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $sofas = Sofa::orderBy('modelo')->get();

        return view('vendas.form', compact('clientes', 'sofas'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'sofa_id' => 'required|exists:sofas,id',
            'data_venda' => 'required|date',
            'quantidade' => 'required|integer|min:1',
            'forma_pagamento' => 'required|string|max:50',
        ], [
            'cliente_id.required' => 'Selecione um cliente.',
            'cliente_id.exists' => 'O cliente selecionado é inválido.',
            'sofa_id.required' => 'Selecione um sofá.',
            'sofa_id.exists' => 'O sofá selecionado é inválido.',
            'data_venda.required' => 'Informe a data da venda.',
            'data_venda.date' => 'A data da venda deve ser válida.',
            'quantidade.required' => 'Informe a quantidade vendida.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade mínima é 1.',
            'forma_pagamento.required' => 'Selecione ou informe a forma de pagamento.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $sofa = Sofa::findOrFail($request->sofa_id);
        $quantidade = (int) $request->quantidade;

        $data = $request->all();
        $data['valor_total'] = $sofa->preco * $quantidade;

        Venda::create($data);

        return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function edit(Venda $venda)
    {
        $clientes = Cliente::orderBy('nome')->get();
        $sofas = Sofa::orderBy('modelo')->get();

        return view('vendas.form', compact('venda', 'clientes', 'sofas'));
    }

    public function update(Request $request, Venda $venda)
    {
        $this->validateForm($request);

        $sofa = Sofa::findOrFail($request->sofa_id);
        $quantidade = (int) $request->quantidade;

        $data = $request->all();
        $data['valor_total'] = $sofa->preco * $quantidade;

        $venda->update($data);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();

        return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function report()
    {
        $vendas = Venda::with(['cliente', 'sofa'])->orderBy('data_venda', 'desc')->get();

        $totalGeral = $vendas->sum('valor_total');

        $data = [
            'titulo' => 'Relatório Geral de Vendas',
            'data' => date('d/m/Y H:i'),
            'dados' => $vendas,
            'totalGeral' => $totalGeral,
        ];

        $pdf = Pdf::loadView('reports.vendas', $data);

        return $pdf->download('relatorio_vendas.pdf');
    }
}
