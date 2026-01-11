<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Taken;
use \App\Models\Labels;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaakLabelKoppelingen>
 */
class TaakLabelKoppelingenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'TaakId' => Taken::factory(),
            'LabelId' => Labels::factory(),
        ];
    }
}
