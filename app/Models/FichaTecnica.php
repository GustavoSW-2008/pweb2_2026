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
        'altura',
        'largura',
        'profundidade',
        'tecido',
        'peso',
    ];

    public function sofa()
    {
        return $this->belongsTo(Sofa::class);
    }
}
