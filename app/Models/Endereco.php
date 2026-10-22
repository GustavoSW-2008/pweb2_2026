<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'enderecos';

    protected $fillable = [
        'cliente_id',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'cep',
    ];

    // Relacionamento 1:1 (Endereço pertence a um cliente)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
