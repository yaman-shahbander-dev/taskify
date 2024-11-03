<?php

namespace Database\Factories\company;

use App\Domain\Client\Projections\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Company\Projections\Company;

class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'user_id' => User::query()->first()->id,
            'name' => fake()->name,
            'address' => fake()->address,
            'contact_number' => fake()->phoneNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\Company
     */
    public function createWritable(array $attributes = []): Company
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
