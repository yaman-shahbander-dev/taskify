<?php

namespace Database\Factories\company;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\Salary;
use App\Domain\Finance\Projections\Currency;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\Salary
     */
    public function createWritable(array $attributes = []): Salary
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
