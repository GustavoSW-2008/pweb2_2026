<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichaTecnica extends Model {
    protected $fillable = ['sofa_id', 'tecido', 'peso'];
    // Relacionamento 1:1 (Um para Um)
    public function sofa() {
        return $this->belongsTo(Sofa::class);
    }
}