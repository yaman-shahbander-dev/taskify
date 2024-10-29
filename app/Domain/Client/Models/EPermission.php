<?php

namespace App\Domain\Client\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission;

class EPermission extends Permission
{
    use HasFactory;
    use HasUuids;

    protected $table = 'permissions';
}
