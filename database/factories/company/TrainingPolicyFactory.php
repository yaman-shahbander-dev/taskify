<?php

namespace Database\Factories\company;

use App\Domain\Company\Projections\TrainingPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Company\Projections\Company;

class TrainingPolicyFactory extends Factory
{
    protected $model = TrainingPolicy::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'company_id' => Company::query()->inRandomOrder()->first()->id,
            'description' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\TrainingPolicy
     */
    public function createWritable(array $attributes = []): TrainingPolicy
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
