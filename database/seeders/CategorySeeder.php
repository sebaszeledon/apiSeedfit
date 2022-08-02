<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $category = new \App\Models\Category();
        $category->description = 'Tops';
        $category->save();
        //2
        $category = new \App\Models\Category();
        $category->description = 'Bikers';
        $category->save();
        //3
        $category = new \App\Models\Category();
        $category->description = 'Licras';
        $category->save();
    }
}
