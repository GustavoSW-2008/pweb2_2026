@extends('main')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Fichas Técnicas (Estoque)</h2>
    
    <!-- Busca (Requisito 4) -->
    <form action="{{ route('fichas.index') }}" method="GET" class="mb-4 flex">
        <input type="text" name="busca" value="{{ $busca }}" placeholder="Buscar por modelo ou tecido..." class="border p-2 rounded-l w-full">
        <button type="submit" class="bg-gray-800 text-white p-2 rounded-r">Buscar</button>
    </form>

    <table class="table-auto w-full bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">Sofá (Modelo)</th> <!-- Requisito 6: Nome em vez de ID -->
                <th class="p-2">Tecido</th>
                <th class="p-2">Peso</th>
                <th class="p-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fichas as $ficha)
            <tr class="text-center border-b">
                <td class="p-2">{{ $ficha->sofa->modelo }}</td> <!-- Acessando a relação -->
                <td class="p-2">{{ $ficha->tecido }}</td>
                <td class="p-2">{{ $ficha->peso }} kg</td>
                <td class="p-2">
                    <a href="#" class="text-blue-500">Editar</a>
                    <a href="#" class="text-red-500">Deletar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection