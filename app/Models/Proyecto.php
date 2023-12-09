<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    protected $fillable = ['jefe_proyecto_id', 'jefe_calidad_id', 'codigo', 'nombre', 'descripcion', 'estado'];

    public function jefeproyecto() {
        return $this->hasOne('App\Models\User', 'id', 'jefe_proyecto_id');
    }
    public function jefecalidad() {
        return $this->hasOne('App\Models\User', 'id', 'jefe_calidad_id');
    }
}
