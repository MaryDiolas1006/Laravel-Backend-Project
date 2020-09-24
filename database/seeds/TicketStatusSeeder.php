<?php

use Illuminate\Database\Seeder;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_statuses')->insert([
            'name' => 'Pending'
        ]);

        DB::table('ticket_statuses')->insert([
            'name' => 'Approved'
        ]);

        DB::table('ticket_statuses')->insert([
            'name' => 'Declined'
        ]);

        DB::table('ticket_statuses')->insert([
            'name' => 'Completed'
        ]);
    }
}
