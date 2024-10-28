<?php

namespace Database\Factories\project;

use App\Models\project\Project;
use App\Models\project\Sprint;
use Illuminate\Database\Eloquent\Factories\Factory;

class SprintFactory extends Factory
{
    protected $model = Sprint::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = now();
        $end = $start->copy()->addDays(14);

        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => Project::query()->inRandomOrder()->first()->id,
            'number' => fake()->unique()->randomDigitNotZero(),
            'start' => $start,
            'end' => $end,
            'goal' => fake()->sentence,
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
