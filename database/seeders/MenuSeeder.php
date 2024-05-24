<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'uuid' => Str::uuid(),
                'name_vn' => 'Trang Chủ',
                'name_en' => 'Home',
                'link' => '',
                'slug' => 'trang-chu',
                'type' => 'link',
                'parent_id' => 0, // Assuming this is the top-level menu
                'object_id' => 0, // Assuming the object ID of the homepage is 1
                'stt' => 1, // Assuming the order is 1
            ],
            [
                'uuid' => Str::uuid(),
                'name_vn' => 'Liên Hệ',
                'name_en' => 'Contact',
                'link' => 'lien-he',
                'slug' => 'lien-he',
                'type' => 'link',
                'parent_id' => 0, // Assuming this is the top-level menu
                'object_id' => 0, // Assuming the object ID of the contact page is 2
                'stt' => 2, // Assuming the order is 2
            ],
            // Add more menu items as needed
        ];
        
        DB::table('tp_menu')->insert($menus);
        
    }
}
