<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sofa extends Model {
    use HasFactory;
    protected $fillable = ['modelo', 'cor', 'preco', 'fornecedor_id'];

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }
}