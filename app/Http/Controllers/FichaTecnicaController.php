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
                $query->where('tecido', 'like', "%{$search}%")
                      ->orWhereHas('sofa', function ($q) use ($search) {
                          $q->where('modelo', 'like', "%{$search}%");
                      });
            })
            ->get();

        return view('fichas_tecnicas.list', compact('fichas', 'search'));
    }

    public function create()
    {
        $sofas = Sofa::doesntHave('fichaTecnica')->orderBy('modelo')->get();
        return view('fichas_tecnicas.form', compact('sofas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sofa_id'      => 'required|exists:sofas,id|unique:fichas_tecnicas,sofa_id',
            'altura'       => 'required|numeric|min:0',
            'largura'      => 'required|numeric|min:0',
            'profundidade' => 'required|numeric|min:0',
            'tecido'       => 'required|max:255',
            'peso'         => 'required|numeric|min:0',
        ]);

        FichaTecnica::create($request->all());

        return redirect()->route('fichas-tecnicas.index')->with('success', 'Ficha técnica cadastrada com sucesso!');
    }

    public function edit(FichaTecnica $fichas_tecnica)
    {
        $sofas = Sofa::whereDoesntHave('fichaTecnica', function ($query) use ($fichas_tecnica) {
            $query->where('id', '!=', $fichas_tecnica->id);
        })->orWhere('id', $fichas_tecnica->sofa_id)->orderBy('modelo')->get();

        return view('fichas_tecnicas.form', compact('fichas_tecnica', 'sofas'));
    }

    public function update(Request $request, FichaTecnica $fichas_tecnica)
    {
        $request->validate([
            'sofa_id'      => 'required|exists:sofas,id|unique:fichas_tecnicas,sofa_id,' . $fichas_tecnica->id,
            'altura'       => 'required|numeric|min:0',
            'largura'      => 'required|numeric|min:0',
            'profundidade' => 'required|numeric|min:0',
            'tecido'       => 'required|max:255',
            'peso'         => 'required|numeric|min:0',
        ]);

        $fichas_tecnica->update($request->all());

        return redirect()->route('fichas-tecnicas.index')->with('success', 'Ficha técnica atualizada com sucesso!');
    }

    public function destroy(FichaTecnica $fichas_tecnica)
    {
        $fichas_tecnica->delete();

        return redirect()->route('fichas-tecnicas.index')->with('success', 'Ficha técnica removida com sucesso!');
    }
}