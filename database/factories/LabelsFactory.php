<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LabelsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'Label' => $this->faker->randomElement(['Belangrijk', 'Dringend','Beoordelen']),
            'IsActief' => $this->faker->boolean(90),
            'Opmerking' => $this->faker->optional()->sentence(),
            'DatumAangemaakt' => $this->faker->dateTime(),
            'DatumGewijzigd' => $this->faker->dateTime(),
        ];
    }
}
