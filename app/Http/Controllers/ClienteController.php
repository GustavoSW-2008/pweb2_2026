<?php
namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller {
    public function index(Request $request) {
    $buscar = $request->buscar;
    $clientes = Cliente::when($buscar, function($query) use ($buscar) {
        $query->where('nome', 'like', "%{$buscar}%")
              ->orWhere('cpf', 'like', "%{$buscar}%")
              ->orWhere('telefone', 'like', "%{$buscar}%")
              ->orWhere('endereco', 'like', "%{$buscar}%");
    })->get();
    
    return view('clientes.list', compact('clientes', 'buscar'));
    }

    public function create() {
        return view('clientes.form');
    }

    public function store(Request $request) {
        $request->validate([
        'nome' => 'required|max:255',
        'cpf' => 'required|unique:clientes,cpf,' . ($cliente->id ?? ''),
        'telefone' => 'required',
        'idade' => 'nullable|integer|min:0|max:150',
        'endereco' => 'nullable|max:255'
        ], [
        'required' => 'O campo :attribute é obrigatório.',
        'unique' => 'Este :attribute já está cadastrado no sistema.',
        'max' => 'O campo :attribute não pode ter mais que 255 caracteres.',
        'integer' => 'O campo :attribute deve ser um número inteiro.',
        'min' => 'O campo :attribute não pode ser negativo.'
        ]);
        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente salvo com sucesso!');
    }

    public function edit(Cliente $cliente) {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente) {
        $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|unique:clientes,cpf,'.$cliente->id,
            'telefone' => 'required',
            'idade' => 'nullable|integer|min:0|max:150',
            'endereco' => 'nullable|max:255'
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'unique' => 'Este :attribute já está cadastrado no sistema.',
            'max' => 'O campo :attribute não pode ter mais que 255 caracteres.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'min' => 'O campo :attribute não pode ser negativo.'
        ]);
        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente) {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Removido com sucesso!');
    }
}