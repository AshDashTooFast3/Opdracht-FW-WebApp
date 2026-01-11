<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\Taken;

class TakenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Taken::factory(3)->create();
    }
}
