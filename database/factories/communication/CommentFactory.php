<?php

namespace Database\Factories\communication;

use App\Domain\Client\Projections\User;
use App\Domain\Communication\Projections\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'commentable_type' => 'user',
            'commentable_id' => User::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'content' => fake()->sentence,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Communication\Projections\Comment
     */
    public function createWritable(array $attributes = []): Comment
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
