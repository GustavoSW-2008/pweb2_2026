<?php

namespace Database\Factories;

use App\Models\Sofa;
use Illuminate\Database\Eloquent\Factories\Factory;

class FichaTecnicaFactory extends Factory
{
    public function definition(): array
    {
        $tecidos = ['Linho Nobre', 'Veludo Soft', 'Couro Sintético', 'Suede Prime', 'Bouclé Alto Padrão'];

        return [
            'sofa_id'      => Sofa::factory(),
            'altura'       => fake()->randomFloat(2, 0.85, 1.10),
            'largura'      => fake()->randomFloat(2, 1.80, 3.10),
            'profundidade' => fake()->randomFloat(2, 0.90, 1.65),
            'tecido'       => fake()->randomElement($tecidos),
            'peso'         => fake()->randomFloat(2, 45, 95),
        ];
    }
}
