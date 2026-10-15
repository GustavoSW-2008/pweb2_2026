<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = [
            ['nome' => 'Estofados Requinte Ltda', 'cnpj' => '12.345.678/0001-90', 'email' => 'contato@requinteestofados.com.br'],
            ['nome' => 'Conforto & Arte Mobiliário', 'cnpj' => '23.456.789/0001-01', 'email' => 'vendas@confortoearte.com.br'],
            ['nome' => 'Belluno Design & Estofados', 'cnpj' => '34.567.890/0001-12', 'email' => 'comercial@bellunodesign.com.br'],
            ['nome' => 'Sul Móveis Estofados', 'cnpj' => '45.678.901/0001-23', 'email' => 'atendimento@sulmoveis.com.br'],
            ['nome' => 'Mestre dos Estofados Brasil', 'cnpj' => '56.789.012/0001-34', 'email' => 'suporte@mestredosestofados.com.br'],
        ];

        foreach ($fornecedores as $fornecedor) {
            Fornecedor::updateOrCreate(['cnpj' => $fornecedor['cnpj']], $fornecedor);
        }
    }
}
