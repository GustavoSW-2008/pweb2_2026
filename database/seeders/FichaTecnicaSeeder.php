<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FichaTecnica;
use App\Models\Sofa;

class FichaTecnicaSeeder extends Seeder
{
    public function run(): void
    {
        $sofas = Sofa::all();

        $dadosFichas = [
            [
                'tecido' => 'Linho Sintético Impermeável',
                'peso' => 68.50,
                'dimensoes' => '2.30m x 1.05m x 0.95m',
                'garantia_meses' => 24,
                'densidade_espuma' => 'D-33 Soft + Molas Ensacadas',
            ],
            [
                'tecido' => 'Linho Bouclé Importado',
                'peso' => 95.00,
                'dimensoes' => '3.10m x 2.20m x 0.90m',
                'garantia_meses' => 36,
                'densidade_espuma' => 'D-30 Hiper Soft',
            ],
            [
                'tecido' => 'Veludo Italiano Capitonê',
                'peso' => 74.00,
                'dimensoes' => '2.15m x 0.95m x 0.85m',
                'garantia_meses' => 24,
                'densidade_espuma' => 'D-28 Firme',
            ],
            [
                'tecido' => 'Suede Animale Resistente',
                'peso' => 45.00,
                'dimensoes' => '1.70m x 0.88m x 0.85m',
                'garantia_meses' => 12,
                'densidade_espuma' => 'D-26 Confort',
            ],
            [
                'tecido' => 'Couro Ecológico Premium',
                'peso' => 58.00,
                'dimensoes' => '1.90m x 0.98m x 0.92m',
                'garantia_meses' => 12,
                'densidade_espuma' => 'D-33 Ortopédica',
            ],
            [
                'tecido' => 'Veludo Molhado',
                'peso' => 88.00,
                'dimensoes' => '2.80m x 1.60m x 0.95m',
                'garantia_meses' => 36,
                'densidade_espuma' => 'D-33 com Pillow Top',
            ],
        ];

        foreach ($sofas as $index => $sofa) {
            if (isset($dadosFichas[$index])) {
                FichaTecnica::updateOrCreate(
                    ['sofa_id' => $sofa->id],
                    array_merge($dadosFichas[$index], ['sofa_id' => $sofa->id])
                );
            }
        }
    }
}
