<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    use HasFactory;

    protected $fillable = ['accion_id', 'fecha_seguimiento', 'descripcion_avance', 'porcentaje_avance'];

    public function accion()
    {
        return $this->belongsTo(Accion::class);
    }
}

