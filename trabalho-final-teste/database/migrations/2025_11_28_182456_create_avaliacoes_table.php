<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('projeto_id')->constrained()->onDelete('cascade');
        $table->foreignId('dev_id')->constrained('usuario')->onDelete('cascade');
        $table->foreignId('cliente_id')->constrained('usuario')->onDelete('cascade');
        $table->decimal('nota', 3, 1); // exemplo 7.5, 9.3, 10.0
        $table->text('descricao')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacoes');
    }
};
