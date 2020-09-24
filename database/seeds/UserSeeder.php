<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

        	'name' => 'Mary',
        	'email' => 'meow@email.com',
        	'password' => Hash::make('maryber123'),
        	'role_id' => 1
        ]);


        DB::table('users')->insert([

        	'name' => 'Sheng',
        	'email' => 'meisheng@email.com',
        	'password' => Hash::make('maryber123'),
        	'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => Hash::make('test12345'),
            'role_id' => 2
        ]);

        DB::table('users')->insert([
            'name' => 'User2',
            'email' => 'user2@email.com',
            'password' => Hash::make('test12345'),
            'role_id' => 2
        ]);
    }
}
