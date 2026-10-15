<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar ?? $request->valor;

        $fornecedores = Fornecedor::when($buscar, function ($query) use ($buscar) {
            $query->where('nome', 'like', "%{$buscar}%")
                ->orWhere('cnpj', 'like', "%{$buscar}%")
                ->orWhere('email', 'like', "%{$buscar}%");
        })->withCount('sofas')->orderBy('nome')->get();

        return view('fornecedores.list', compact('fornecedores', 'buscar'));
    }

    public function create()
    {
        return view('fornecedores.form');
    }

    public function validateForm(Request $request, $id = null)
    {
        $uniqueCnpj = 'unique:fornecedores,cnpj' . ($id ? ",{$id}" : '');

        $request->validate([
            'nome' => 'required|max:255',
            'cnpj' => "required|{$uniqueCnpj}",
            'email' => 'required|email|max:255',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode exceder 255 caracteres.',
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado no sistema.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'Insira um endereço de e-mail válido (ex: contato@empresa.com).',
            'email.max' => 'O e-mail não pode exceder 255 caracteres.',
        ]);
    }

    public function store(Request $request)
    {
        $this->validateForm($request);

        Fornecedor::create($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    public function edit(Fornecedor $fornecedor)
    {
        return view('fornecedores.form', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedor $fornecedor)
    {
        $this->validateForm($request, $fornecedor->id);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    public function destroy(Fornecedor $fornecedor)
    {
        if ($fornecedor->sofas()->count() > 0) {
            return redirect()->route('fornecedores.index')->with(
                'error',
                "Não é possível remover o fornecedor {$fornecedor->nome}, pois existem sofás associados a ele!"
            );
        }

        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor removido com sucesso!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}