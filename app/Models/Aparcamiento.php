<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aparcamiento extends Model
{
    use HasFactory;

    protected $fillable = ['fecha_hora_entrada', 'fecha_hora_salida', 'monto_a_pagar', 'tiempo_estancia', 'estado', 'propietario'];

    // Relación con la tabla Vehiculo (uno a uno)
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo');
    }

    // Relación con la tabla Zona (uno a uno)
    public function zona()
    {
        return $this->belongsTo(Zonas::class, 'id_zona');
    }
}
