<?php

namespace App\Domain\Company\Projectors;

use App\Domain\Company\Actions\CreateCompanyAction;
use App\Domain\Company\Actions\CreateCompanyDepartmentAction;
use App\Domain\Company\Actions\CreateDepartmentTeamAction;
use App\Domain\Company\Events\CompanyCreated;
use App\Domain\Company\Events\CompanyDepartmentCreated;
use App\Domain\Company\Events\DepartmentTeamCreated;
use App\Support\Bases\BaseProjector;

class CompanyProjector extends BaseProjector
{
    public function onCompanyCreated(CompanyCreated $event)
    {
        $event->data->name = 'default company #' . time();

        return app(CreateCompanyAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->address,
            $event->data->contactNumber,
        );
    }

    public function onCompanyDepartmentCreated(CompanyDepartmentCreated $event)
    {
        $event->data->name = 'default company department #' . time();

        return app(CreateCompanyDepartmentAction::class)(
            $event->data->id,
            $event->data->companyId,
            $event->data->name
        );
    }

    public function onDepartmentTeamCreated(DepartmentTeamCreated $event)
    {
        $event->data->name = 'default department team #' . time();

        return app(CreateDepartmentTeamAction::class)(
            $event->data->id,
            $event->data->departmentId,
            $event->data->name
        );
    }
}
