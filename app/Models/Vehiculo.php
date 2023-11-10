<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;
use App\Models\Aparcamiento;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = ['placa_vehiculo', 'categoria_id', 'fecha_hora_entrada', 'codigo']; // Agrega 'codigo' a $fillable

    protected static function boot()
    {
        parent::boot();

        // Agrega un evento al crear un nuevo vehículo para generar automáticamente el código
        static::creating(function ($vehiculo) {
            $vehiculo->codigo = strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));
        });
    }

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function aparcamientos()
    {
        return $this->hasMany(Aparcamiento::class, 'id_vehiculo');
    }
}

