<?php

namespace Database\Factories;

use App\Models\Fornecedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SofaFactory extends Factory
{
    public function definition(): array
    {
        $modelos = [
            'Sofá Sevilha Retrátil 3 Lugares',
            'Sofá Veneza Molas Ensacadas',
            'Sofá de Canto Madri com Chaise',
            'Sofá-Cama Versátil Click Clack',
            'Sofá Chesterfield Couro 3 Lugares',
            'Sofá Modular Aspen 5 Módulos',
            'Sofá Retrátil Florença 4 Lugares',
            'Sofá Living Roma 3 Lugares Fixo',
            'Sofá Milão Compacto 2 Lugares',
            'Sofá Reclinável Genebra Veludo',
        ];

        $cores = ['Cinza Chumbo', 'Bege Claro', 'Azul Marinho', 'Grafite', 'Marrom Conhaque', 'Off White', 'Terracota', 'Verde Oliva'];
        $imagens = ['sofas/sofa_1.jpg', 'sofas/sofa_2.jpg', 'sofas/sofa_3.jpg', 'sofas/sofa_4.jpg', 'sofas/sofa_5.jpg'];

        return [
            'fornecedor_id'      => Fornecedor::factory(),
            'modelo'             => fake()->randomElement($modelos),
            'cor'                => fake()->randomElement($cores),
            'preco'              => fake()->randomFloat(2, 1499, 4999),
            'quantidade_estoque' => fake()->numberBetween(3, 15),
            'imagem'             => fake()->randomElement($imagens),
        ];
    }
}
