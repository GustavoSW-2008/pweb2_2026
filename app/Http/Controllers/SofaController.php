<?php

namespace App\Http\Controllers;

use App\Models\Sofa;
use App\Models\Categoria;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SofaController extends Controller
{
    // Listagem com busca por modelo
    public function index(Request $request)
    {
        $search = $request->search;

        $sofas = Sofa::with(['categoria', 'fornecedor'])
            ->when($search, function ($query) use ($search) {
                $query->where('modelo', 'like', "%{$search}%");
            })
            ->orderBy('modelo')
            ->get();

        return view('sofas.list', compact('sofas', 'search'));
    }

    public function create()
    {
        $categorias   = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome_fantasia')->get();
        return view('sofas.form', compact('categorias', 'fornecedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'modelo'             => 'required|max:255',
            'cor'                => 'required|max:100',
            'preco'              => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
            'categoria_id'       => 'required|exists:categorias,id',
            'fornecedor_id'      => 'required|exists:fornecedores,id',
            'imagem'             => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        // Upload de imagem do sofá
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
        $categorias   = Categoria::orderBy('nome')->get();
        $fornecedores = Fornecedor::orderBy('nome_fantasia')->get();
        return view('sofas.form', compact('sofa', 'categorias', 'fornecedores'));
    }

    public function update(Request $request, Sofa $sofa)
    {
        $request->validate([
            'modelo'             => 'required|max:255',
            'cor'                => 'required|max:100',
            'preco'              => 'required|numeric|min:0',
            'quantidade_estoque' => 'required|integer|min:0',
            'categoria_id'       => 'required|exists:categorias,id',
            'fornecedor_id'      => 'required|exists:fornecedores,id',
            'imagem'             => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        // Se enviou nova imagem, remove a antiga e salva a nova
        if ($request->hasFile('imagem')) {
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
        // Exclusão física da imagem do disco
        if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
            Storage::disk('public')->delete($sofa->imagem);
        }

        $sofa->delete();

        return redirect()->route('sofas.index')->with('success', 'Sofá removido com sucesso!');
    }

    // Relatório de Sofás em Estoque em PDF
    public function relatorio()
    {
        $sofas = Sofa::with(['categoria', 'fornecedor'])->orderBy('modelo')->get();

        $pdf = Pdf::loadView('reports.sofas', [
            'sofas' => $sofas,
            'data'  => date('d/m/Y H:i'),
        ]);

        return $pdf->download('relatorio_sofas.pdf');
    }
}