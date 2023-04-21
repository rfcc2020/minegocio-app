<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Robinson Cuzco',
            'email' => 'ingrcuzco'.'@gmail.com',
            'password' => Hash::make('rfcc2023'),
        ]);
    }
}
