@extends('main')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Estoque de Sofás</h2>
        <a href="{{ route('sofas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Novo Sofá</a>
    </div>

    <!-- Campo de Busca -->
    <form action="{{ route('sofas.index') }}" method="GET" class="mb-4 flex">
        <input type="text" name="busca" value="{{ $busca ?? '' }}" placeholder="Buscar por modelo..." class="border border-gray-300 p-2 rounded-l w-full focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r hover:bg-gray-900">Buscar</button>
    </form>

    <!-- Tabela de Dados -->
    <div class="bg-white shadow-md rounded overflow-hidden">
        <table class="table-auto w-full text-left">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="p-3 border-b">ID</th>
                    <th class="p-3 border-b">Modelo</th>
                    <th class="p-3 border-b">Cor</th>
                    <th class="p-3 border-b">Preço</th>
                    <th class="p-3 border-b text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sofas as $sofa)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-b">{{ $sofa->id }}</td>
                    <td class="p-3 border-b">{{ $sofa->modelo }}</td>
                    <td class="p-3 border-b">{{ $sofa->cor }}</td>
                    <td class="p-3 border-b">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                    <td class="p-3 border-b text-center space-x-2">
                        <a href="{{ route('sofas.edit', $sofa->id) }}" class="text-yellow-600 hover:underline">Editar</a>
                        
                        <form action="{{ route('sofas.destroy', $sofa->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Tem certeza?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection