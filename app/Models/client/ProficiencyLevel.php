<?php

namespace App\Models\client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ProficiencyLevel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'proficiency_levels';
}
