<?php

namespace App\Http\Controllers;

use App\Models\Sofa;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SofaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])
            ->when($search, function ($query) use ($search) {
                $query->where('modelo', 'like', "%{$search}%");
            })
            ->orderBy('modelo')
            ->get();

        return view('sofas.list', compact('sofas', 'search'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::orderBy('empresa')->get();
        return view('sofas.form', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'             => 'required|max:255',
            'cor'                => 'required|max:100',
            'preco'              => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
            'fornecedor_id'      => 'required|exists:fornecedores,id',
            'imagem'             => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('sofas', 'public');
        }

        Sofa::create($dados);

        return redirect()->route('sofas.index')->with('success', 'Sofá cadastrado com sucesso!');
    }

    public function edit(Sofa $sofa)
    {
        $fornecedores = Fornecedor::orderBy('empresa')->get();
        return view('sofas.form', compact('sofa', 'fornecedores'));
    }

    public function update(Request $request, Sofa $sofa)
    {
        $request->validate([
            'modelo'             => 'required|max:255',
            'cor'                => 'required|max:100',
            'preco'              => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
            'fornecedor_id'      => 'required|exists:fornecedores,id',
            'imagem'             => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
                Storage::disk('public')->delete($sofa->imagem);
            }
            $dados['imagem'] = $request->file('imagem')->store('sofas', 'public');
        }

        $sofa->update($dados);

        return redirect()->route('sofas.index')->with('success', 'Sofá atualizado com sucesso!');
    }

    public function destroy(Sofa $sofa)
    {
        if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
            Storage::disk('public')->delete($sofa->imagem);
        }

        $sofa->delete();

        return redirect()->route('sofas.index')->with('success', 'Sofá removido com sucesso!');
    }

    public function relatorio()
    {
        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])->orderBy('modelo')->get();

        $data = [
            'title' => 'Relatório de Sofás em Estoque',
            'date'  => date('d/m/Y H:i'),
            'sofas' => $sofas,
        ];

        $pdf = Pdf::loadView('relatorios.sofas', $data);

        return $pdf->download('relatorio_sofas.pdf');
    }
}
