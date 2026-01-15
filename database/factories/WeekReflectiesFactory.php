<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Taken;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WeekReflectiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'GebruikerId' => User::factory(),
            'TaakId' => Taken::factory(),
            'WeekNummer' => date('W', strtotime('now')),
            'WatGeleerd' => $this->faker->sentence(),
            'WatLastig' => $this->faker->sentence(),
            'VolgendeStap' => $this->faker->sentence(),
            'IsActief' => $this->faker->boolean(90),
            'Opmerking' => $this->faker->optional()->sentence(),
            'DatumAangemaakt' => $this->faker->dateTime(),
            'DatumGewijzigd' => $this->faker->dateTime(),
        ];
    }
}
