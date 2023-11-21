<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediopago extends Model
{
    use HasFactory;
    
    protected $fillable = ['nombre_mediopago'];

    // INNER JOIN con la tabla Productos
    // por medio de la FK categoria_id
    public function aparcamientos()
    {
        return $this->hasMany(Aparcamiento::class, 'nombre_mediopago');
    }
}
