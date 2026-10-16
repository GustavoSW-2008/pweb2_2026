<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Vendas - Pausa Sofás</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #1a3a5c;
            font-size: 18px;
            margin-bottom: 5px;
        }
        .meta {
            color: #666;
            font-size: 11px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 7px 10px;
            text-align: left;
        }
        th {
            background-color: #1a3a5c;
            color: #fff;
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
        .total {
            margin-top: 15px;
            background-color: #f1f5f9;
            padding: 10px 15px;
            border-left: 4px solid #198754;
        }
        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Pausa Sofás — Relatório Geral de Vendas</h1>
    <div class="meta">
        Data de emissão: {{ $data }} &nbsp;|&nbsp; Total de vendas: {{ count($vendas) }}
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Sofá</th>
                <th class="text-center">Qtd</th>
                <th>Pagamento</th>
                <th class="text-right">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vendas as $venda)
            <tr>
                <td class="text-center">{{ $venda->id }}</td>
                <td>{{ date('d/m/Y', strtotime($venda->data_venda)) }}</td>
                <td>{{ $venda->cliente->nome ?? '-' }}</td>
                <td>{{ $venda->sofa->modelo ?? '-' }}</td>
                <td class="text-center">{{ $venda->quantidade }}</td>
                <td>{{ $venda->forma_pagamento }}</td>
                <td class="text-right"><strong>R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <strong>Faturamento Total:</strong> R$ {{ number_format($totalGeral, 2, ',', '.') }}
        em {{ count($vendas) }} vendas.
    </div>

    <div class="footer">
        Pausa Sofás — Sistema de Gestão — Documento gerado automaticamente
    </div>

</body>
</html>
