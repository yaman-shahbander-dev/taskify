<?php

namespace App\Domain\Client\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProficiencyLevel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'proficiency_levels';
}
