<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status', function(Blueprint $table){
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        // Inserir os tipos automaticamente
        DB::table('status')->insert([
            ['id' => 1, 'status' => 'Desenvolvimento', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'status' => 'Concluído', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'status' => 'Cancelado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status');
    }
};
