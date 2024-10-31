<?php

namespace App\Domain\Client\Projections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role;

class ERole extends Role
{
    use HasFactory;

    protected $table = 'e_roles';
}
