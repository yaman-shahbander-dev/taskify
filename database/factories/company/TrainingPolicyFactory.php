<?php

namespace Database\Factories\company;

use App\Domain\Company\Models\TrainingPolicy;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'company_id' => \App\Domain\Company\Models\Company::query()->inRandomOrder()->first()->id,
            'description' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
