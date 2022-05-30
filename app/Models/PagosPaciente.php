<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosPaciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPaciente',
        'idServicio',
        'precio',
        'observacion',
        'metodoPago',
        'fecha_generacion',
        'estado',
    ];

    public function paciente()
    {
        return $this->hasOne(User::class, 'id', 'idPaciente');
    }

    public function servicio()
    {
        return $this->hasOne(Servicios::class, 'id', 'idServicio');
    }
}
