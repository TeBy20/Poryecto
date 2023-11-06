<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categorias;
use App\Models\Aparcamiento;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = ['nombre_modelo', 'propietario', 'categoria_id']; // Agrega las columnas específicas de Vehículos

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function aparcamientos()
    {
        return $this->hasMany(Aparcamiento::class, 'id_vehiculo');
    }
}
