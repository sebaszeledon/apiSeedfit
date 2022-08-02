<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de customer 1
        $customer = new \App\Models\Customer();
        $customer->name = 'Valeria';
        $customer->lastname = 'Muñoz';
        $customer->email = 'valemumo@gmail.com';
        $customer->save();

        //Instancia de customer 2
        $customer = new \App\Models\Customer();
        $customer->name = 'Fabiola';
        $customer->lastname = 'Chacón';
        $customer->email = 'fabi@gmail.com';
        $customer->save();
    }
}
