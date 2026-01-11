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
        Labels::create(['Label' => 'Belangrijk']);
        Labels::create(['Label' => 'Dringend']);
        Labels::create(['Label' => 'Beoordeling']);
        Labels::create(['Label' => 'Afgerond']);
    }
}
