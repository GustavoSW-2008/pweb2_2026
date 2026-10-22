<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Retrátil e Reclinável',
                'descricao' => 'Sofás com assento extensível e encosto com múltiplos níveis de inclinação para máximo conforto.',
            ],
            [
                'nome' => 'Sofá de Canto (Em L)',
                'descricao' => 'Modelos em formato L ideais para otimizar espaço e acomodar toda a família.',
            ],
            [
                'nome' => 'Sofá-Cama',
                'descricao' => 'Práticos e versáteis, transformam-se facilmente em cama para visitas.',
            ],
            [
                'nome' => 'Sofá Fixo Tradicional',
                'descricao' => 'Design clássico e elegante com estrutura fixa, ideal para salas de estar formais.',
            ],
            [
                'nome' => 'Sofá Modular',
                'descricao' => 'Módulos independentes que permitem configurar o layout de acordo com o ambiente.',
            ],
        ];

        foreach ($categorias as $cat) {
            Categoria::create($cat);
        }
    }
}
