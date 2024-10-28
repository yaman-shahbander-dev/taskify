<?php

namespace Database\Factories\finance;

use App\Models\client\User;
use App\Models\finance\Invoice;
use App\Models\finance\PaymentTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

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
}
