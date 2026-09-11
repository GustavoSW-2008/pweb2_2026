<?php
namespace App\Http\Controllers;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Sofa;
use Illuminate\Http\Request;

class VendaController extends Controller {
    public function index(Request $request) {
    $buscar = $request->buscar;
    $vendas = Venda::with(['cliente', 'sofa'])->when($buscar, function($query) use ($buscar) {
        $query->whereHas('cliente', function($q) use ($buscar) {
                  $q->where('nome', 'like', "%{$buscar}%");
              })
              ->orWhereHas('sofa', function($q) use ($buscar) {
                  $q->where('modelo', 'like', "%{$buscar}%");
              });
    })->get();

    return view('vendas.list', compact('vendas', 'buscar'));
    }

    public function create() {
        $clientes = Cliente::all();
        $sofas = Sofa::all();
        return view('vendas.form', compact('clientes', 'sofas'));
    }

    public function store(Request $request) {
        $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'sofa_id' => 'required|exists:sofas,id',
        'data_venda' => 'required|date'
        ], [
        'required' => 'O campo :attribute é obrigatório.',
        'exists' => 'O :attribute selecionado é inválido.',
        'date' => 'Informe uma data válida.'
        ]);
        Venda::create($request->all());
        return redirect()->route('vendas.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function edit(Venda $venda) {
        $clientes = Cliente::all();
        $sofas = Sofa::all();
        return view('vendas.form', compact('venda', 'clientes', 'sofas'));
    }

    public function update(Request $request, Venda $venda) {
        $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'sofa_id' => 'required|exists:sofas,id',
        'data_venda' => 'required|date'
        ], [
        'required' => 'O campo :attribute é obrigatório.',
        'exists' => 'O :attribute selecionado é inválido.',
        'date' => 'Informe uma data válida.'
        ]);
        $venda->update($request->all());
        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda) {
        $venda->delete();
        return redirect()->route('vendas.index')->with('success', 'Venda removida com sucesso!');
    }
}
