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
            'Weeknummer' => date('W', strtotime('now')),
            'Beschrijving' => $this->faker->sentence(),
            'Status' => $this->faker->randomElement(['Open', 'Afgerond']),
            
        ];
    }
}
