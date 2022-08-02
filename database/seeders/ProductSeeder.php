<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de product 1
        $product = new \App\Models\Product();
        $product->name = 'Rosa Negra';
        $product->code = '100-101';
        $product->cost = 5000;
        $product->price = 8000;
        $product->image = "http://127.0.0.1:8000/images/rosa.jpg";
        $product->save();
        //Agregar categories, sizes, storages, providers, transactions
        $product->categories()->attach([1]);
        $product->sizes()->attach([1, 2, 3]);
        //$product->storages()->attach([1]);
        $product->providers()->attach([1]);
        //$product->transactions()->attach([1]);

        //Instancia de product 2
        $product = new \App\Models\Product();
        $product->name = 'Prímula';
        $product->code = '100-102';
        $product->cost = 4000;
        $product->price = 7500;
        $product->image = "http://127.0.0.1:8000/images/primula.jpg";
        $product->save();
        //Agregar categories, sizes, storages, providers, transactions
        $product->categories()->attach([1]);
        $product->sizes()->attach([1, 2]);
        //$product->storages()->attach([2]);
        $product->providers()->attach([1]);
        //$product->transactions()->attach([1]);
    }
}
