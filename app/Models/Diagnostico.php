<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCita',
        'idTriaje',
        'idPaciente',
        'motivo',
        'antecedentes',
        'tiempo_enfermedad',
        'alergias',
        'intervenciones',
        'vacunas',
        'examen',
        'diagostico',
        'tratamiento',
        'tipo_diagnostico',
        'estado'
    ];

    public function cita()
    {
        return $this->hasOne(Citas::class, 'id', 'idCita');
    }

    public function triaje()
    {
        return $this->hasOne(Triaje::class, 'id', 'idTriaje');
    }
}
