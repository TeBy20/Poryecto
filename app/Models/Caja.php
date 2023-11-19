<?php

// app/Models/Caja.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'caja'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'motivos_accion',
        'monto',
        'fecha',
        'hora', // Agregado para reflejar el campo 'hora' en la migración
        'tipo',
    ];

}