<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nome',
        'descricao',
    ];

    // Relacionamento 1:N (Uma categoria tem muitos sofás)
    public function sofas()
    {
        return $this->hasMany(Sofa::class);
    }
}
