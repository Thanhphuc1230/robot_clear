<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tp_system')->insert([
            'email' => 'sample@email.com',
            'address' => 'Sample Address',
            'hotline' => '123-456-7890',
            'footer' => 'Sample Footer',
            'link_facebook' => 'https://facebook.com/sample',
            'link_youtube' => 'https://youtube.com/sample',
            'link_twitter' => 'https://twitter.com/sample',
            'link_instagram' => 'https://instagram.com/sample',
            'link_zalo' => 'https://zalo.com/sample',
            'favicon' => 'path/to/favicon.ico',
            'logo' => 'path/to/logo.png',
            'meta_name' => 'Sample Meta Name',
            'meta_description' => 'Sample Meta Description',
            'meta_keyword' => 'Sample, Keywords',
            'header_js' => 'Sample header JS script',
            'body_js' => 'Sample body JS script',
            'footer_js' => 'Sample footer JS script',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
