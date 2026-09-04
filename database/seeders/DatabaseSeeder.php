<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Fornecedor;
use App\Models\Sofa;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        Cliente::factory(10)->create();
        $fornecedores = Fornecedor::factory(5)->create();
        
        foreach ($fornecedores as $fornecedor) {
            Sofa::factory(3)->create(['fornecedor_id' => $fornecedor->id]);
        }
    }
}