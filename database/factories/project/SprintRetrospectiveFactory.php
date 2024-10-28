<?php

namespace Database\Factories\project;

use App\Models\project\Sprint;
use App\Models\project\SprintRetrospective;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintRetrospectiveFactory extends Factory
{
    protected $model = SprintRetrospective::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'sprint_id' => Sprint::query()->inRandomOrder()->first()->id,
            'date' => fake()->dateTime(),
            'what_went_well' => fake()->sentence,
            'what_can_improve' => fake()->sentence,
            'action_items' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
