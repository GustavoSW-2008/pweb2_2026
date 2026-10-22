<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sofas', function (Blueprint $table) {
            $table->id();
            // Relacionamento 1:N com Categoria
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            // Relacionamento 1:N com Fornecedor
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->onDelete('cascade');
            $table->string('modelo');
            $table->string('cor');
            $table->decimal('preco', 10, 2);
            $table->integer('quantidade_estoque')->default(0);
            $table->string('imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sofas');
    }
};
