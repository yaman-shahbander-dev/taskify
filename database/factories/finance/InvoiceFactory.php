<?php

namespace Database\Factories\finance;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Finance\Projections\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Finance\Projections\Invoice
     */
    public function createWritable(array $attributes = []): Invoice
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
