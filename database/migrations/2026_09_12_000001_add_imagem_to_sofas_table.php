<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('sofas', function (Blueprint $table) {
            $table->string('imagem')->nullable()->after('fornecedor_id');
        });
    }

    public function down(): void {
        Schema::table('sofas', function (Blueprint $table) {
            $table->dropColumn('imagem');
        });
    }
};
