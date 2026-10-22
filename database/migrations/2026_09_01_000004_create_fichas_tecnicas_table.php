<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fichas_tecnicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sofa_id')->unique()->constrained('sofas')->onDelete('cascade');
            $table->decimal('altura', 8, 2);
            $table->decimal('largura', 8, 2);
            $table->decimal('profundidade', 8, 2);
            $table->string('tecido');
            $table->decimal('peso', 8, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fichas_tecnicas');
    }
};
