<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->string('placa_vehiculo');
            $table->unsignedBigInteger('categoria_id');
            $table->date('fecha_entrada');
            $table->time('hora_entrada');
            $table->string('codigo', 6)->unique();

            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('cascade');

            $table->timestamps();
        });

        // Actualización para establecer valores por defecto
        DB::table('vehiculos')->update(['fecha_entrada' => now()->format('Y-m-d')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
