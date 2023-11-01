<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mediopago extends Model
{
    use HasFactory;

    protected $table = "mediopago";
    protected $fillable = ['nombre_mediopago'];
}
