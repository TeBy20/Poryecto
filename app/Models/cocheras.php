<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cocheras extends Model
{
    use HasFactory;

    protected $fillable = ['num_lugar', 'piso', 'disponible'];


}
