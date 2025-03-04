<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'title' => 'event one',
            'description' => 'description one',
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(7)->addHours(5),
        ]);
        Event::create([
            'title' => 'event two',
            'description' => 'description two',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(10)->addHours(8),
        ]);
        Event::create([
            'title' => 'event three',
            'description' => 'description three',
            'start_date' => now()->addDays(15),
            'end_date' => now()->addDays(15)->addHours(5),
        ]);
        Event::create([
            'title' => 'event four',
            'description' => 'description four',
            'start_date' => now()->addDays(15),
            'end_date' => now()->addDays(15)->addHours(5),
        ]);
        Event::create([
            'title' => 'event five',
            'description' => 'description five',
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(10)->addHours(5),
        ]);
    }
}
