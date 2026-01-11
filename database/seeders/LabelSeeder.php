<?php

namespace Database\Seeders;

use App\Models\Labels;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Labels::factory(4)->create();
    }
}
