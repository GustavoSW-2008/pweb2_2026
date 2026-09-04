<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sofas', function (Blueprint $table) {
            $table->id();
            $table->string('modelo');
            $table->string('cor');
            $table->decimal('preco', 8, 2);
            $table->foreignId('fornecedor_id')->constrained('fornecedores')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('sofas'); }
};