<?php

namespace App\Models\company;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentTeam extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'departments_teams';
}
