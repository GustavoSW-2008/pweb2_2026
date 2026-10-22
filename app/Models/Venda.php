<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'cliente_id',
        'data_venda',
        'valor_total',
        'forma_pagamento',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function sofas()
    {
        return $this->belongsToMany(Sofa::class, 'sofa_venda')
            ->withPivot('quantidade', 'preco_unitario')
            ->withTimestamps();
    }
}
