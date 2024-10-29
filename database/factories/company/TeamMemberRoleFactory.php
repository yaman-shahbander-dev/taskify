<?php

namespace Database\Factories\company;

use App\Domain\Client\Models\User;
use App\Domain\Company\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamMemberRoleFactory extends Factory
{
    protected $model = \App\Domain\Company\Models\TeamMemberRole::class;
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
}
