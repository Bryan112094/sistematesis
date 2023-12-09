<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialRequerimientoFechaTentativa extends Model
{
    use HasFactory;
    protected $fillable = ['requerimiento_id', 'fecha_antigua', 'fecha_nueva', 'descripcion'];
}
