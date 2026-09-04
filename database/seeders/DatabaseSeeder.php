<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void {
    \App\Models\Fornecedor::factory(10)->create();
    \App\Models\FichaTecnica::factory(10)->create(); // O FichaTecnicaFactory já cria o Sofá automaticamente por causa da relação
    }
}
