<?php

namespace Database\Factories\project;

use Illuminate\Database\Eloquent\Factories\Factory;

class SprintFactory extends Factory
{
    protected $model = \App\Domain\Project\Models\Sprint::class;
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
            'project_id' => \App\Domain\Project\Models\Project::query()->inRandomOrder()->first()->id,
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
