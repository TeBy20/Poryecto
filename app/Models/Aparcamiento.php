<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparcamiento extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_salida', 'hora_salida','fecha_salida', 'hora_salida', 'timepo_estancia', 'monto_a_pagar', 'placa_vehiculo', 'codigo', 'categoria_id'];

    // Relación con la tabla Vehiculo (uno a uno)
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }


}
