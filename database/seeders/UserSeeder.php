<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $objetoUsuario = \App\Models\User::create([
            'name' => 'admin',
            'lastname' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'status' => 1,
            'role_id' => 1
        ]);
        $objetoUsuario->save();
        //2
        $objetoUsuario = \App\Models\User::create([
            'name' => 'operario',
            'lastname' => 'operario',
            'email' => 'operario@operario.com',
            'password' => bcrypt('123456'),
            'status' => 1,
            'role_id' => 2
        ]);
        $objetoUsuario->save();
    }
}
