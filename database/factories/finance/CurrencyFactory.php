<?php

namespace Database\Factories\finance;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Finance\Projections\Currency;

class CurrencyFactory extends Factory
{
    protected $model = Currency::class;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Finance\Projections\Currency
     */
    public function createWritable(array $attributes = []): Currency
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
