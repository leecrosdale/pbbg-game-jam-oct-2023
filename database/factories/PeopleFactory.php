<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'experience' => $this->faker->numberBetween(0, 10),
            'lockpicking' => $this->faker->numberBetween(0, 10),
            'hacking' => $this->faker->numberBetween(0, 10),
            'stealth' => $this->faker->numberBetween(0, 10),
            'combat' => $this->faker->numberBetween(0, 10),
            'forgery' => $this->faker->numberBetween(0, 10),
            'safecracking' => $this->faker->numberBetween(0, 10),
            'medicine' => $this->faker->numberBetween(0, 10),
            'driving' => $this->faker->numberBetween(0, 10),
        ];
    }
}
