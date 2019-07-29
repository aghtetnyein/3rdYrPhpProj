<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insert([
            'user_id' => '1',
            'title' => 'MD.Admin',
            'url' => 'https://admin.mm.com',
            'image' => 'avatar1.png',
            'about' => 'im admin',
        ]);

        DB::table('profiles')->insert([
        	'user_id' => '2',
        	'title' => 'MD.Author',
        	'url' => 'https://author.mm.com',
        	'image' => 'avatar1.png',
        	'about' => 'im author',
        ]);
    }
}
