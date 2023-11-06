<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatricesTable extends Migration
{
    public function up()
    {
        Schema::create('matrices', function (Blueprint $table) {
            $table->id();
            $table->integer('filas');
            $table->integer('columnas');
            // Genera dinámicamente las columnas basadas en filas y columnas
            for ($i = 1; $i <= 50; $i++) {  // Puedes ajustar el límite según tus necesidades
                $table->string("celda_$i")->nullable();
            }
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('matrices');
    }
}
