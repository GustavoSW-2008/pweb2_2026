<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sofa;

class SofaSeeder extends Seeder
{
    public function run(): void
    {
        $sofas = [
            [
                'categoria_id'       => 1, // Retrátil e Reclinável
                'fornecedor_id'      => 1, // Herval
                'modelo'             => 'Sofá Sevilha 3 Lugares Retrátil',
                'cor'                => 'Cinza Chumbo',
                'preco'              => 2899.90,
                'quantidade_estoque' => 8,
                'imagem'             => null,
            ],
            [
                'categoria_id'       => 1, // Retrátil e Reclinável
                'fornecedor_id'      => 3, // Estofados Chapecó
                'modelo'             => 'Sofá Veneza 4 Lugares Retrátil Molas Ensacadas',
                'cor'                => 'Bege Claro',
                'preco'              => 3499.00,
                'quantidade_estoque' => 5,
                'imagem'             => null,
            ],
            [
                'categoria_id'       => 2, // Canto
                'fornecedor_id'      => 2, // Plumatex
                'modelo'             => 'Sofá de Canto Madri com Chaise',
                'cor'                => 'Azul Marinho',
                'preco'              => 3999.50,
                'quantidade_estoque' => 4,
                'imagem'             => null,
            ],
            [
                'categoria_id'       => 3, // Sofá-Cama
                'fornecedor_id'      => 4, // Mobiliart
                'modelo'             => 'Sofá-Cama Versátil Click Clack',
                'cor'                => 'Grafite',
                'preco'              => 1899.00,
                'quantidade_estoque' => 12,
                'imagem'             => null,
            ],
            [
                'categoria_id'       => 4, // Fixo Tradicional
                'fornecedor_id'      => 5, // Sul Estofados
                'modelo'             => 'Sofá Chesterfield Couro Ecológico 3 Lugares',
                'cor'                => 'Marrom Conhaque',
                'preco'              => 4590.00,
                'quantidade_estoque' => 3,
                'imagem'             => null,
            ],
            [
                'categoria_id'       => 5, // Modular
                'fornecedor_id'      => 1, // Herval
                'modelo'             => 'Sofá Modular Aspen 5 Módulos',
                'cor'                => 'Off White',
                'preco'              => 5200.00,
                'quantidade_estoque' => 6,
                'imagem'             => null,
            ],
        ];

        foreach ($sofas as $sofa) {
            Sofa::create($sofa);
        }
    }
}
