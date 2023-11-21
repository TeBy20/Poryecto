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
        Schema::create('aparcamientos', function (Blueprint $table) {
            $table->id();
            $table->string('placa_vehiculo');
            $table->string('codigo');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->time('hora_salida')->nullable();
            $table->date('fecha_entrada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->integer('tiempo_estancia')->default(0);
            $table->string('monto_total')->nullable();


            $table->foreign('placa_vehiculo')->references('placa_vehiculo')->on('vehiculos')->onDelete('cascade');
            $table->foreign('codigo')->references('codigo')->on('vehiculos')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparcamientos');
    }
};
