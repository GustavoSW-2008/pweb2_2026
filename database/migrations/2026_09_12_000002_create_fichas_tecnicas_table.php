<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('fichas_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sofa_id')->unique()->constrained('sofas')->onDelete('cascade');
            $table->string('tecido');
            $table->decimal('peso', 8, 2);
            $table->string('dimensoes');
            $table->integer('garantia_meses')->default(12);
            $table->string('densidade_espuma')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('fichas_tecnicas');
    }
};
