<?php

namespace App\Domain\Client\Projections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class EPermission extends Permission
{
    use HasFactory;

    protected $table = 'permissions';
}
