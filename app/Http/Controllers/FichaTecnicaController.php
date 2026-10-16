<?php

namespace App\Http\Controllers;

use App\Models\FichaTecnica;
use App\Models\Sofa;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar ?? $request->valor;

        $fichas = FichaTecnica::with('sofa')
            ->when($buscar, function ($query) use ($buscar) {
                $query->where('tecido', 'like', "%{$buscar}%")
                    ->orWhere('dimensoes', 'like', "%{$buscar}%")
                    ->orWhere('densidade_espuma', 'like', "%{$buscar}%")
                    ->orWhereHas('sofa', function ($q) use ($buscar) {
                        $q->where('modelo', 'like', "%{$buscar}%");
                    });
            })
            ->get();

        return view('fichas_tecnicas.list', compact('fichas', 'buscar'));
    }

    public function create()
    {
        // Sofás que ainda não possuem ficha técnica cadastrada (Relacionamento 1:1)
        $sofas = Sofa::whereDoesntHave('fichaTecnica')->orderBy('modelo')->get();

        return view('fichas_tecnicas.form', compact('sofas'));
    }

    public function validateForm(Request $request, $id = null)
    {
        $uniqueSofa = 'unique:fichas_tecnicas,sofa_id' . ($id ? ",{$id}" : '');

        $request->validate([
            'sofa_id' => "required|exists:sofas,id|{$uniqueSofa}",
            'tecido' => 'required|max:100',
            'peso' => 'required|numeric|min:1',
            'dimensoes' => 'required|max:100',
            'garantia_meses' => 'required|integer|min:1|max:120',
            'densidade_espuma' => 'nullable|max:100',
        ], [
            'sofa_id.required' => 'Selecione um sofá para a ficha técnica.',
            'sofa_id.unique' => 'Este sofá já possui uma ficha técnica cadastrada .',
            'sofa_id.exists' => 'O sofá selecionado é inválido.',
            'tecido.required' => 'O tipo de tecido é obrigatório.',
            'peso.required' => 'O peso do produto é obrigatório.',
            'peso.numeric' => 'O peso deve ser um valor numérico (em kg).',
            'dimensoes.required' => 'As dimensões do sofá são obrigatórias.',
            'garantia_meses.required' => 'O prazo de garantia é obrigatório.',
            'garantia_meses.integer' => 'A garantia deve ser informada em meses (número inteiro).',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        FichaTecnica::create($request->all());

        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica cadastrada com sucesso!');
    }

    public function edit(FichaTecnica $ficha)
    {
        // Ao editar, inclui os sofás livres mais o sofá atual desta ficha
        $sofas = Sofa::whereDoesntHave('fichaTecnica')
            ->orWhere('id', $ficha->sofa_id)
            ->orderBy('modelo')
            ->get();

        return view('fichas_tecnicas.form', compact('ficha', 'sofas'));
    }

    public function update(Request $request, FichaTecnica $ficha)
    {
        $this->validateForm($request, $ficha->id);

        $ficha->update($request->all());

        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica atualizada com sucesso!');
    }

    public function destroy(FichaTecnica $ficha)
    {
        $ficha->delete();

        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica removida com sucesso!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}
