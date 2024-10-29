<?php

namespace App\Domain\Client\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class ERole extends Role
{
    use HasFactory;
    use HasUuids;

    protected $table = 'e_roles';
}
