<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'data_nascimento',
        'imagem',
    ];

    // Relacionamento 1:1 (Um cliente tem um endereço)
    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}