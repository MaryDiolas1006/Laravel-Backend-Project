<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('categories')->insert([
            'name' => 'Mathematics'
        ]);

        DB::table('categories')->insert([
            'name' => 'English'
        ]);

        DB::table('categories')->insert([
            'name' => 'Science'
        ]);
    }
}
