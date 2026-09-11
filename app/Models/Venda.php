<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model {
    use HasFactory;
    protected $fillable = ['cliente_id', 'sofa_id', 'data_venda'];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function sofa() {
        return $this->belongsTo(Sofa::class);
    }
}
