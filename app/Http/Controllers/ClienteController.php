<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $clientes = Cliente::when($search, function ($query) use ($search) {
                $query->where('nome', 'like', "%{$search}%");
            })
            ->orderBy('nome')
            ->get();

        return view('clientes.list', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'            => 'required|max:255',
            'cpf'             => 'required|unique:clientes,cpf',
            'telefone'        => 'required|max:30',
            'email'           => 'required|email|max:255',
            'data_nascimento' => 'required|date',
            'imagem'          => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('clientes', 'public');
        }

        Cliente::create($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome'            => 'required|max:255',
            'cpf'             => 'required|unique:clientes,cpf,' . $cliente->id,
            'telefone'        => 'required|max:30',
            'email'           => 'required|email|max:255',
            'data_nascimento' => 'required|date',
            'imagem'          => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
                Storage::disk('public')->delete($cliente->imagem);
            }
            $dados['imagem'] = $request->file('imagem')->store('clientes', 'public');
        }

        $cliente->update($dados);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
            Storage::disk('public')->delete($cliente->imagem);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }

    public function relatorio()
    {
        $clientes = Cliente::orderBy('nome')->get();

        $data = [
            'title'    => 'Relatório de Clientes Cadastrados',
            'date'     => date('d/m/Y H:i'),
            'clientes' => $clientes,
        ];

        $pdf = Pdf::loadView('reports.clientes', $data);

        return $pdf->download('relatorio_clientes.pdf');
    }
}
