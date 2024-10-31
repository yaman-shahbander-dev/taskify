<?php

namespace App\Domain\Client\Exceptions;

use App\Support\Bases\BaseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class UserNotFoundException extends BaseException
{
    public function __construct($message = "Failed to find the user", $code = 0)
    {
        parent::__construct($message, $code);
    }

    public function report(): void
    {
        Log::error($this->getMessage());
    }

    public function render($request): JsonResponse
    {
        return $this->failedResponse($this->getMessage());
    }
}
