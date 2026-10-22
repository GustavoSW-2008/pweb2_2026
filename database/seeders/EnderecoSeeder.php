<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Endereco;

class EnderecoSeeder extends Seeder
{
    public function run(): void
    {
        $enderecos = [
            [
                'cliente_id' => 1,
                'rua'        => 'Avenida Getúlio Dornelles Vargas',
                'numero'     => '1420',
                'bairro'     => 'Centro',
                'cidade'     => 'Chapecó',
                'cep'        => '89801-000',
            ],
            [
                'cliente_id' => 2,
                'rua'        => 'Rua Fernando Machado',
                'numero'     => '850',
                'bairro'     => 'São Cristóvão',
                'cidade'     => 'Chapecó',
                'cep'        => '89803-010',
            ],
            [
                'cliente_id' => 3,
                'rua'        => 'Rua Nereu Ramos',
                'numero'     => '321',
                'bairro'     => 'Efapi',
                'cidade'     => 'Chapecó',
                'cep'        => '89809-120',
            ],
            [
                'cliente_id' => 4,
                'rua'        => 'Rua Sete de Setembro',
                'numero'     => '560',
                'bairro'     => 'Passo dos Fortes',
                'cidade'     => 'Chapecó',
                'cep'        => '89805-100',
            ],
            [
                'cliente_id' => 5,
                'rua'        => 'Avenida Marechal Deodoro',
                'numero'     => '210',
                'bairro'     => 'Presidente Médici',
                'cidade'     => 'Chapecó',
                'cep'        => '89801-230',
            ],
        ];

        foreach ($enderecos as $end) {
            Endereco::create($end);
        }
    }
}
