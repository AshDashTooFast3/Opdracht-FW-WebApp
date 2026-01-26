<?php

namespace Database\Seeders;

use App\Models\TaakLabelKoppelingen;
use App\Models\Taken;
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

        Taken::factory(3)->create([
            'GebruikerId' => 1,
            'Titel' => 'Laravel oefenen',
            'Beschrijving' => 'Oefenen met Laravel framework',
            'Deadline' => now(),
            'Status' => 'Open',
        ]);

        // Ensure labels are created before linking them to tasks
        $this->call(LabelSeeder::class);

        TaakLabelKoppelingen::factory()->create(['TaakId' => 1, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 2, 'LabelId' => 2]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 3, 'LabelId' => 3]);

        $this->call([
            TakenSeeder::class,
            TaakLabelKoppelingSeeder::class,
        ]);
    }
}
