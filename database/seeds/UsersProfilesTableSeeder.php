<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profile_user')->insert([
            'profile_id' => '1',
            'user_id' => '1',
        ]);

        DB::table('profile_user')->insert([
        	'profile_id' => '2',
        	'user_id' => '2',
        ]);
    }
}
