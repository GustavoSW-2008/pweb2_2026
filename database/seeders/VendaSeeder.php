<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Sofa;

class VendaSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = Cliente::all();
        $sofas = Sofa::all();

        if ($clientes->isEmpty() || $sofas->isEmpty()) {
            return;
        }

        $vendas = [
            [
                'cliente_id' => $clientes[0]->id,
                'sofa_id' => $sofas[0]->id,
                'data_venda' => '2026-09-15',
                'quantidade' => 1,
                'valor_total' => $sofas[0]->preco * 1,
                'forma_pagamento' => 'Cartão de Crédito',
            ],
            [
                'cliente_id' => $clientes[1]->id,
                'sofa_id' => $sofas[1]->id,
                'data_venda' => '2026-09-18',
                'quantidade' => 1,
                'valor_total' => $sofas[1]->preco * 1,
                'forma_pagamento' => 'PIX',
            ],
            [
                'cliente_id' => $clientes[2]->id,
                'sofa_id' => $sofas[2]->id,
                'data_venda' => '2026-09-22',
                'quantidade' => 2,
                'valor_total' => $sofas[2]->preco * 2,
                'forma_pagamento' => 'Boleto Bancário',
            ],
            [
                'cliente_id' => $clientes[3]->id,
                'sofa_id' => $sofas[3]->id,
                'data_venda' => '2026-10-02',
                'quantidade' => 1,
                'valor_total' => $sofas[3]->preco * 1,
                'forma_pagamento' => 'PIX',
            ],
            [
                'cliente_id' => $clientes[4]->id,
                'sofa_id' => $sofas[4]->id,
                'data_venda' => '2026-10-08',
                'quantidade' => 1,
                'valor_total' => $sofas[4]->preco * 1,
                'forma_pagamento' => 'Cartão de Crédito',
            ],
            [
                'cliente_id' => $clientes[0]->id,
                'sofa_id' => $sofas[5]->id,
                'data_venda' => '2026-10-12',
                'quantidade' => 1,
                'valor_total' => $sofas[5]->preco * 1,
                'forma_pagamento' => 'PIX',
            ],
        ];

        foreach ($vendas as $venda) {
            Venda::create($venda);
        }
    }
}
