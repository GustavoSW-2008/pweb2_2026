<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sofa extends Model
{
    use HasFactory;

    protected $fillable = [
        'modelo',
        'cor',
        'preco',
        'fornecedor_id',
        'imagem',
    ];

    // Relacionamento 1:N com Fornecedor
    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    // Relacionamento 1:1 com Ficha Técnica
    public function fichaTecnica()
    {
        return $this->hasOne(FichaTecnica::class);
    }

    // Relacionamento 1:N com Vendas
    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}