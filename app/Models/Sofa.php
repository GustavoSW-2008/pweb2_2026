<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sofa extends Model {
    protected $fillable = ['modelo', 'cor', 'preco'];
    // Relacionamento 1:1 (Um para Um)
    public function fichaTecnica() {
        return $this->hasOne(FichaTecnica::class);
    }
}