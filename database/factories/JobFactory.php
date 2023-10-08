<?php

namespace Database\Factories;

use App\Enums\PeopleSkill;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $skillQuantity = $this->faker->numberBetween(1,3);

        $recommendedSkills = [];
        for ($i = 0; $i<$skillQuantity; $i++)
        {
            $recommendedSkills[] = ['skill' => $this->faker->randomElement(PeopleSkill::cases())->value, 'value' => $this->faker->numberBetween(0,10)];
        }

        return [
            'name' => $this->faker->word,
            'crew_required' => $this->faker->numberBetween(1,6),
            'item_rewards' => Item::all()->random(2)->pluck('id'),
            'recommended_skills' => $recommendedSkills
        ];
    }
}
