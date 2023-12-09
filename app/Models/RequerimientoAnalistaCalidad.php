<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequerimientoAnalistaCalidad extends Model
{
    use HasFactory;
    protected $fillable = ['requerimiento_id', 'analista_calidad_id'];

    public function analistacalidad() {
        return $this->hasOne('App\Models\User', 'id', 'analista_calidad_id');
    }
}
