<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de provider 1
        $provider = new \App\Models\Provider();
        $provider->description = 'Shein';
        $provider->website = 'www.shein.com';
        $provider->country = 'China';
        $provider->address = 'Shangai';
        $provider->save();

        //Instancia de provider 2
        $provider = new \App\Models\Provider();
        $provider->description = 'Amazon';
        $provider->website = 'www.amazon.com';
        $provider->country = 'USA';
        $provider->address = 'Chicago';
        $provider->save();
    }
}
