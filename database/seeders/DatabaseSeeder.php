<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('achraf1532'),
        ]);

        $this->call([
            LabelSeeder::class,
            TakenSeeder::class,
            WeekReflectiesSeeder::class,
            TaakLabelKoppelingSeeder::class,
        ]);
    }
}
