<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Sofás em Estoque</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
            padding: 8px;
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
        .text-right {
            text-align: right;
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
        <p>Relatório de Sofás Cadastrados e Saldo em Estoque</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;" class="text-center">#</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
                <th class="text-right">Preço</th>
                <th class="text-center" style="width: 60px;">Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sofas as $index => $sofa)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td><strong>{{ $sofa->modelo }}</strong></td>
                <td>{{ $sofa->cor }}</td>
                <td>{{ $sofa->categoria->nome ?? '-' }}</td>
                <td>{{ $sofa->fornecedor->nome_fantasia ?? '-' }}</td>
                <td class="text-right">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
                <td class="text-center">{{ $sofa->quantidade_estoque }} un</td>
            </tr>
            @endforeach
            <tr class="total-box">
                <td colspan="5" class="text-right">Total Geral em Estoque:</td>
                <td class="text-right">R$ {{ number_format($sofas->sum('preco'), 2, ',', '.') }}</td>
                <td class="text-center">{{ $sofas->sum('quantidade_estoque') }} un</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Gerado em: {{ $data }} | Total de registros: {{ count($sofas) }}
    </div>

</body>
</html>
