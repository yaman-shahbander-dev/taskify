<?php

namespace Database\Factories\finance;

use App\Domain\Finance\Projections\Invoice;
use App\Domain\Finance\Projections\InvoiceItem;
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

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Finance\Projections\InvoiceItem
     */
    public function createWritable(array $attributes = []): InvoiceItem
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
