<?php

namespace App\Domain\Company\Projectors;

use App\Domain\Company\Actions\CreateCompanyDepartmentAction;
use App\Domain\Company\Actions\DeleteCompanyDepartmentAction;
use App\Domain\Company\Actions\UpdateCompanyDepartmentAction;
use App\Domain\Company\Events\CompanyDepartmentCreated;
use App\Domain\Company\Events\DepartmentCreated;
use App\Domain\Company\Events\DepartmentDeleted;
use App\Domain\Company\Events\DepartmentUpdated;
use App\Support\Bases\BaseProjector;

class DepartmentProjector extends BaseProjector
{
    public function onCompanyDepartmentCreated(CompanyDepartmentCreated $event)
    {
        return app(CreateCompanyDepartmentAction::class)(
            $event->data->id,
            $event->data->companyId,
            $event->data->name
        );
    }

    public function onDepartmentCreated(DepartmentCreated $event)
    {
        return app(CreateCompanyDepartmentAction::class)(
            $event->data->id,
            $event->data->companyId,
            $event->data->name,
        );
    }

    public function onDepartmentUpdated(DepartmentUpdated $event)
    {
        return app(UpdateCompanyDepartmentAction::class)(
            $event->data->id,
            $event->data->name,
        );
    }

    public function onDepartmentDeleted(DepartmentDeleted $event)
    {
        return app(DeleteCompanyDepartmentAction::class)(
            $event->departmentId
        );
    }
}
