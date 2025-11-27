<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projeto_dev', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projeto_id');
            $table->unsignedBigInteger('dev_id');
            $table->timestamps();

            // Relacionamentos
            $table->foreign('projeto_id')->references('id')->on('projetos')->onDelete('cascade');
            $table->foreign('dev_id')->references('id')->on('usuario')->onDelete('cascade');

            // Evita duplicação do mesmo dev em um projeto
            $table->unique(['projeto_id', 'dev_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projeto_dev');
    }
};
