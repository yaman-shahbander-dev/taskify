<?php

namespace Database\Factories\project;

use App\Models\project\Project;
use App\Models\project\Sprint;
use App\Models\project\SprintReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintReviewFactory extends Factory
{
    protected $model = SprintReview::class;
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
            'summary' => fake()->sentence,
            'feedback' => fake()->sentence,
            'next_steps' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
