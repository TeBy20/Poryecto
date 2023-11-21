<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zonas extends Model
{
    use HasFactory;
    protected $fillable = ['nombre_zona', 'capacidad', 'piso_zona'];

    public function aparcamientos()
    {
        return $this->hasMany(Aparcamiento::class, 'id_zona');
    }
}

