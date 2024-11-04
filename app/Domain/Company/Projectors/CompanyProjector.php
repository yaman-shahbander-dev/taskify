<?php

namespace App\Domain\Company\Projectors;

use App\Domain\Company\Actions\CreateCompanyAction;
use App\Domain\Company\Events\CompanyCreated;
use App\Support\Bases\BaseProjector;

class CompanyProjector extends BaseProjector
{
    public function onCompanyCreated(CompanyCreated $event)
    {
        return app(CreateCompanyAction::class)(
            $event->data->id,
            $event->data->userId,
            $event->data->name,
            $event->data->address,
            $event->data->contactNumber,
        );
    }
}
