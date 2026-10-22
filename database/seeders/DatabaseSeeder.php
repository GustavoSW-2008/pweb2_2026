<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;
use App\Models\Cliente;
use App\Models\Sofa;
use App\Models\FichaTecnica;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $fornecedores = [
            [
                'razao_social'  => 'Herval Móveis e Estofados S/A',
                'nome_fantasia' => 'Herval Estofados',
                'cnpj'          => '92.684.145/0001-80',
                'email_contato' => 'contato@herval.com.br',
                'telefone'      => '(51) 3564-8300',
            ],
            [
                'razao_social'  => 'Indústria Plumatex de Colchões e Estofados Ltda',
                'nome_fantasia' => 'Plumatex Chapecó',
                'cnpj'          => '01.234.567/0001-90',
                'email_contato' => 'vendas@plumatex.com.br',
                'telefone'      => '(49) 3328-1000',
            ],
            [
                'razao_social'  => 'Estofados Chapecó Indústria e Comércio Ltda',
                'nome_fantasia' => 'Estofados Chapecó',
                'cnpj'          => '12.345.678/0001-11',
                'email_contato' => 'comercial@estofadoschapeco.com.br',
                'telefone'      => '(49) 3322-5500',
            ],
            [
                'razao_social'  => 'Mobiliart Design & Conforto Eireli',
                'nome_fantasia' => 'Mobiliart Estofados',
                'cnpj'          => '98.765.432/0001-22',
                'email_contato' => 'atendimento@mobiliart.com.br',
                'telefone'      => '(54) 3451-9988',
            ],
            [
                'razao_social'  => 'Sul Estofados do Brasil Ltda',
                'nome_fantasia' => 'Sul Estofados',
                'cnpj'          => '45.678.901/0001-33',
                'email_contato' => 'sac@sulestofados.com.br',
                'telefone'      => '(49) 3329-7711',
            ],
        ];

        foreach ($fornecedores as $forn) {
            Fornecedor::create($forn);
        }

        $clientes = [
            [
                'nome'            => 'Lucas Gabriel Silveira',
                'cpf'             => '089.123.456-78',
                'telefone'        => '(49) 99912-3456',
                'email'           => 'lucas.silveira@email.com',
                'data_nascimento' => '1995-04-12',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Mariana Beatriz Zanin',
                'cpf'             => '078.234.567-89',
                'telefone'        => '(49) 99876-5432',
                'email'           => 'mariana.zanin@email.com',
                'data_nascimento' => '1998-09-23',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Carlos Eduardo Fontana',
                'cpf'             => '067.345.678-90',
                'telefone'        => '(49) 99123-7890',
                'email'           => 'carlos.fontana@email.com',
                'data_nascimento' => '1988-11-05',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Juliana Cristina Berti',
                'cpf'             => '056.456.789-01',
                'telefone'        => '(49) 98834-5678',
                'email'           => 'juliana.berti@email.com',
                'data_nascimento' => '2001-02-18',
                'imagem'          => null,
            ],
            [
                'nome'            => 'Roberto Schons Althaus',
                'cpf'             => '045.567.890-12',
                'telefone'        => '(49) 99945-6712',
                'email'           => 'roberto.althaus@email.com',
                'data_nascimento' => '1982-07-30',
                'imagem'          => null,
            ],
        ];

        foreach ($clientes as $cli) {
            Cliente::create($cli);
        }

        $sofas = [
            [
                'fornecedor_id'      => 1,
                'modelo'             => 'Sofá Sevilha 3 Lugares Retrátil',
                'cor'                => 'Cinza Chumbo',
                'preco'              => 2899.90,
                'quantidade_estoque' => 8,
                'imagem'             => 'sofas/sofa_1.jpg',
                'ficha'              => [
                    'altura'       => 1.05,
                    'largura'      => 2.30,
                    'profundidade' => 1.10,
                    'tecido'       => 'Suede Prime',
                    'peso'         => 68.00,
                ],
            ],
            [
                'fornecedor_id'      => 3,
                'modelo'             => 'Sofá Veneza 4 Lugares Molas Ensacadas',
                'cor'                => 'Bege Claro',
                'preco'              => 3499.00,
                'quantidade_estoque' => 5,
                'imagem'             => 'sofas/sofa_2.jpg',
                'ficha'              => [
                    'altura'       => 1.02,
                    'largura'      => 2.70,
                    'profundidade' => 1.15,
                    'tecido'       => 'Linho Nobre',
                    'peso'         => 82.50,
                ],
            ],
            [
                'fornecedor_id'      => 2,
                'modelo'             => 'Sofá de Canto Madri com Chaise',
                'cor'                => 'Azul Marinho',
                'preco'              => 3999.50,
                'quantidade_estoque' => 4,
                'imagem'             => 'sofas/sofa_3.jpg',
                'ficha'              => [
                    'altura'       => 0.98,
                    'largura'      => 2.90,
                    'profundidade' => 1.60,
                    'tecido'       => 'Veludo Soft',
                    'peso'         => 94.00,
                ],
            ],
            [
                'fornecedor_id'      => 4,
                'modelo'             => 'Sofá-Cama Versátil Click Clack',
                'cor'                => 'Grafite',
                'preco'              => 1899.00,
                'quantidade_estoque' => 12,
                'imagem'             => 'sofas/sofa_4.jpg',
                'ficha'              => [
                    'altura'       => 0.90,
                    'largura'      => 1.95,
                    'profundidade' => 0.95,
                    'tecido'       => 'Linho Nobre',
                    'peso'         => 48.00,
                ],
            ],
            [
                'fornecedor_id'      => 5,
                'modelo'             => 'Sofá Chesterfield Couro 3 Lugares',
                'cor'                => 'Marrom Conhaque',
                'preco'              => 4590.00,
                'quantidade_estoque' => 3,
                'imagem'             => 'sofas/sofa_5.jpg',
                'ficha'              => [
                    'altura'       => 0.85,
                    'largura'      => 2.20,
                    'profundidade' => 0.92,
                    'tecido'       => 'Couro Sintético',
                    'peso'         => 75.00,
                ],
            ],
            [
                'fornecedor_id'      => 1,
                'modelo'             => 'Sofá Modular Aspen 5 Módulos',
                'cor'                => 'Off White',
                'preco'              => 5200.00,
                'quantidade_estoque' => 6,
                'imagem'             => 'sofas/sofa_1.jpg',
                'ficha'              => [
                    'altura'       => 0.92,
                    'largura'      => 3.20,
                    'profundidade' => 1.10,
                    'tecido'       => 'Bouclé Alto Padrão',
                    'peso'         => 110.00,
                ],
            ],
        ];

        foreach ($sofas as $item) {
            $fichaData = $item['ficha'];
            unset($item['ficha']);

            $sofa = Sofa::create($item);
            $fichaData['sofa_id'] = $sofa->id;
            FichaTecnica::create($fichaData);
        }

        $vendas = [
            [
                'cliente_id'      => 1,
                'data_venda'      => '2026-03-15',
                'forma_pagamento' => 'Cartão de Crédito',
                'itens'           => [
                    ['sofa_id' => 1, 'quantidade' => 1, 'preco_unitario' => 2899.90],
                ],
            ],
            [
                'cliente_id'      => 2,
                'data_venda'      => '2026-05-20',
                'forma_pagamento' => 'PIX',
                'itens'           => [
                    ['sofa_id' => 2, 'quantidade' => 1, 'preco_unitario' => 3499.00],
                    ['sofa_id' => 4, 'quantidade' => 1, 'preco_unitario' => 1899.00],
                ],
            ],
            [
                'cliente_id'      => 3,
                'data_venda'      => '2026-07-10',
                'forma_pagamento' => 'Boleto Bancário',
                'itens'           => [
                    ['sofa_id' => 3, 'quantidade' => 2, 'preco_unitario' => 3999.50],
                ],
            ],
            [
                'cliente_id'      => 4,
                'data_venda'      => '2026-08-05',
                'forma_pagamento' => 'PIX',
                'itens'           => [
                    ['sofa_id' => 1, 'quantidade' => 2, 'preco_unitario' => 2899.90],
                    ['sofa_id' => 5, 'quantidade' => 1, 'preco_unitario' => 4590.00],
                ],
            ],
            [
                'cliente_id'      => 5,
                'data_venda'      => '2026-09-18',
                'forma_pagamento' => 'Cartão de Crédito',
                'itens'           => [
                    ['sofa_id' => 6, 'quantidade' => 1, 'preco_unitario' => 5200.00],
                ],
            ],
            [
                'cliente_id'      => 1,
                'data_venda'      => '2026-10-02',
                'forma_pagamento' => 'PIX',
                'itens'           => [
                    ['sofa_id' => 2, 'quantidade' => 1, 'preco_unitario' => 3499.00],
                ],
            ],
        ];

        foreach ($vendas as $v) {
            $itens = $v['itens'];
            unset($v['itens']);

            $total = 0;
            $pivot = [];
            foreach ($itens as $it) {
                $total += $it['preco_unitario'] * $it['quantidade'];
                $pivot[$it['sofa_id']] = [
                    'quantidade'     => $it['quantidade'],
                    'preco_unitario' => $it['preco_unitario'],
                ];
            }

            $v['valor_total'] = $total;
            $venda = Venda::create($v);
            $venda->sofas()->attach($pivot);
        }
    }
}
