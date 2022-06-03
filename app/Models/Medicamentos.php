<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamentos extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'precio_unidad',
        'precio_empaque',
        'cantidad_unidades_empaque',
        'stock_unidades',
        'stock_empaque',
        'presentacion',
    ];
}
