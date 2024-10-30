<?php

namespace Database\Factories\project;

use App\Domain\Project\Projections\SprintReview;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Sprint;

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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\SprintReview
     */
    public function createWritable(array $attributes = []): SprintReview
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
