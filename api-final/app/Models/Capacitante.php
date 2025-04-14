<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capacitante extends Model
{
    protected $fillable = [
        'cedula',
        'nombre_completo',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'genero',
        'email',
        'telefono',
        'direccion',
        'qr_code',
        'fecha_registro',
        'estado',
        'otros_datos',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_registro' => 'datetime',
    ];
}
