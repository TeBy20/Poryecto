<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaTable extends Migration
{
    public function up()
    {
        Schema::create('caja', function (Blueprint $table) {
            $table->id();
            $table->string('motivos_accion');
            $table->decimal('monto', 10, 2);
            $table->dateTime('fecha');
            $table->string('tipo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('caja');
    }
}
