<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparcamiento extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_hora_entrada', 'fecha_hora_salida', 'monto_a_pagar', 'tiempo_estancia', 'propietario'];

    // Relación con la tabla Vehiculo (uno a uno)
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }


}
