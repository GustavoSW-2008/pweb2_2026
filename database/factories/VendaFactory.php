<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory
{
    public function definition(): array
    {
        $pagamentos = ['PIX', 'Cartão de Crédito', 'Boleto Bancário', 'Dinheiro'];

        return [
            'cliente_id'      => Cliente::factory(),
            'data_venda'      => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'valor_total'     => 0,
            'forma_pagamento' => fake()->randomElement($pagamentos),
        ];
    }
}
