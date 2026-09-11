<?php
namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory {
    public function definition(): array {
        return [
            'nome' => fake()->name(),
            'cpf' => fake()->numerify('###.###.###-##'),
            'telefone' => fake()->phoneNumber(),
            'idade' => fake()->numberBetween(18, 70),
            'endereco' => fake()->address(),
        ];
    }
}