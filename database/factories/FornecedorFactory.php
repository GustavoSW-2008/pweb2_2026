<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory
{
    public function definition(): array
    {
        return [
            'razao_social'  => fake()->company() . ' Indústria de Estofados Ltda',
            'nome_fantasia' => fake()->company(),
            'cnpj'          => fake()->unique()->numerify('##.###.###/0001-##'),
            'email_contato' => fake()->unique()->companyEmail(),
            'telefone'      => fake()->cellphoneNumber(),
        ];
    }
}
