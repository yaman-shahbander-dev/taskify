<?php

namespace Database\Factories\finance;

use App\Models\finance\Invoice;
use App\Models\finance\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{
    protected $model = InvoiceItem::class;
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
            'description' => fake()->sentence,
            'quantity' => fake()->randomDigitNotZero(),
            'unit_price' => fake()->randomDigitNotZero(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
