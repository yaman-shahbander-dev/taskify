<?php

namespace Database\Factories\training;

use App\Domain\Training\Projections\TrainingMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Training\Projections\TrainingCourse;

class TrainingMaterialFactory extends Factory
{
    protected $model = TrainingMaterial::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'course_id' => TrainingCourse::query()->inRandomOrder()->first()->id,
            'material_type' => 'file',
            'file_path' => fake()->filePath(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Training\Projections\TrainingMaterial
     */
    public function createWritable(array $attributes = []): TrainingMaterial
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
