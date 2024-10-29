<?php

namespace Database\Factories\finance;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    protected $model = \App\Domain\Finance\Models\Currency::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'code' => fake()->unique()->currencyCode(),
            'name' => fake()->unique()->name,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}