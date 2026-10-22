<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nome'            => 'Ana Carolina Ferreira',
                'cpf'             => '123.456.789-01',
                'telefone'        => '(49) 99812-3456',
                'email'           => 'ana.ferreira@gmail.com',
                'data_nascimento' => '1992-05-14',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Lucas Gabriel de Souza',
                'cpf'             => '234.567.890-12',
                'telefone'        => '(49) 98845-6789',
                'email'           => 'lucas.souza@hotmail.com',
                'data_nascimento' => '1988-11-23',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Mariana Silveira Ramos',
                'cpf'             => '345.678.901-23',
                'telefone'        => '(49) 99123-7890',
                'email'           => 'mariana.ramos@outlook.com',
                'data_nascimento' => '1995-02-18',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Rafael Mendonça Ribeiro',
                'cpf'             => '456.789.012-34',
                'telefone'        => '(49) 99934-5678',
                'email'           => 'rafael.ribeiro@yahoo.com.br',
                'data_nascimento' => '1981-08-30',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Juliana Beatriz Santos',
                'cpf'             => '567.890.123-45',
                'telefone'        => '(49) 98412-9012',
                'email'           => 'juliana.santos@gmail.com',
                'data_nascimento' => '1999-07-09',
                'imagem'          => null,
            ],
        ];

        foreach ($clientes as $cli) {
            Cliente::create($cli);
        }
    }
}
