<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Vendas - Pausa Sofás</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .cabecalho {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 10px;
        }
        .cabecalho h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #2c3e50;
            color: white;
            font-weight: bold;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .rodape {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="cabecalho">
        <h1>Pausa Sofás</h1>
        <h2>Relatório Geral de Vendas</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Data da Venda</th>
                <th>Cliente</th>
                <th>Sofá (Modelo)</th>
                <th class="text-right">Valor Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendas as $venda)
            <tr>
                <td class="text-center">{{ $venda->id }}</td>
                <!-- Formata a data (ex: 22/10/2026) -->
                <td>{{ date('d/m/Y', strtotime($venda->created_at)) }}</td>
                <!-- Verifica se o cliente existe, se não, exibe 'Não informado' -->
                <td>{{ $venda->cliente->nome ?? 'Não informado' }}</td>
                <td>{{ $venda->sofa->modelo ?? 'Não informado' }}</td>
                <!-- Formata o valor para o padrão Real Brasileiro -->
                <td class="text-right">R$ {{ number_format($venda->valor_total, 2, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Nenhuma venda registrada no sistema.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="rodape">
        <p>Relatório gerado em: {{ date('d/m/Y \à\s H:i') }}</p>
    </div>

</body>
</html>