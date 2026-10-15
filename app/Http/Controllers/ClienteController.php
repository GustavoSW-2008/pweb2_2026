<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->buscar ?? $request->valor;

        $clientes = Cliente::when($buscar, function ($query) use ($buscar) {
            $query->where('nome', 'like', "%{$buscar}%")
                ->orWhere('cpf', 'like', "%{$buscar}%")
                ->orWhere('telefone', 'like', "%{$buscar}%")
                ->orWhere('endereco', 'like', "%{$buscar}%");
        })->orderBy('nome')->get();

        return view('clientes.list', compact('clientes', 'buscar'));
    }

    public function create()
    {
        return view('clientes.form');
    }

    public function validateForm(Request $request, $id = null)
    {
        $uniqueCpf = 'unique:clientes,cpf' . ($id ? ",{$id}" : '');

        $request->validate([
            'nome' => 'required|max:255',
            'cpf' => "required|{$uniqueCpf}",
            'telefone' => 'required|max:30',
            'idade' => 'nullable|integer|min:0|max:150',
            'endereco' => 'nullable|max:255',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode exceder 255 caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está cadastrado no sistema.',
            'telefone.required' => 'O campo telefone é obrigatório.',
            'idade.integer' => 'A idade deve ser um número inteiro.',
            'idade.min' => 'A idade não pode ser negativa.',
            'idade.max' => 'Idade inválida.',
            'imagem.image' => 'O arquivo enviado deve ser uma imagem válida.',
            'imagem.mimes' => 'A imagem deve estar no formato PNG, JPG, JPEG ou WEBP.',
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
            $diretorio = 'imagem/cliente/';
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Cliente::create($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.form', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $this->validateForm($request, $cliente->id);

        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            // Remove a imagem antiga se existir
            if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
                Storage::disk('public')->delete($cliente->imagem);
            }

            $nome_imagem = date('YmdiHs') . '_' . uniqid() . '.' . $imagem->getClientOriginalExtension();
            $diretorio = 'imagem/cliente/';
            $imagem->storeAs($diretorio, $nome_imagem, 'public');
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        $cliente->update($data);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        // Se o cliente possui vendas vinculadas
        if ($cliente->vendas()->count() > 0) {
            return redirect()->route('clientes.index')->with('error', "Não é possível remover o(a) cliente {$cliente->nome}, pois existem vendas associadas a ele(a)!");
        }

        // Exclui o arquivo de imagem do storage
        if ($cliente->imagem && Storage::disk('public')->exists($cliente->imagem)) {
            Storage::disk('public')->delete($cliente->imagem);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente removido com sucesso!');
    }

    public function search(Request $request)
    {
        return $this->index($request);
    }
}