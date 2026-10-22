<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nome'            => fake()->name(),
            'cpf'             => fake()->unique()->numerify('###.###.###-##'),
            'telefone'        => fake()->cellphoneNumber(),
            'email'           => fake()->unique()->safeEmail(),
            'data_nascimento' => fake()->date('Y-m-d', '-18 years'),
            'imagem'          => null,
        ];
    }
}
