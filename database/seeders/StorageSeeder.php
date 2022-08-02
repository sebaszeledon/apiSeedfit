<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        $storage1 = new \App\Models\Storage();
        $storage1->description = 'Estante 1';
        $storage1->save();
        //2
        $storage = new \App\Models\Storage();
        $storage->description = 'Estante 2';
        $storage->save();
        //3
        $storage = new \App\Models\Storage();
        $storage->description = 'Estante 3';
        $storage->save();

        //Agregar contenido en tabla pivot product_transaction
        $storage1->products()->attach([
            1 => ['quantity' => 8, 'limit' => 1],
            2 => ['quantity' => 8, 'limit' => 1]
        ]);
    }
}
