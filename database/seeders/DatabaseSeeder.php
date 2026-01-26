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
            'Type' => NULL,
            'Status' => 'Open',
        ]);

        //taken voor morgen aanmaken
        Taken::factory(3)->create([
            'GebruikerId' => 1,
            'Titel' => 'PHP oefenen',
            'Beschrijving' => 'Oefenen met PHP taal',
            'Type' => NULL,
            'Deadline' => now()->addDay(),
            'Status' => 'Open',
        ]);

        //specifieke taak voor school
        Taken::factory(2)->create([
            'GebruikerId' => 1,
            'Titel' => 'Project maken',
            'Beschrijving' => 'Het project voor school afmaken',
            'Type' => 'School',
            'Deadline' => now()->addDay(),
            'Status' => 'Open',
        ]);

        //specifieke taak voor werk
        Taken::factory(2)->create([
            'GebruikerId' => 1,
            'Titel' => 'Verslag schrijven',
            'Beschrijving' => 'Het verslag voor school schrijven',
            'Type' => 'Werk',
            'Deadline' => now()->addDay(),
            'Status' => 'Open',
        ]);

         //specifieke taak voor prive
        Taken::factory(2)->create([
            'GebruikerId' => 1,
            'Titel' => 'Boodschappen doen',
            'Beschrijving' => 'Naar de supermarkt gaan om boodschappen te doen',
            'Type' => 'Prive',
            'Deadline' => now()->addDay(),
            'Status' => 'Open',
        ]);

         //specifieke taak voor side-projecten
        Taken::factory(2)->create([
            'GebruikerId' => 1,
            'Titel' => 'Website bouwen',
            'Beschrijving' => 'Mijn eigen website bouwen met HTML, CSS en JavaScript',
            'Type' => 'Side-Project',
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

        //School taken
        TaakLabelKoppelingen::factory()->create(['TaakId' => 7, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 8, 'LabelId' => 2]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 9, 'LabelId' => 3]);

        //Werk taken
        TaakLabelKoppelingen::factory()->create(['TaakId' => 10, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 11, 'LabelId' => 2]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 12, 'LabelId' => 3]);

        //Prive taken
        TaakLabelKoppelingen::factory()->create(['TaakId' => 13, 'LabelId' => 1]);
        TaakLabelKoppelingen::factory()->create(['TaakId' => 14, 'LabelId' => 2]);


        $this->call([
            TakenSeeder::class,
            TaakLabelKoppelingSeeder::class,
        ]);
    }
}
