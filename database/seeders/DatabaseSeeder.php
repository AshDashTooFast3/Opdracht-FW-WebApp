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
        //admin gebruiker aanmaken
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('achraf1532'),
        ]);

        //taken voor vandaag aanmaken
        Taken::factory(3)->create([
            'GebruikerId' => 1,
            'Titel' => 'Laravel oefenen',
            'Beschrijving' => 'Oefenen met Laravel framework',
            'Deadline' => now(),
            'Status' => 'Open',
        ]);

        //taken voor morgen aanmaken
        Taken::factory(3)->create([
            'GebruikerId' => 1,
            'Titel' => 'PHP oefenen',
            'Beschrijving' => 'Oefenen met PHP taal',
            'Deadline' => now()->addDay(),
            'Status' => 'Open',
        ]);

        // voorkomt forein key constraint errors
        $this->call(LabelSeeder::class);

        // data voor taken voor vandaag in het koppel tabel
        TaakLabelKoppelingen::factory()->create(['TaakId' => 1, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 2, 'LabelId' => 2]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 3, 'LabelId' => 3]);

        // data voor taken voor morgen in het koppel tabel
        TaakLabelKoppelingen::factory()->create(['TaakId' => 4, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 5, 'LabelId' => 2]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 6, 'LabelId' => 3]);

        $this->call([
            TakenSeeder::class,
            TaakLabelKoppelingSeeder::class,
        ]);
    }
}
