<?php

namespace Database\Factories\company;

use App\Models\client\User;
use App\Models\company\TeamMemberRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\company\Role;

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
}
