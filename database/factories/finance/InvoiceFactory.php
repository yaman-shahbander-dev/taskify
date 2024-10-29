<?php

namespace Database\Factories\finance;

use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = \App\Domain\Finance\Models\Invoice::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'amount' => fake()->randomNumber(4),
            'issue_date' => fake()->dateTime(),
            'due_date' => fake()->dateTime(),
            'status' => fake()->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
