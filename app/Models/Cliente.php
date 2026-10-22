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

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }
}
