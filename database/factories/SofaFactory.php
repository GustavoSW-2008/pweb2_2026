<?php

namespace Database\Factories;

use App\Models\Sofa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sofa>
 */
class SofaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
    return [
        'modelo' => 'Sofá ' . $this->faker->word(),
        'cor' => $this->faker->colorName(),
        'preco' => $this->faker->randomFloat(2, 800, 5000),
    ];
    }
}
