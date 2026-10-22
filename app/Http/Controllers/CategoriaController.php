<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Listagem com busca funcional (?search=)
    public function index(Request $request)
    {
        $search = $request->search;

        $categorias = Categoria::when($search, function ($query) use ($search) {
            $query->where('nome', 'like', "%{$search}%");
        })->orderBy('nome')->get();

        return view('categorias.list', compact('categorias', 'search'));
    }

    public function create()
    {
        return view('categorias.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|max:100',
            'descricao' => 'nullable|max:255',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrada com sucesso!');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.form', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome'      => 'required|max:100',
            'descricao' => 'nullable|max:255',
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        // Impede remoção se houver sofás vinculados
        if ($categoria->sofas()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('error', 'Não é possível remover a categoria pois há sofás vinculados a ela!');
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria removida com sucesso!');
    }
}
