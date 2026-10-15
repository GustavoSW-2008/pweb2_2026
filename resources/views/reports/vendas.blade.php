<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333333;
            margin: 20px;
        }
        .header {
            border-bottom: 2px solid #1a3a5c;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #1a3a5c;
            margin: 0;
            font-size: 20px;
        }
        .header .meta {
            color: #666666;
            font-size: 11px;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px 10px;
            text-align: left;
        }
        th {
            background-color: #1a3a5c;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
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
            margin-top: 30px;
            border-top: 1px solid #cccccc;
            padding-top: 10px;
            font-size: 10px;
            color: #777777;
            text-align: center;
        }
        .summary-box {
            margin-top: 20px;
            background-color: #f1f5f9;
            padding: 12px 15px;
            border-left: 4px solid #198754;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Pausa Sofás • {{ $titulo }}</h1>
        <div class="meta">
            <span><strong>Data de Emissão:</strong> {{ $data }}</span> &nbsp;|&nbsp;
            <span><strong>Total de Vendas:</strong> {{ count($dados) }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;" class="text-center">#</th>
                <th>Data</th>
                <th>Cliente</th>
                <th>Sofá (Modelo)</th>
                <th class="text-center">Qtd</th>
                <th>Forma de Pagto</th>
                <th class="text-right">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td>{{ \Carbon\Carbon::parse($item->data_venda)->format('d/m/Y') }}</td>
                <td>{{ $item->cliente->nome ?? 'Cliente não encontrado' }}</td>
                <td>{{ $item->sofa->modelo ?? 'Sofá não encontrado' }}</td>
                <td class="text-center">{{ $item->quantidade }}</td>
                <td>{{ $item->forma_pagamento }}</td>
                <td class="text-right"><strong>R$ {{ number_format($item->valor_total, 2, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <strong>Faturamento Geral Consolidado:</strong> R$ {{ number_format($totalGeral, 2, ',', '.') }} em {{ count($dados) }} pedidos registrados.
    </div>

    <div class="footer">
        Pausa Sofás - Sistema de Gestão e Controle • Documento gerado automaticamente para fins avaliativos.
    </div>

</body>
</html>
