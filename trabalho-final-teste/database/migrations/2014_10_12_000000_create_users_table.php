<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('tipo_usuario');
            $table->foreign('tipo_usuario')->references('id')->on('tipos_usuarios');
            $table->rememberToken();
            $table->timestamps();

            // Campos adicionais Dev / Cliente
            $table->string('cpfOuCep')->nullable();      // Cliente
            $table->date('dataNascimento')->nullable();  // Desenvolvedor
            $table->text('descricao')->nullable();       // Desenvolvedor
            $table->string('empresa')->nullable();       // Cliente
            $table->date('dataCriacao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
            $table->float('avaliacao')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
