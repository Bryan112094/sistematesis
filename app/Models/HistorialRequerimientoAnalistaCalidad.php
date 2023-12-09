<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialRequerimientoAnalistaCalidad extends Model
{
    use HasFactory;
    protected $fillable = ['requerimiento_id', 'analistas_antiguos', 'analistas_nuevos', 'descripcion'];
}