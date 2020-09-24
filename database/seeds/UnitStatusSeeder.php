<?php

use Illuminate\Database\Seeder;

class UnitStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_statuses')->insert([
            'name' => 'Available'
        ]);

        DB::table('unit_statuses')->insert([
            'name' => 'Not Available'
        ]);

    }
}
