<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Taken;
use \App\Models\Labels;
use App\Models\User;

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
            'GebruikerId' => 1,
            'IsActief' => $this->faker->boolean(90),
            'Opmerking' => $this->faker->optional()->sentence(),
            'DatumAangemaakt' => $this->faker->dateTime(),
            'DatumGewijzigd' => $this->faker->dateTime()
        ];
    }
}
