<?php

namespace App\Domain\Client\Projectors;

use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use App\Domain\Client\Events\UserRegistered;
use App\Domain\Client\Actions\RegisterUserAction;

class UserProjector extends Projector
{
    public function onUserRegistered(UserRegistered $event)
    {
        return app(RegisterUserAction::class)(
            $event->data->id,
            $event->data->name,
            $event->data->email,
            $event->data->password
        );
    }
}
