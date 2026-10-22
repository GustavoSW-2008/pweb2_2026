<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sofa extends Model
{
    use HasFactory;

    protected $table = 'sofas';

    protected $fillable = [
        'categoria_id',
        'fornecedor_id',
        'modelo',
        'cor',
        'preco',
        'quantidade_estoque',
        'imagem',
    ];

    // Relacionamento 1:N (Sofá pertence a uma Categoria)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relacionamento 1:N (Sofá pertence a um Fornecedor)
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }
}