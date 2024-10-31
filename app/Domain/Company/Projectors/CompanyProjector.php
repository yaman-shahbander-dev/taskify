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
        return app(CreateCompanyAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->address,
            $event->data->contactNumber,
        );
    }

    public function onCompanyDepartmentCreated(CompanyDepartmentCreated $event)
    {
        return app(CreateCompanyDepartmentAction::class)(
            $event->data->id,
            $event->data->companyId,
            $event->data->name
        );
    }

    public function onDepartmentTeamCreated(DepartmentTeamCreated $event)
    {
        return app(CreateDepartmentTeamAction::class)(
            $event->data->id,
            $event->data->departmentId,
            $event->data->name
        );
    }
}
