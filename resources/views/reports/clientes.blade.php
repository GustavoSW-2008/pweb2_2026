<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Clientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1a3a5c;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #1a3a5c;
            font-size: 20px;
            margin: 0;
        }
        .header p {
            margin: 4px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 7px;
            text-align: left;
        }
        th {
            background-color: #1a3a5c;
            color: #fff;
            font-weight: bold;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-center {
            text-align: center;
        }
        .footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 11px;
            color: #777;
            text-align: right;
        }
        .total-box {
            font-weight: bold;
            background-color: #eef2f7;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Pausa Sofás - Sistema de Gestão</h1>
        <p>Relatório de Clientes Cadastrados</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 25px;" class="text-center">#</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Endereço (Cidade/Bairro)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $index => $cliente)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $cliente->nome }}</strong></td>
                <td>{{ $cliente->cpf }}</td>
                <td>{{ $cliente->telefone }}</td>
                <td>{{ $cliente->email }}</td>
                <td>{{ date('d/m/Y', strtotime($cliente->data_nascimento)) }}</td>
                <td>
                    @if($cliente->endereco)
                        {{ $cliente->endereco->cidade }} - {{ $cliente->endereco->bairro }} ({{ $cliente->endereco->rua }}, {{ $cliente->endereco->numero }})
                    @else
                        <em>Não informado</em>
                    @endif
                </td>
            </tr>
            @endforeach
            <tr class="total-box">
                <td colspan="6">Total de Clientes Cadastrados:</td>
                <td class="text-center">{{ count($clientes) }} clientes</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Gerado em: {{ $data }} | Total de registros: {{ count($clientes) }}
    </div>

</body>
</html>
