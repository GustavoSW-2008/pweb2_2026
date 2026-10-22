<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sofa extends Model
{
    use HasFactory;

    protected $table = 'sofas';

    protected $fillable = [
        'fornecedor_id',
        'modelo',
        'cor',
        'preco',
        'quantidade_estoque',
        'imagem',
    ];

    public function fornecedor()
    {
        return $this->belongsTo(Fornecedor::class);
    }

    public function fichaTecnica()
    {
        return $this->hasOne(FichaTecnica::class);
    }

    public function vendas()
    {
        return $this->belongsToMany(Venda::class, 'sofa_venda')
            ->withPivot('quantidade', 'preco_unitario')
            ->withTimestamps();
    }
}
