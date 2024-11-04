<?php

namespace App\Domain\Client\Projections;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domain\Company\Projections\Company;
use App\Domain\Company\Projections\CompanyDepartment;
use App\Domain\Company\Projections\DepartmentTeam;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Staudenmeir\EloquentHasManyDeep\HasManyDeep;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use HasRoles;
    use LogsActivity;
    use HasUuids;
    use HasRelationships;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty();
    }

    protected function getDefaultGuardName(): string
    {
        return 'api';
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function departments(): HasManyThrough
    {
        return $this->hasManyThrough(
            CompanyDepartment::class,  // Final model
            Company::class,   // Intermediate model
            'user_id',        // Foreign key on the companies table
            'company_id',  // Foreign key on the departments table
            'id',            // Local key on the users table
            'id'       // Local key on the companies table
        );
    }

    public function teams(): HasManyDeep
    {
        return $this->hasManyDeep(
            DepartmentTeam::class,  // Final model
            [Company::class, CompanyDepartment::class],  // Intermediate models
            [
                'user_id',        // Foreign key on the companies table
                'company_id',     // Foreign key on the company_departments table
                'department_id'   // Foreign key on the department_teams table
            ],
            [
                'id',             // Local key on the users table
                'id',             // Local key on the companies table
                'id'              // Local key on the company_departments table
            ]
        );
    }
}
