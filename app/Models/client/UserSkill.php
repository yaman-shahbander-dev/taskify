<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class UserSkill extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'user_skills';
}
