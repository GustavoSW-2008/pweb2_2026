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
        $buscar = $request->buscar ?? $request->valor;

        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])
            ->when($buscar, function ($query) use ($buscar) {
                $query->where('modelo', 'like', "%{$buscar}%")
                    ->orWhere('cor', 'like', "%{$buscar}%")
                    ->orWhereHas('fornecedor', function ($q) use ($buscar) {
                        $q->where('nome', 'like', "%{$buscar}%");
                    });
            })
            ->orderBy('modelo')
            ->get();

        return view('sofas.list', compact('sofas', 'buscar'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('sofas.form', compact('fornecedores'));
    }

    public function validateForm(Request $request)
    {
        $request->validate([
            'modelo' => 'required|max:255',
            'cor' => 'required|max:100',
            'preco' => 'required|numeric|min:0',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'modelo.required' => 'O modelo do sofá é obrigatório.',
            'cor.required' => 'A cor é obrigatória.',
            'preco.required' => 'O preço é obrigatório.',
            'preco.numeric' => 'O preço deve ser um valor numérico válido.',
            'preco.min' => 'O preço não pode ser negativo.',
            'fornecedor_id.required' => 'Selecione um fornecedor.',
            'fornecedor_id.exists' => 'O fornecedor selecionado é inválido.',
            'imagem.image' => 'O arquivo enviado deve ser uma imagem.',
            'imagem.mimes' => 'A imagem deve ser PNG, JPG, JPEG ou WEBP.',
            'imagem.max' => 'A imagem não pode ultrapassar 2MB.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $diretorio = 'imagem/sofa/';
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Sofa::create($data);

        return redirect()->route('sofas.index')->with('success', 'Sofá cadastrado com sucesso!');
    }

    public function edit(Sofa $sofa)
    {
        $fornecedores = Fornecedor::orderBy('nome')->get();
        return view('sofas.form', compact('sofa', 'fornecedores'));
    }

    public function update(Request $request, Sofa $sofa)
    {
        $this->validateForm($request);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            // Remove a imagem antiga se existir
            if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
                Storage::disk('public')->delete($sofa->imagem);
            }

            $nome_imagem = date('YmdiHs') . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $diretorio = 'imagem/sofa/';
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $sofa->update($data);

        return redirect()->route('sofas.index')->with('success', 'Sofá atualizado com sucesso!');
    }

    public function destroy(Sofa $sofa)
    {
        // Verifica se há vendas vinculadas ao sofá
        if ($sofa->vendas()->count() > 0) {
            return redirect()->route('sofas.index')->with(
                'error',
                "Não é possível remover o sofá {$sofa->modelo}, pois existem vendas registradas para ele!"
            );
        }

        // Exclui a imagem física associada
        if ($sofa->imagem && Storage::disk('public')->exists($sofa->imagem)) {
            Storage::disk('public')->delete($sofa->imagem);
        }

        $sofa->delete();

        return redirect()->route('sofas.index')->with('success', 'Sofá removido com sucesso!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }

    public function report()
    {
        $sofas = Sofa::with(['fornecedor', 'fichaTecnica'])->orderBy('modelo')->get();

        $data = [
            'titulo' => 'Relatório de Sofás Cadastrados',
            'data' => date('d/m/Y H:i'),
            'dados' => $sofas,
        ];

        $pdf = Pdf::loadView('reports.sofas', $data);

        return $pdf->download('relatorio_sofas.pdf');
    }
}