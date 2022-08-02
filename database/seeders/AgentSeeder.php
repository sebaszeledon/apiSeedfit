<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de agent 1
        $agent = new \App\Models\Agent();
        $agent->provider_id = 1;
        $agent->name = 'Frank';
        $agent->lastname = 'Wong';
        $agent->phone = '317-31715190';
        $agent->email = 'frank.wong@shein.com';
        $agent->save();

        //Instancia de agent 2
        $agent = new \App\Models\Agent();
        $agent->provider_id = 2;
        $agent->name = 'John';
        $agent->lastname = 'Smith';
        $agent->phone = '312-22909595';
        $agent->email = 'john.smith@amazon.com';
        $agent->save();
    }
}
