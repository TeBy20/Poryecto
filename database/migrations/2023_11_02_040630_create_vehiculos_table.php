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
    Schema::create('vehiculos', function (Blueprint $table) {
        $table->id();
        $table->string('placa_vehiculo')->unique();
        $table->unsignedBigInteger('categoria_id');
        $table->date('fecha_entrada')->default(now()->toDateString());
        $table->time('hora_entrada')->default(now()->toTimeString());
        $table->string('codigo', 6)->unique();
        $table->enum('estado', ['estacionado', 'retirado'])->default('estacionado');

        $table->foreign('categoria_id')
            ->references('id')
            ->on('categorias')
            ->onDelete('cascade');


        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
