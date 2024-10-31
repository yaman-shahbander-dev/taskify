<?php

namespace Database\Factories\company;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\DepartmentTeam;
use App\Domain\Company\Projections\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'team_id' => DepartmentTeam::query()->inRandomOrder()->first()->id,
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\TeamMember
     */
    public function createWritable(array $attributes = []): TeamMember
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
