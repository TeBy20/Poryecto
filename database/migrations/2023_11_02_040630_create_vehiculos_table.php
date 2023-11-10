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
            $table->string('placa_vehiculo');
            $table->unsignedBigInteger('categoria_id');
            $table->dateTime('fecha_hora_entrada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('codigo', 6)->unique(); // Nuevo campo "codigo"

            $table->foreign('categoria_id')
                    ->references('id')
                    ->on('categorias')
                    ->onDelete('cascade');

            $table->timestamps();
        });

        // Actualización para establecer valores por defecto
        DB::table('vehiculos')->update(['fecha_hora_entrada' => now()]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};

