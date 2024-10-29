<?php

namespace Database\Factories\company;

use App\Domain\Client\Models\User;
use App\Domain\Company\Models\Salary;
use App\Domain\Finance\Models\Currency;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    protected $model = Salary::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'currency_id' => Currency::query()->inRandomOrder()->first()->id,
            'amount' => fake()->randomNumber(4),
            'payment_date' => fake()->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
