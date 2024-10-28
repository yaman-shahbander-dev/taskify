<?php

namespace App\Models\project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class PriorityLevel extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'priority_levels';
}
