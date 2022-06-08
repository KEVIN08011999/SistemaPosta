<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->hasOne(User::class, 'id', 'idCliente');
    }

    public function detalle()
    {
        return $this->hasMany(RelacionVentas::class, 'idVenta', 'id');
    }
}
