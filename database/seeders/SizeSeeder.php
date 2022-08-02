<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $size = new \App\Models\Size();
        $size->description = 'Small';
        $size->save();
        //2
        $size = new \App\Models\Size();
        $size->description = 'Medium';
        $size->save();
        //3
        $size = new \App\Models\Size();
        $size->description = 'Large';
        $size->save();
        //4
        $size = new \App\Models\Size();
        $size->description = 'Extra-Large';
        $size->save();
    }
}
