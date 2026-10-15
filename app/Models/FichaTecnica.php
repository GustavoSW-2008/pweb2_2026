<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model
{
    use HasFactory;

    protected $table = 'fichas_tecnicas';

    protected $fillable = [
        'sofa_id',
        'tecido',
        'peso',
        'dimensoes',
        'garantia_meses',
        'densidade_espuma',
    ];

    // Relacionamento 1:1 (Um para Um)
    public function sofa()
    {
        return $this->belongsTo(Sofa::class);
    }
}