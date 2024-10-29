<?php

namespace Database\Factories\project;

use App\Domain\Project\Models\SprintChangeLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintChangeLogFactory extends Factory
{
    protected $model = SprintChangeLog::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'sprint_id' => \App\Domain\Project\Models\Sprint::query()->inRandomOrder()->first()->id,
            'change_description' => fake()->sentence,
            'date' => fake()->dateTime(),
            'affected_tasks' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
