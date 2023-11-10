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
            $table->unsignedBigInteger('id_vehiculo');
            $table->dateTime('fecha_hora_entrada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('fecha_hora_salida');
            $table->string('monto_a_pagar');
            $table->string('tiempo_estancia');
            
    
            $table->foreign('id_vehiculo')
                    ->references('id')
                    ->on('vehiculos')
                    ->onDelete('cascade');


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
