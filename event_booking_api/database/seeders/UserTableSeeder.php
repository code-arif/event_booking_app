<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'App Admin',
            'role' => 'app admin',
            'email' => 'app_admin@admin.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Event Admin',
            'role' => 'event admin',
            'email' => 'event_admin@admin.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Ariful',
            'role' => 'user',
            'email' => 'ariful@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'mohammad',
            'role' => 'user',
            'email' => 'mohammad@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Sejid',
            'role' => 'user',
            'email' => 'sajid@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Roni',
            'role' => 'user',
            'email' => 'roni@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Tasin',
            'role' => 'user',
            'email' => 'tasin@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Rzul',
            'role' => 'user',
            'email' => 'rzul@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Hasem',
            'role' => 'user',
            'email' => 'hasem@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'Nur',
            'role' => 'user',
            'email' => 'nur@gmail.com',
            'password' => Hash::make('1111'),
        ]);
        User::create([
            'name' => 'jisan',
            'role' => 'user',
            'email' => 'jisan@gmail.com',
            'password' => Hash::make('1111'),
        ]);
    }
}
