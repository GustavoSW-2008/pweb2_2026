<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = [
            [
                'razao_social'  => 'Estofados Herval Indústria e Comércio Ltda',
                'nome_fantasia' => 'Herval Estofados',
                'cnpj'          => '91.325.478/0001-90',
                'email_contato' => 'comercial@herval.com.br',
                'telefone'      => '(51) 3564-8000',
            ],
            [
                'razao_social'  => 'Plumatex Colchões e Estofados da Amazônia S.A.',
                'nome_fantasia' => 'Plumatex Sofás',
                'cnpj'          => '02.418.992/0001-14',
                'email_contato' => 'atendimento@plumatex.com.br',
                'telefone'      => '(62) 3272-1500',
            ],
            [
                'razao_social'  => 'Indústria de Móveis e Estofados Chapecó Eireli',
                'nome_fantasia' => 'Estofados Chapecó',
                'cnpj'          => '14.887.321/0001-65',
                'email_contato' => 'vendas@estofadoschapeco.com.br',
                'telefone'      => '(49) 3328-4000',
            ],
            [
                'razao_social'  => 'Mobiliart Design & Conforto Móveis Ltda',
                'nome_fantasia' => 'Mobiliart Móveis',
                'cnpj'          => '23.654.120/0001-33',
                'email_contato' => 'contato@mobiliart.com.br',
                'telefone'      => '(47) 3275-9900',
            ],
            [
                'razao_social'  => 'Sul Estofados Indústria Moveleira Ltda',
                'nome_fantasia' => 'Sul Estofados',
                'cnpj'          => '33.109.842/0001-77',
                'email_contato' => 'pedidos@sulestofados.com.br',
                'telefone'      => '(49) 3361-2200',
            ],
        ];

        foreach ($fornecedores as $forn) {
            Fornecedor::create($forn);
        }
    }
}
