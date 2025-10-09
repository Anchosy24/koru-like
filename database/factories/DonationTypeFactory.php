<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonationType>
 */
class DonationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project'     => $this->faker->sentence(),
            'type'        => $this->faker->sentence(),
            'summary'     => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'amount'      => $this->faker->numberBetween(0, 10000),
            'target'      => $this->faker->numberBetween(1000, 100000),
        ];
    }
}