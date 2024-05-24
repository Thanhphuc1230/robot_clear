<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tp_about')->insert([
            [   
                'uuid' => Str::uuid(),
                'name_vn' => 'About Us',
                'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'avatar' => 'avatar1.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
}
