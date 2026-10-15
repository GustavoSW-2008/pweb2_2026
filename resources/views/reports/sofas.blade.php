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
            padding: 10px 15px;
            border-left: 4px solid #1a3a5c;
            font-size: 11px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Pausa Sofás • {{ $titulo }}</h1>
        <div class="meta">
            <span><strong>Data de Emissão:</strong> {{ $data }}</span> &nbsp;|&nbsp;
            <span><strong>Total de Registros:</strong> {{ count($dados) }}</span>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;" class="text-center">#</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Fornecedor</th>
                <th>Tecido (Ficha 1:1)</th>
                <th class="text-right">Preço Unitário</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $item)
            <tr>
                <td class="text-center">{{ $item->id }}</td>
                <td><strong>{{ $item->modelo }}</strong></td>
                <td>{{ $item->cor }}</td>
                <td>{{ $item->fornecedor->nome ?? '-' }}</td>
                <td>{{ $item->fichaTecnica->tecido ?? 'Não cadastrada' }}</td>
                <td class="text-right">R$ {{ number_format($item->preco, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary-box">
        <strong>Resumo Executivo:</strong> Foram listados {{ count($dados) }} modelos de sofás.
        Preço médio do catálogo: R$ {{ count($dados) > 0 ? number_format($dados->avg('preco'), 2, ',', '.') : '0,00' }}.
    </div>

    <div class="footer">
        Pausa Sofás - Sistema de Gestão e Controle • Documento gerado automaticamente para fins avaliativos.
    </div>

</body>
</html>
