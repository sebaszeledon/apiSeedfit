<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $type = new \App\Models\Type();
        $type->description = 'Entrada';
        $type->save();
        //2
        $type = new \App\Models\Type();
        $type->description = 'Salida';
        $type->save();
    }
}
