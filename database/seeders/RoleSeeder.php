<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = new \App\Models\Role();
        $rol->description = 'administrador';
        $rol->save();

        $rol = new \App\Models\Role();
        $rol->description = 'operario';
        $rol->save();
    }
}
