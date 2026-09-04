<?php
namespace Database\Factories;
use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SofaFactory extends Factory {
    public function definition(): array {
    $cores = ['Cinza', 'Preto', 'Marrom', 'Bege', 'Azul Marinho', 'Vermelho', 'Verde Musgo'];
    
    return [
        'modelo' => fake()->word() . ' Premium',
        'cor' => fake()->randomElement($cores),
        'preco' => fake()->randomFloat(2, 500, 5000),
        'fornecedor_id' => \App\Models\Fornecedor::factory(),
    ];
}
}