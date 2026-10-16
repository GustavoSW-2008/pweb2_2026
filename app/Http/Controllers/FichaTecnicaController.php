<?php

namespace App\Http\Controllers;

use App\Models\FichaTecnica;
use App\Models\Sofa;
use Illuminate\Http\Request;

class FichaTecnicaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $fichas = FichaTecnica::with('sofa')
            ->when($search, function ($query) use ($search) {
                $query->where('tecido', 'like', "%{$search}%");
            })
            ->get();

        return view('fichas_tecnicas.list', compact('fichas', 'search'));
    }

    public function create()
    {
        // Apenas sofás que ainda não têm ficha técnica (relação 1:1)
        $sofas = Sofa::whereDoesntHave('fichaTecnica')->orderBy('modelo')->get();
        return view('fichas_tecnicas.form', compact('sofas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sofa_id'          => 'required|exists:sofas,id|unique:fichas_tecnicas,sofa_id',
            'tecido'           => 'required|max:100',
            'peso'             => 'required|numeric|min:1',
            'dimensoes'        => 'required|max:100',
            'garantia_meses'   => 'required|integer|min:1|max:120',
            'densidade_espuma' => 'nullable|max:100',
        ]);

        FichaTecnica::create($request->all());

        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica cadastrada com sucesso!');
    }

    public function edit(FichaTecnica $ficha)
    {
        // Inclui sofás livres + o sofá atual desta ficha
        $sofas = Sofa::whereDoesntHave('fichaTecnica')
            ->orWhere('id', $ficha->sofa_id)
            ->orderBy('modelo')
            ->get();

        return view('fichas_tecnicas.form', compact('ficha', 'sofas'));
    }

    public function update(Request $request, FichaTecnica $ficha)
    {
        $request->validate([
            'sofa_id'          => 'required|exists:sofas,id|unique:fichas_tecnicas,sofa_id,' . $ficha->id,
            'tecido'           => 'required|max:100',
            'peso'             => 'required|numeric|min:1',
            'dimensoes'        => 'required|max:100',
            'garantia_meses'   => 'required|integer|min:1|max:120',
            'densidade_espuma' => 'nullable|max:100',
        ]);

        $ficha->update($request->all());

        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica atualizada com sucesso!');
    }

    public function destroy(FichaTecnica $ficha)
    {
        $ficha->delete();
        return redirect()->route('fichas.index')->with('success', 'Ficha Técnica removida com sucesso!');
    }
}
