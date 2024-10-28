<?php

namespace App\Models\project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SprintChangeLog extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'sprint_changes_log';
}
