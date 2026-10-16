<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Sofás - Pausa Sofás</title>
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
        .footer {
            margin-top: 30px;
            font-size: 10px;
            color: #999;
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Pausa Sofás — Relatório de Sofás Cadastrados</h1>
    <div class="meta">
        Data de emissão: {{ $data }} &nbsp;|&nbsp; Total de registros: {{ count($sofas) }}
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Modelo</th>
                <th>Cor</th>
                <th>Fornecedor</th>
                <th>Ficha Técnica</th>
                <th class="text-right">Preço</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sofas as $sofa)
            <tr>
                <td>{{ $sofa->id }}</td>
                <td>{{ $sofa->modelo }}</td>
                <td>{{ $sofa->cor }}</td>
                <td>{{ $sofa->fornecedor->nome ?? '-' }}</td>
                <td>{{ $sofa->fichaTecnica->tecido ?? 'Não cadastrada' }}</td>
                <td class="text-right">R$ {{ number_format($sofa->preco, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Pausa Sofás — Sistema de Gestão — Documento gerado automaticamente
    </div>

</body>
</html>
