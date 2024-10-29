<?php

namespace Database\Factories\company;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = \App\Domain\Company\Models\Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'name' => fake()->name,
            'address' => fake()->address,
            'contact_number' => fake()->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
