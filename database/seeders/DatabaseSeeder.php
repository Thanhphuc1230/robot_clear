<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();
        // Call UserSeeder
        $this->call(UserSeeder::class);
        
        // Call MenuSeeder
        $this->call(MenuSeeder::class);
        
        // Call SystemSeeder
        $this->call(SystemSeeder::class);
    }
}
