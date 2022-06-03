<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'user',
        'rol_id',
        'password',
        'email',
        'photo',
        'telefono',
        'document',
        'idServicio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function servicio()
    {
        return $this->hasOne(Servicios::class, 'id', 'idServicio');
    }

    public function citas()
    {
        return $this->hasOne(Citas::class, 'idPaciente', 'id');
    }

    public function citas_data()
    {
        return $this->hasMany(Citas::class, 'idPaciente', 'id');
    }
}
