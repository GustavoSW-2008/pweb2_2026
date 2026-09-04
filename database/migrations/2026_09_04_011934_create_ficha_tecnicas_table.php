<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('ficha_tecnicas', function (Blueprint $table) {
        $table->id();
        // foreignId unique garante o relacionamento 1:1 no banco
        $table->foreignId('sofa_id')->unique()->constrained('sofas')->onDelete('cascade');
        $table->string('tecido');
        $table->decimal('peso', 8, 2);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ficha_tecnicas');
    }
};
