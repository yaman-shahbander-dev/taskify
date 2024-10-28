<?php

namespace Database\Factories\project;

use App\Models\client\User;
use App\Models\project\Meeting;
use App\Models\project\PriorityLevel;
use App\Models\project\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeetingFactory extends Factory
{
    protected $model = Meeting::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'project_id' => Project::query()->inRandomOrder()->first()->id,
            'title' => fake()->word,
            'agenda' => fake()->sentence,
            'date' => fake()->dateTime(),
            'duration' => fake()->randomDigitNotZero(),
            'link' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
