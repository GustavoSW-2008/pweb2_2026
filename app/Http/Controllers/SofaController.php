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
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('sofas.form', compact('fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'       => 'required|max:255',
            'cor'          => 'required|max:100',
            'preco'        => 'required|numeric|min:0',
            'fornecedor_id'=> 'required|exists:fornecedores,id',
            'imagem'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
            $imagem->storeAs('imagens/sofas', $nomeImagem, 'public');
            $dados['imagem'] = 'imagens/sofas/' . $nomeImagem;
        }

        Sofa::create($dados);

        return redirect()->route('sofas.index')->with('success', 'Sofá cadastrado com sucesso!');
    }

    public function edit(Sofa $sofa)
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('sofas.form', compact('sofa', 'fornecedores'));
    }

    public function update(Request $request, Sofa $sofa)
    {
        $request->validate([
            'modelo'       => 'required|max:255',
            'cor'          => 'required|max:100',
            'preco'        => 'required|numeric|min:0',
            'fornecedor_id'=> 'required|exists:fornecedores,id',
            'imagem'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            // Remove imagem antiga se existir
            if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
                Storage::disk('public')->delete($sofa->imagem);
            }

            $imagem = $request->file('imagem');
            $nomeImagem = time() . '_' . $imagem->getClientOriginalName();
            $imagem->storeAs('imagens/sofas', $nomeImagem, 'public');
            $dados['imagem'] = 'imagens/sofas/' . $nomeImagem;
        }

        $sofa->update($dados);

        return redirect()->route('sofas.index')->with('success', 'Sofá atualizado com sucesso!');
    }

    public function destroy(Sofa $sofa)
    {
        if ($sofa->vendas()->count() > 0) {
            return redirect()->route('sofas.index')
                ->with('error', 'Não é possível remover o sofá pois há vendas vinculadas a ele!');
        }

        if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
            Storage::disk('public')->delete($sofa->imagem);
        }

        $sofa->delete();

        return redirect()->route('sofas.index')->with('success', 'Sofá removido com sucesso!');
    }

    public function report()
    {
        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])->orderBy('modelo')->get();

        $pdf = Pdf::loadView('reports.sofas', [
            'sofas' => $sofas,
            'data'  => date('d/m/Y H:i'),
        ]);

        return $pdf->download('relatorio_sofas.pdf');
    }
}