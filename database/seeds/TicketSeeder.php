<?php

use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tickets')->insert([
            'ticket_code' => 'WHENTHETIME',
            'date_needed' => '2020-09-25',
            'date_returned' => '2020-09-30',
            'status_id' => 1,
            'user_id' => 1,
        ]);
    }
}
