<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            ['nome' => 'Ana Clara Santos', 'cpf' => '111.222.333-44', 'telefone' => '(49) 99887-1122', 'idade' => 28, 'endereco' => 'Rua das Flores, 120, Centro', 'imagem' => null],
            ['nome' => 'Bruno Henrique Lima', 'cpf' => '222.333.444-55', 'telefone' => '(49) 99123-4567', 'idade' => 35, 'endereco' => 'Av. Brasil, 450, Jardim Itália', 'imagem' => null],
            ['nome' => 'Camila Rodrigues Alves', 'cpf' => '333.444.555-66', 'telefone' => '(49) 98877-6655', 'idade' => 42, 'endereco' => 'Rua XV de Novembro, 890, Centro', 'imagem' => null],
            ['nome' => 'Diego Fernando Costa', 'cpf' => '444.555.666-77', 'telefone' => '(49) 99911-2233', 'idade' => 31, 'endereco' => 'Rua Marechal Deodoro, 305, Efapi', 'imagem' => null],
            ['nome' => 'Eduarda Meireles Souza', 'cpf' => '555.666.777-88', 'telefone' => '(49) 99188-7744', 'idade' => 24, 'endereco' => 'Av. Getúlio Vargas, 1420, Passo dos Fortes', 'imagem' => null],
            ['nome' => 'Felipe Augusto Oliveira', 'cpf' => '666.777.888-99', 'telefone' => '(49) 98433-2211', 'idade' => 39, 'endereco' => 'Rua Uruguai, 67, Santa Maria', 'imagem' => null],
        ];

        foreach ($clientes as $cliente) {
            Cliente::updateOrCreate(['cpf' => $cliente['cpf']], $cliente);
        }
    }
}
