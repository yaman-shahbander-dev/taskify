<?php

namespace Database\Factories\company;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Projections\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Domain\Company\Projections\TeamMemberRole;

class TeamMemberRoleFactory extends Factory
{
    protected $model = TeamMemberRole::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->unique()->uuid(),
            'team_member_id' => User::query()->inRandomOrder()->first()->id,
            'role_id' => Role::query()->inRandomOrder()->first()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Create a new instance of the factory with writable model.
     *
     * @param array $attributes
     * @return \App\Domain\Company\Projections\TeamMemberRole
     */
    public function createWritable(array $attributes = []): TeamMemberRole
    {
        $model = $this->state($attributes)->make();
        $model->writeable()->save();

        return $model;
    }
}
