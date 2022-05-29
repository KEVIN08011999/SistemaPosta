<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $fillable = [
        'idMedico',
        'idPaciente',
        'fecha',
        'idHorario',
        'observaciones'
    ];

    public function medico()
    {
        return $this->hasOne(User::class, 'id', 'idMedico');
    }

    public function paciente()
    {
        return $this->hasOne(User::class, 'id', 'idPaciente');
    }

    public function horario()
    {
        return $this->hasOne(BloquesHorarios::class, 'id', 'idHorario');
    }
}
