<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TakenFactory extends Factory
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
            'Titel' => $this->faker->word(),
            'Beschrijving' => $this->faker->sentence(),
            'Status' => $this->faker->randomElement(['Open', 'Afgerond']),
            'Deadline' => $this->faker->dateTimeBetween('now', '+1 month'),
            'Type' => $this->faker->randomElement(['School', 'Werk', 'Prive', 'Side-Project']),
            'IsActief' => $this->faker->boolean(90),
            'Opmerking' => $this->faker->optional()->sentence(),
            'DatumAangemaakt' => $this->faker->dateTime(),
            'DatumGewijzigd' => $this->faker->dateTime()
            
        ];
    }
}
