<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(StorageSeeder::class);
        $this->call(TransactionSeeder::class);
    }
}
