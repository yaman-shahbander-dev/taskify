<?php

namespace Database\Factories\project;

use App\Domain\Project\Projections\SprintRetrospective;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Project\Projections\Sprint;

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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Project\Projections\SprintRetrospective
     */
    public function createWritable(array $attributes = []): SprintRetrospective
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
