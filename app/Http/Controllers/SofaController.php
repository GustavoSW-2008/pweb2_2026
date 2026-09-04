<?php
namespace App\Http\Controllers;
use App\Models\Sofa;
use App\Models\Fornecedor;
use Illuminate\Http\Request;

class SofaController extends Controller {
    public function index(Request $request) {
    $buscar = $request->buscar;
    $sofas = Sofa::with('fornecedor')->when($buscar, function($query) use ($buscar) {
        $query->where('modelo', 'like', "%{$buscar}%")
              ->orWhere('cor', 'like', "%{$buscar}%")
              ->orWhereHas('fornecedor', function($q) use ($buscar) {
                  $q->where('nome', 'like', "%{$buscar}%");
              });
    })->get();
    
    return view('sofas.list', compact('sofas', 'buscar'));
    }

    public function create() {
        $fornecedores = Fornecedor::all();
        return view('sofas.form', compact('fornecedores'));
    }

    public function store(Request $request) {
        $request->validate([
    'modelo' => 'required',
    'cor' => 'required',
    'preco' => 'required|numeric',
    'fornecedor_id' => 'required|exists:fornecedores,id'
    ], [
    'required' => 'O campo :attribute é obrigatório.',
    'numeric' => 'O campo preco deve ser um número válido.',
    'exists' => 'O fornecedor selecionado é inválido.'
    ]);
        Sofa::create($request->all());
        return redirect()->route('sofas.index');
    }

    public function edit(Sofa $sofa) {
        $fornecedores = Fornecedor::all();
        return view('sofas.form', compact('sofa', 'fornecedores'));
    }

    public function update(Request $request, Sofa $sofa) {
        $request->validate([
    'modelo' => 'required',
    'cor' => 'required',
    'preco' => 'required|numeric',
    'fornecedor_id' => 'required|exists:fornecedores,id'
    ], [
    'required' => 'O campo :attribute é obrigatório.',
    'numeric' => 'O campo preco deve ser um número válido.',
    'exists' => 'O fornecedor selecionado é inválido.'
    ]);
        Sofa::create($request->all());
        return redirect()->route('sofas.index');
    }


    public function destroy(Sofa $sofa) {
        $sofa->delete();
        return redirect()->route('sofas.index');
    }
}