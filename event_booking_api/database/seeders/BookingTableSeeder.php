<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Booking::create([
            'user_id' => 3,
            'event_id' => 1,
            'ticket_qty' => 5,
            'ticket_price' => 1000,
        ]);
        Booking::create([
            'user_id' => 3,
            'event_id' => 2,
            'ticket_qty' => 4,
            'ticket_price' => 500,
        ]);
        Booking::create([
            'user_id' => 4,
            'event_id' => 2,
            'ticket_qty' => 2,
            'ticket_price' => 300,
        ]);
        Booking::create([
            'user_id' => 5,
            'event_id' => 3,
            'ticket_qty' => 5,
            'ticket_price' => 1000,
        ]);
        Booking::create([
            'user_id' => 5,
            'event_id' => 4,
            'ticket_qty' => 5,
            'ticket_price' => 2000,
        ]);
        Booking::create([
            'user_id' => 6,
            'event_id' => 5,
            'ticket_qty' => 3,
            'ticket_price' => 700,
        ]);
        Booking::create([
            'user_id' => 7,
            'event_id' => 4,
            'ticket_qty' => 5,
            'ticket_price' => 1000,
        ]);
        Booking::create([
            'user_id' => 5,
            'event_id' => 5,
            'ticket_qty' => 10,
            'ticket_price' => 20000,
        ]);
        Booking::create([
            'user_id' => 3,
            'event_id' => 3,
            'ticket_qty' => 5,
            'ticket_price' => 1000,
        ]);
    }
}
