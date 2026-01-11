<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\TaakLabelKoppelingen;

use Illuminate\Database\Seeder;

class TaakLabelKoppelingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaakLabelKoppelingen::factory(3)->create();
    }
}
