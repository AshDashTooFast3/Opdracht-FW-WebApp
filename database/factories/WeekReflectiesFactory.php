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
            'ReflectieTekst' => $this->faker->paragraph,
            'IsActief' => $this->faker->boolean,
            'Opmerking' => $this->faker->sentence,
        ];
    }
}
