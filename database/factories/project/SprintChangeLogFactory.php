<?php

namespace Database\Factories\project;

use App\Models\project\Sprint;
use App\Models\project\SprintChangeLog;
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
            'sprint_id' => Sprint::query()->inRandomOrder()->first()->id,
            'change_description' => fake()->sentence,
            'date' => fake()->dateTime(),
            'affected_tasks' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
