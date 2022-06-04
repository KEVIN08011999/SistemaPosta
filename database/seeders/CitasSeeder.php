<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'last_name' => 'Admin',
            'document' => 00000,
            'email' => 'admin',
            'user' => 'admin',
            'password' => 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3',
            'telefono' => 00000,
            'rol_id' => 1,
        ]);


        DB::table('empresas')->insert([
            'documento' => 00000000,
            'nombre' => 'EMPRESA',
            'correo' => 'admin',
            'web' => 'https://pagina.com',
            'password' => 'text-logo.png',
            'telefono' => 00000,
        ]);
    }
}
