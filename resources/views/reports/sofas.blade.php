<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>Data de emissão: {{ $date }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 40px;" class="text-center">#</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Tecido</th>
                <th>Fornecedor</th>
                <th class="text-right">Preço</th>
                <th class="text-center">Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sofas as $index => $sofa)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $sofa->modelo }}</td>
                <td>{{ $sofa->cor }}</td>
                <td>{{ $sofa->fichaTecnica->tecido ?? '-' }}</td>
                <td>{{ $sofa->fornecedor->nome_fantasia ?? '-' }}</td>
                <td class="text-right">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                <td class="text-center">{{ $sofa->quantidade_estoque }} un</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-3"><strong>Total de modelos listados:</strong> {{ count($sofas) }}</p>
</body>
</html>
