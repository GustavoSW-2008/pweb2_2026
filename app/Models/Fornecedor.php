<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedores';

    protected $fillable = [
        'razao_social',
        'nome_fantasia',
        'cnpj',
        'email_contato',
        'telefone',
    ];

    // Relacionamento 1:N (Um fornecedor tem muitos sofás)
    public function sofas()
    {
        return $this->hasMany(Sofa::class);
    }
}