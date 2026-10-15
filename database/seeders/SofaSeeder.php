<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sofa;
use App\Models\Fornecedor;

class SofaSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = Fornecedor::all();
        if ($fornecedores->isEmpty()) {
            return;
        }

        $sofas = [
            [
                'modelo' => 'Sofá Retrátil e Reclinável Sevilha 3 Lugares',
                'cor' => 'Cinza Chumbo',
                'preco' => 2899.90,
                'fornecedor_id' => $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_1.jpg',
            ],
            [
                'modelo' => 'Sofá Canto Living Florença 5 Lugares',
                'cor' => 'Bege Linho',
                'preco' => 4590.00,
                'fornecedor_id' => $fornecedores[1]->id ?? $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_2.jpg',
            ],
            [
                'modelo' => 'Sofá Chesterfield Clássico Veludo',
                'cor' => 'Verde Musgo',
                'preco' => 3850.50,
                'fornecedor_id' => $fornecedores[2]->id ?? $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_3.jpg',
            ],
            [
                'modelo' => 'Sofá Minimalista Nordic 2 Lugares',
                'cor' => 'Azul Marinho',
                'preco' => 2190.00,
                'fornecedor_id' => $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_4.jpg',
            ],
            [
                'modelo' => 'Sofá Cama Multifuncional Berlim',
                'cor' => 'Marrom Café',
                'preco' => 1950.00,
                'fornecedor_id' => $fornecedores[3]->id ?? $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_5.jpg',
            ],
            [
                'modelo' => 'Sofá Modular Capri Chaise Longue',
                'cor' => 'Terracota',
                'preco' => 5200.00,
                'fornecedor_id' => $fornecedores[1]->id ?? $fornecedores[0]->id,
                'imagem' => 'imagem/sofa/sofa_1.jpg',
            ],
        ];

        foreach ($sofas as $sofa) {
            Sofa::updateOrCreate(['modelo' => $sofa['modelo']], $sofa);
        }
    }
}
