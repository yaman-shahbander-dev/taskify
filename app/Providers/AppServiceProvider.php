<?php

namespace App\Providers;

use App\Domain\Client\Projections\User;
use App\Domain\Company\Policies\DepartmentPolicy;
use App\Domain\Company\Policies\TeamPolicy;
use App\Domain\Company\Projections\CompanyDepartment;
use App\Domain\Company\Projections\DepartmentTeam;
use App\Domain\Project\Policies\ProjectPolicy;
use App\Domain\Project\Policies\SprintPolicy;
use App\Domain\Project\Projections\Project;
use App\Domain\Project\Projections\Sprint;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Domain\Client\Events\UserRegistered;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->prepareMigrations();
        $this->prepareMorphMaps();
        $this->preparePolicies();
    }

    protected function prepareMigrations(): void
    {
        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'client',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'communication',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'company',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'finance',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'project',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'training',
        ]);
    }

    protected function prepareMorphMaps(): void
    {
        Relation::enforceMorphMap([
            'user' => User::class,
            'user_registered' => UserRegistered::class,
        ]);
    }

    protected function preparePolicies(): void
    {
        Gate::policy(CompanyDepartment::class, DepartmentPolicy::class);
        Gate::policy(DepartmentTeam::class, TeamPolicy::class);
        Gate::policy(Project::class, ProjectPolicy::class);
        Gate::policy(Sprint::class, SprintPolicy::class);
    }
}
