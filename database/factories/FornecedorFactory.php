<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class FornecedorFactory extends Factory {
    public function definition(): array {
        return [
            'nome' => fake()->company(),
            'cnpj' => fake()->numerify('##.###.###/0001-##'),
            'email' => fake()->companyEmail(),
        ];
    }
}