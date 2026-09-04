<?php

namespace Database\Factories;

use App\Models\FichaTecnica;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FichaTecnica>
 */
class FichaTecnicaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
    return [
        'sofa_id' => \App\Models\Sofa::factory(),
        'tecido' => $this->faker->word(),
        'peso' => $this->faker->randomFloat(2, 20, 100),
    ];
    }
}
