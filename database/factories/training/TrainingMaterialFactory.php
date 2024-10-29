<?php

namespace Database\Factories\training;

use App\Domain\Training\Models\TrainingMaterial;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'course_id' => \App\Domain\Training\Models\TrainingCourse::query()->inRandomOrder()->first()->id,
            'material_type' => 'file',
            'file_path' => fake()->filePath(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
