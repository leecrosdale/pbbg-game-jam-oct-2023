<?php

namespace Database\Factories;

use App\Enums\ItemType;
use App\Enums\ItemValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => $this->faker->randomElement(ItemValue::cases())->value,
            'type' => $this->faker->randomElement(ItemType::cases())->value,
        ];
    }
}
