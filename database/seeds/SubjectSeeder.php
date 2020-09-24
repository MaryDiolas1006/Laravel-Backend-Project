<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
            'name' => 'Algebra',
            'available_stocks' => 0,
            'total_stocks' => 0,
            'image' => 'https://via.placeholder.com/150/',
            'category_id' => 1
        ]);

        DB::table('subjects')->insert([
            'name' => 'English Level-1',
            'available_stocks' => 0,
            'total_stocks' => 0,
            'image' => 'https://via.placeholder.com/150/',
            'category_id' => 2
        ]);

        DB::table('subjects')->insert([
            'name' => 'Biology',
            'available_stocks' => 0,
            'total_stocks' => 0,
            'image' => 'https://via.placeholder.com/150/',
            'category_id' => 3
        ]);
    }
}
