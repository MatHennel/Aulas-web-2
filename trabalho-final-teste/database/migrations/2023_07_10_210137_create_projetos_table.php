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
        Schema::create('projetos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->text('descricao');
            $table->double('valor', 10, 2);
            $table->date('dataEntrega');

            // Cliente que criou o projeto
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');

            // Dev selecionado (opcional)
            $table->unsignedBigInteger('dev_selecionado_id')->nullable();
            $table->foreign('dev_selecionado_id')->references('id')->on('users')->onDelete('set null');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projetos');
    }
};
