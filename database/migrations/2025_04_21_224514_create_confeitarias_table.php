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
        Schema::create('confeitarias', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 255);
            $table->string('cep', 8);
            $table->string('rua', 255);
            $table->string('numero', 10);
            $table->string('bairro', 100);
            $table->string('estado', 2);
            $table->string('cidade', 100);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('telefone', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('confeitarias');
    }
};
