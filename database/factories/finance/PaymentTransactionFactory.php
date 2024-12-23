<?php

namespace Database\Factories\finance;

use App\Domain\Client\Projections\User;
use App\Domain\Finance\Projections\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Finance\Projections\PaymentTransaction;

class PaymentTransactionFactory extends Factory
{
    protected $model = PaymentTransaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'invoice_id' => Invoice::query()->inRandomOrder()->first()->id,
            'receivable_type' => 'user',
            'receivable_id' => User::query()->inRandomOrder()->first()->id,
            'amount' => fake()->randomNumber(3),
            'transaction_date' => fake()->dateTime(),
            'payment_method' => 'cash',
            'transaction_type' => 'direct',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Finance\Projections\PaymentTransaction
     */
    public function createWritable(array $attributes = []): PaymentTransaction
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
