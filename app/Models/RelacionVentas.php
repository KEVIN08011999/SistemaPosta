<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelacionVentas extends Model
{
    use HasFactory;

    protected $fillable = [
        'idVenta',
        'idProducto',
        'cantidad',
        'total',
        'tipo'
    ];

    public function producto()
    {
        return $this->hasOne(Medicamentos::class, 'id', 'idProducto');
    }
}
