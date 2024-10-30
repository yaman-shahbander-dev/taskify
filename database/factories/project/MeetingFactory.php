<?php

namespace Database\Factories\project;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Meeting;
use App\Domain\Project\Projections\Project;

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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\Meeting
     */
    public function createWritable(array $attributes = []): Meeting
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
