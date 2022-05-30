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
    ];
}
