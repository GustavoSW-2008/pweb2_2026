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
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>Data de emissão: {{ $date }}</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 40px;" class="text-center">#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Data de Nascimento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $index => $cliente)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ date('d/m/Y', strtotime($cliente->data_nascimento)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="mt-3"><strong>Total de clientes cadastrados:</strong> {{ count($clientes) }}</p>
</body>
</html>
