@extends('main') <!-- Usando o layout base do seu projeto -->

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-4">Nova Ficha Técnica</h2>

    <form action="{{ route('fichas.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        <!-- Requisito 6: Usar select no formulário mostrando o NOME em vez do ID -->
        <div class="mb-4">
            <label class="block text-gray-700">Selecione o Sofá</label>
            <select name="sofa_id" class="form-select w-full border border-gray-300 rounded p-2" required>
                <option value="">Escolha um sofá...</option>
                @foreach($sofas as $sofa)
                    <option value="{{ $sofa->id }}">{{ $sofa->modelo }} (Cor: {{ $sofa->cor }})</option>
                @endforeach
            </select>
            @error('sofa_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Tecido</label>
            <input type="text" name="tecido" value="{{ old('tecido') }}" class="form-input w-full border border-gray-300 rounded p-2" required>
            @error('tecido') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Peso (kg)</label>
            <input type="number" step="0.01" name="peso" value="{{ old('peso') }}" class="form-input w-full border border-gray-300 rounded p-2" required>
            @error('peso') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar Ficha</button>
    </form>
</div>
@endsection