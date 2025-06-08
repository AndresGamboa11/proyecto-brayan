<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    
    protected $table = 'autos'; // Asegúrate de que coincida con tu tabla

    protected $fillable = ['marca', 'modelo', 'descripcion', 'precio', 'imagen'];


}
